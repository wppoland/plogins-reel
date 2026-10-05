<?php

/**
 * [reel_video id="N"] and the reel/featured-video block must not show the video
 * and title of a product the visitor cannot read.
 *
 * resolveProduct() loaded any ID with wc_get_product(), so a contributor
 * previewing a draft could print the video of a draft, private or
 * password-protected product.
 *
 * Run: php tests/product-visibility-check.php
 */

declare(strict_types=1);

namespace Reel\Contract {
    interface HasHooks
    {
    }
}

namespace Reel\Service {
    final class ReelService
    {
    }
}

namespace {
    define('ABSPATH', __DIR__);

    class WC_Product
    {
        public function __construct(private string $status)
        {
        }

        public function get_status(): string
        {
            return $this->status;
        }
    }

    // ID => [status, password set, password entered].
    $GLOBALS['products'] = [
        1 => ['publish', false, false],
        2 => ['draft', false, false],
        3 => ['private', false, false],
        4 => ['publish', true, false],
        5 => ['publish', true, true],
    ];
    $GLOBALS['can_read'] = false;

    function wc_get_product(int $id): WC_Product|false
    {
        return isset($GLOBALS['products'][$id]) ? new WC_Product($GLOBALS['products'][$id][0]) : false;
    }

    function post_password_required(int $id): bool
    {
        [, $hasPassword, $entered] = $GLOBALS['products'][$id];

        return $hasPassword && ! $entered;
    }

    function current_user_can(string $cap, int $id): bool
    {
        return $GLOBALS['can_read'];
    }

    require __DIR__ . '/../src/Frontend/VideoShortcode.php';

    $shortcode = (new ReflectionClass(\Reel\Frontend\VideoShortcode::class))->newInstanceWithoutConstructor();
    $resolve   = new ReflectionMethod($shortcode, 'resolveProduct');

    // [can read, ID, resolves?]
    $cases = [
        [false, 1, true],
        [false, 2, false],
        [false, 3, false],
        [false, 4, false],
        [false, 5, true],
        [false, 99, false],
        [true, 2, true],
        [true, 3, true],
        [true, 4, false],
    ];

    $failures = 0;
    foreach ($cases as [$canRead, $id, $want]) {
        $GLOBALS['can_read'] = $canRead;
        $got = $resolve->invoke($shortcode, $id) instanceof WC_Product;
        if ($got !== $want) {
            echo 'FAIL: product ' . $id . ' (' . ($canRead ? 'can' : 'cannot') . ' read) resolved ' . var_export($got, true) . "\n";
            $failures++;
        }
    }

    echo 0 === $failures ? "OK: shortcode and block only resolve products the visitor can read\n" : '';
    exit($failures > 0 ? 1 : 0);
}
