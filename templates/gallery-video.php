<?php
/**
 * Featured video as the last slide of the product gallery ("In the gallery"
 * position). The slider builds its thumbnail from data-thumb; the play glyph on
 * that thumbnail comes from featured-video.css.
 *
 * @package Reel
 *
 * @var string $video_html Click-to-play facade or self-hosted <video> markup.
 * @var string $thumb      Thumbnail image URL (poster or a data: tile).
 * @var string $label      Video title, used as the thumbnail alt text.
 */

declare(strict_types=1);

defined('ABSPATH') || exit;

if (! isset($video_html) || $video_html === '') {
    return;
}
?>
<div class="woocommerce-product-gallery__image reel-gallery-video-slide" data-thumb="<?php echo esc_attr((string) $thumb); ?>" data-thumb-alt="<?php echo esc_attr((string) $label); ?>">
    <div class="reel-gallery-video__embed">
        <?php echo wp_kses((string) $video_html, \Reel\Service\ReelService::videoAllowedHtml()); ?>
    </div>
</div>
<?php
// Leaving the slide stops the video: a loaded player goes back to its facade,
// a self-hosted file pauses.
wp_print_inline_script_tag(
    '(function(s){var v=s&&s.previousElementSibling;if(!v||!window.MutationObserver){return;}var h=v.innerHTML;new MutationObserver(function(){if(v.classList.contains("flex-active-slide")){return;}v.querySelectorAll("video").forEach(function(e){e.pause();});if(v.querySelector("iframe")){v.innerHTML=h;}}).observe(v,{attributes:true,attributeFilter:["class"]});})(document.currentScript);'
);
