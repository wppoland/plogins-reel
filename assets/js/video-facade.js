/**
 * Reel, click-to-play facade for YouTube and Vimeo featured videos.
 *
 * The server prints a poster and a play button instead of the player iframe
 * (ReelService::videoFacade). The iframe is built here only when the shopper
 * activates the button, by click, Enter or Space, and takes focus so keyboard
 * and screen-reader users land in the player. No jQuery.
 */
document.addEventListener('click', (event) => {
  const button = event.target instanceof Element ? event.target.closest('[data-reel-video-src]') : null;

  if (!button || !/^https:\/\//.test(button.dataset.reelVideoSrc || '')) {
    return;
  }

  const iframe = document.createElement('iframe');
  iframe.src = button.dataset.reelVideoSrc;
  iframe.title = button.dataset.reelVideoTitle || button.getAttribute('aria-label') || '';
  iframe.allow = 'autoplay; encrypted-media; fullscreen; picture-in-picture';
  iframe.allowFullscreen = true;
  iframe.referrerPolicy = 'strict-origin-when-cross-origin';

  button.replaceWith(iframe);
  iframe.focus();
});
