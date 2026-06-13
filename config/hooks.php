<?php
/**
 * Boot order: services listed here are resolved from the container and have
 * their registerHooks() called during Plugin::boot(). Each must implement
 * Reel\Contract\HasHooks.
 *
 * Admin-only classes are included only when running in wp-admin context.
 *
 * @package Reel
 *
 * @return array<class-string>
 */

declare(strict_types=1);

use Reel\Admin\Settings;
use Reel\Service\ReelService;

defined('ABSPATH') || exit;

$hooks = [
    ReelService::class,
];

if (is_admin()) {
    $hooks[] = Settings::class;
}

return $hooks;
