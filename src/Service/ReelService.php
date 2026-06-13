<?php

declare(strict_types=1);

namespace Reel\Service;

use Reel\Contract\HasHooks;
use WPPoland\StorefrontKit\Media\FeaturedVideoEngine;
use WPPoland\StorefrontKit\Media\GalleryZoomEngine;

defined('ABSPATH') || exit;

/**
 * Thin adapter over the storefront-kit media engines.
 *
 * Injects this plugin's text-domain ('reel'), option prefix ('reel_'), asset
 * URLs and product meta keys into the namespace-neutral
 * {@see GalleryZoomEngine} and {@see FeaturedVideoEngine}. All media logic
 * lives in the kit; this class only supplies localisation, option storage,
 * asset URLs and template rendering.
 *
 * The zoom/lightbox/video CSS+JS ship in this plugin (assets/), enqueued by the
 * kit engines with the no-jQuery, deferred, in-footer convention.
 */
final class ReelService implements HasHooks
{
    private const OPTION = 'reel_settings';

    /** Product meta keys (mirrors Polski's featured-video meta). */
    private const META_VIDEO_URL   = '_reel_video_url';
    private const META_VIDEO_TITLE = '_reel_video_title';

    private ?GalleryZoomEngine $zoom = null;

    private ?FeaturedVideoEngine $video = null;

    public function __construct()
    {
        // The media engines ship with storefront-kit >= 1.3.0. When present,
        // wire them with this plugin's text-domain / option prefix / assets.
        // Otherwise leave the service inert (see registerHooks()).
        if (class_exists(GalleryZoomEngine::class)) {
            $this->zoom = new GalleryZoomEngine(
                'reelGalleryZoom',
                'reel-gallery-zoom',
                REEL_URL . 'assets/css/gallery-zoom.css',
                REEL_URL . 'assets/js/gallery-zoom.js',
                \Reel\VERSION,
                'lightbox',
                ['trigger' => __('Open image in full screen', 'reel')],
                fn (): bool => $this->zoomEnabled(),
                static fn (): bool => function_exists('is_product') && is_product(),
                fn (): array => $this->zoomSettings(),
                function (string $template, array $context): void {
                    $this->renderTemplate($template, $context);
                },
            );
        }

        if (class_exists(FeaturedVideoEngine::class)) {
            $this->video = new FeaturedVideoEngine(
                'reel-featured-video',
                REEL_URL . 'assets/css/featured-video.css',
                \Reel\VERSION,
                'featured-video',
                ['url' => self::META_VIDEO_URL, 'title' => self::META_VIDEO_TITLE],
                ['title' => __('Product video', 'reel')],
                fn (): bool => $this->videoEnabled(),
                static fn (): bool => function_exists('is_product') && is_product(),
                fn (): array => $this->videoSettings(),
                static fn (\WC_Product $product, string $key): mixed => $product->get_meta($key),
                function (string $template, array $context): void {
                    $this->renderTemplate($template, $context);
                },
            );
        }
    }

    public function registerHooks(): void
    {
        $registered = false;

        if ($this->zoom instanceof GalleryZoomEngine) {
            $this->zoom->registerHooks();
            $registered = true;
        }

        if ($this->video instanceof FeaturedVideoEngine) {
            $this->video->registerHooks();
            $registered = true;
        }

        if (! $registered) {
            // TODO: storefront-kit < 1.3.0 has no Media engines. Bump the
            // `wppoland/storefront-kit` constraint (composer update) to enable
            // gallery zoom + featured video. No hooks run until present.
            return;
        }
    }

    private function zoomEnabled(): bool
    {
        $settings = $this->settings();

        return (bool) ($settings['enable_zoom'] ?? false)
            || (bool) ($settings['enable_lightbox'] ?? false);
    }

    private function videoEnabled(): bool
    {
        return (bool) ($this->settings()['enable_video'] ?? false);
    }

    /**
     * Settings shaped for GalleryZoomEngine's localized config.
     *
     * @return array<string, mixed>
     */
    private function zoomSettings(): array
    {
        $settings = $this->settings();

        return [
            'enable_zoom'         => (bool) ($settings['enable_zoom'] ?? true),
            'enable_lightbox'     => (bool) ($settings['enable_lightbox'] ?? true),
            'zoom_scale'          => (float) ($settings['zoom_scale'] ?? 1.45),
            'show_backdrop_close' => (bool) ($settings['show_backdrop_close'] ?? true),
        ];
    }

    /**
     * Settings shaped for FeaturedVideoEngine.
     *
     * @return array<string, mixed>
     */
    private function videoSettings(): array
    {
        $settings = $this->settings();

        return [
            'position'   => (string) ($settings['video_position'] ?? 'after_gallery'),
            'autoplay'   => (bool) ($settings['video_autoplay'] ?? false),
            'show_title' => (bool) ($settings['video_show_title'] ?? true),
            'show_on_single' => true,
        ];
    }

    /**
     * Stored settings merged over packaged defaults.
     *
     * @return array<string, mixed>
     */
    private function settings(): array
    {
        $stored = get_option(self::OPTION, []);

        if (! is_array($stored)) {
            $stored = [];
        }

        /** @var array<string, mixed> $defaults */
        $defaults = require REEL_DIR . 'config/defaults.php';

        return array_merge($defaults, $stored);
    }

    /**
     * @param array<string, mixed> $context
     */
    private function renderTemplate(string $template, array $context): void
    {
        $file = REEL_DIR . 'templates/' . $template . '.php';

        if (! is_readable($file)) {
            return;
        }

        extract($context, EXTR_SKIP);
        require $file;
    }
}
