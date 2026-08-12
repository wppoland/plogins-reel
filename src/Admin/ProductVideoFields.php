<?php

declare(strict_types=1);

namespace Reel\Admin;

use Reel\Contract\HasHooks;

defined('ABSPATH') || exit;

/**
 * The product editor fields for the featured video.
 *
 * The rendering half of this feature always shipped here: storefront-kit's
 * FeaturedVideoEngine reads {@see self::META_VIDEO_URL} and
 * {@see self::META_VIDEO_TITLE} off the product and renders the video in the
 * gallery area. What was missing was any way to fill those keys in, so the
 * readme told people to edit the meta field by hand and the editor UI was sold
 * separately. A shipped capability with its interface withheld is a locked
 * feature, which the WordPress.org guidelines do not allow and which is a poor
 * deal for the user regardless of the guidelines.
 *
 * This class closes that: the tab lives here, in the free plugin, next to the
 * engine it drives. Extensions add their own controls to the same tab through
 * the `reel_product_data_content` action rather than declaring a second one.
 */
final class ProductVideoFields implements HasHooks
{
    /** The meta keys FeaturedVideoEngine reads. */
    private const META_VIDEO_URL   = '_reel_video_url';
    private const META_VIDEO_TITLE = '_reel_video_title';

    public function registerHooks(): void
    {
        add_filter('woocommerce_product_data_tabs', [$this, 'addProductTab']);
        add_action('woocommerce_product_data_panels', [$this, 'renderProductPanel']);
        add_action('woocommerce_admin_process_product_object', [$this, 'saveProductMeta']);
    }

    /**
     * @param array<string, array<string, mixed>> $tabs
     * @return array<string, array<string, mixed>>
     */
    public function addProductTab(array $tabs): array
    {
        $tabs['reel'] = [
            'label'    => __('Reel', 'plogins-reel'),
            'target'   => 'reel_product_data',
            'class'    => ['show_if_simple', 'show_if_variable', 'show_if_external'],
            'priority' => 80,
        ];

        return $tabs;
    }

    public function renderProductPanel(): void
    {
        global $post;

        $productId  = ($post instanceof \WP_Post) ? (int) $post->ID : 0;
        $videoUrl   = $productId > 0 ? (string) get_post_meta($productId, self::META_VIDEO_URL, true) : '';
        $videoTitle = $productId > 0 ? (string) get_post_meta($productId, self::META_VIDEO_TITLE, true) : '';

        echo '<div id="reel_product_data" class="panel woocommerce_options_panel">';
        echo '<div class="options_group">';

        woocommerce_wp_text_input([
            'id'          => self::META_VIDEO_URL,
            'label'       => __('Video URL', 'plogins-reel'),
            'placeholder' => 'https://www.youtube.com/watch?v=...',
            'description' => __('A YouTube or Vimeo link, or a direct .mp4/.webm file URL. It shows in the gallery area on the product page. Leave empty for no video.', 'plogins-reel'),
            'desc_tip'    => true,
            'type'        => 'url',
            'value'       => $videoUrl,
        ]);

        woocommerce_wp_text_input([
            'id'          => self::META_VIDEO_TITLE,
            'label'       => __('Video heading (optional)', 'plogins-reel'),
            'placeholder' => __('e.g. See it in action', 'plogins-reel'),
            'description' => __('Heading shown above the video. Leave empty to use the default from Reel settings.', 'plogins-reel'),
            'desc_tip'    => true,
            'value'       => $videoTitle,
        ]);

        echo '</div>';

        /**
         * Fires inside the Reel product data tab.
         *
         * Lets an extension add controls to this tab instead of registering a
         * competing one, which would give the product editor two Reel tabs.
         */
        do_action('reel_product_data_content');

        echo '</div>';
    }

    /**
     * Persist the two meta keys.
     *
     * Uses woocommerce_admin_process_product_object, which WooCommerce fires
     * only after it has verified its own product nonce and the user's
     * capability, and which hands over the product object so the write goes
     * through the CRUD layer rather than straight to post meta.
     */
    public function saveProductMeta(\WC_Product $product): void
    {
        // phpcs:disable WordPress.Security.NonceVerification.Missing -- WooCommerce verifies its product nonce before this action fires.
        $url = isset($_POST[self::META_VIDEO_URL])
            ? esc_url_raw(trim(sanitize_text_field(wp_unslash($_POST[self::META_VIDEO_URL]))))
            : '';
        $title = isset($_POST[self::META_VIDEO_TITLE])
            ? sanitize_text_field(wp_unslash($_POST[self::META_VIDEO_TITLE]))
            : '';
        // phpcs:enable WordPress.Security.NonceVerification.Missing

        $product->update_meta_data(self::META_VIDEO_URL, $url);
        $product->update_meta_data(self::META_VIDEO_TITLE, $title);
    }
}
