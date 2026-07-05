<?php
/**
 * Elementor widget: Product Video.
 *
 * A thin wrapper around the [reel_video] shortcode so the featured product
 * video can be placed with the Elementor editor. Kept deliberately minimal
 * (renders the shortcode) so a future migration to Elementor v4 atomic widgets
 * is localized to this class. Loaded only from the `elementor/widgets/register`
 * hook, so the `\Elementor\Widget_Base` base class is guaranteed to exist here.
 *
 * @package Reel\Elementor
 */

declare(strict_types=1);

namespace Reel\Elementor;

defined('ABSPATH') || exit;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

/**
 * Product Video Elementor widget.
 */
final class ReelVideoWidget extends Widget_Base
{
    /**
     * Widget machine name (matches the shortcode tag).
     */
    public function get_name(): string
    {
        return 'reel_video';
    }

    /**
     * Widget label shown in the editor.
     */
    public function get_title(): string
    {
        return esc_html__('Product Video', 'plogins-reel');
    }

    /**
     * Editor panel icon.
     */
    public function get_icon(): string
    {
        return 'eicon-video-camera';
    }

    /**
     * Editor panel categories.
     *
     * @return string[]
     */
    public function get_categories(): array
    {
        return ['woocommerce-elements', 'general'];
    }

    /**
     * Search keywords in the editor.
     *
     * @return string[]
     */
    public function get_keywords(): array
    {
        return ['reel', 'video', 'product', 'gallery', 'woocommerce'];
    }

    /**
     * Register the editor controls.
     */
    protected function register_controls(): void
    {
        $this->start_controls_section(
            'content',
            ['label' => esc_html__('Product video', 'plogins-reel')]
        );

        $this->add_control(
            'product_id',
            [
                'label'       => esc_html__('Product ID', 'plogins-reel'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 0,
                'min'         => 0,
                'description' => esc_html__('Leave 0 to use the current product on a product page.', 'plogins-reel'),
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget on the front end and in the editor preview.
     */
    protected function render(): void
    {
        $settings   = $this->get_settings_for_display();
        $product_id = isset($settings['product_id']) ? absint($settings['product_id']) : 0;

        echo do_shortcode(sprintf('[reel_video id="%d"]', $product_id));
    }
}
