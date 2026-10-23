<?php

/**
 * The video position setting keeps the three positions the storefront knows
 * (after_gallery, before_summary, in_gallery) and drops anything else.
 *
 * Run: php tests/video-position-check.php
 */

declare(strict_types=1);

namespace Reel\Contract {
    interface HasHooks
    {
    }
}

namespace {
    define('ABSPATH', __DIR__);

    function sanitize_text_field(string $value): string
    {
        return trim($value);
    }

    function sanitize_textarea_field(string $value): string
    {
        return trim($value);
    }

    require __DIR__ . '/../src/Admin/Settings.php';

    $settings = (new ReflectionClass(\Reel\Admin\Settings::class))->newInstanceWithoutConstructor();

    foreach (['after_gallery', 'before_summary', 'in_gallery'] as $position) {
        $saved = $settings->sanitize(['video_position' => $position])['video_position'];
        assert($saved === $position, "$position was not kept, got $saved");
    }

    foreach (['', 'above_title', 'in_gallery ', null] as $junk) {
        $saved = $settings->sanitize(['video_position' => $junk])['video_position'];
        assert($saved === 'after_gallery', var_export($junk, true) . " was kept as $saved");
    }

    echo "video-position-check: OK\n";
}
