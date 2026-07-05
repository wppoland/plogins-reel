<?php
/**
 * Elementor integration service.
 *
 * Registers the Reel Elementor widget(s). The `elementor/widgets/register`
 * action only fires when Elementor is active, so this service is self-guarding:
 * nothing loads unless Elementor is present.
 *
 * @package Reel\Service
 */

declare(strict_types=1);

namespace Reel\Service;

defined('ABSPATH') || exit;

use Reel\Contract\HasHooks;
use Reel\Elementor\ReelVideoWidget;

/**
 * Wires the Reel widgets into the Elementor editor.
 */
final class ElementorWidgets implements HasHooks
{
    /**
     * Register WordPress hooks.
     */
    public function registerHooks(): void
    {
        add_action('elementor/widgets/register', [$this, 'register']);
    }

    /**
     * Register widget instances with Elementor's widgets manager.
     *
     * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
     */
    public function register($widgets_manager): void
    {
        // Loaded here (not autoloaded) so \Elementor\Widget_Base always exists.
        require_once __DIR__ . '/../Elementor/ReelVideoWidget.php';
        $widgets_manager->register(new ReelVideoWidget());
    }
}
