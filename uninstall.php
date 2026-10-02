<?php
/**
 * Uninstall cleanup. Runs when the plugin is deleted from the WordPress admin.
 * Removes the options Reel creates; product video meta is left untouched so a
 * reinstall (or Reel Pro) keeps existing per-product videos.
 *
 * @package Reel
 */

declare(strict_types=1);

defined('WP_UNINSTALL_PLUGIN') || exit;

delete_option('reel_settings');
delete_option('reel_db_version');

// The [reel_video] shortcode and block cache built embeds in transients named
// reel_video_<hash>, one per product and URL, so they cannot be deleted by
// name. Without an object cache they live in the options table.
global $wpdb;
$wpdb->query( // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching -- One-off cleanup on uninstall.
    $wpdb->prepare(
        "DELETE FROM {$wpdb->options} WHERE option_name LIKE %s OR option_name LIKE %s",
        $wpdb->esc_like('_transient_reel_video_') . '%',
        $wpdb->esc_like('_transient_timeout_reel_video_') . '%'
    )
);

// The PRO banner's dismissal is stored per user, so it belongs to the
// plugin rather than to the site content. User meta is global, not
// per-site, which is why this uses delete_metadata's \$delete_all rather
// than a loop over the users of one blog.
delete_metadata('user', 0, 'reel_pro_banner_dismissed', '', true);
