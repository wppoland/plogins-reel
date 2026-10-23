<?php
/**
 * Gallery lightbox shell, printed in the footer. Markup matches the data
 * attributes the gallery-zoom.js script binds to. Starts hidden (no CLS, fixed
 * overlay, zero layout cost).
 *
 * @package Reel
 *
 * @var array<string, mixed> $settings
 */

declare(strict_types=1);

defined('ABSPATH') || exit;
?>
<div
    class="reel-gallery-lightbox"
    data-reel-gallery-lightbox
    hidden
    role="dialog"
    aria-modal="true"
    aria-label="<?php esc_attr_e('Product image viewer', 'plogins-reel'); ?>"
    tabindex="-1"
>
    <button
        type="button"
        class="reel-gallery-lightbox__close"
        data-reel-gallery-lightbox-close
        aria-label="<?php esc_attr_e('Close image viewer', 'plogins-reel'); ?>"
    ><span aria-hidden="true">&times;</span></button>
    <button
        type="button"
        class="reel-gallery-lightbox__nav reel-gallery-lightbox__nav--prev"
        data-reel-gallery-lightbox-prev
        aria-label="<?php esc_attr_e('Previous image', 'plogins-reel'); ?>"
        hidden
    ><span aria-hidden="true">&lsaquo;</span></button>
    <img data-reel-gallery-lightbox-image src="" alt="" />
    <button
        type="button"
        class="reel-gallery-lightbox__nav reel-gallery-lightbox__nav--next"
        data-reel-gallery-lightbox-next
        aria-label="<?php esc_attr_e('Next image', 'plogins-reel'); ?>"
        hidden
    ><span aria-hidden="true">&rsaquo;</span></button>
    <p class="reel-gallery-lightbox__counter" data-reel-gallery-lightbox-counter aria-live="polite"></p>
    <?php if (! empty($settings['lightbox_caption'])) : ?>
        <p class="reel-gallery-lightbox__caption" data-reel-gallery-lightbox-caption></p>
    <?php endif; ?>
</div>
