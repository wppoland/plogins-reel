/**
 * Reel, gallery hover-zoom + accessible lightbox.
 *
 * No jQuery, deferred, in-footer. Config is injected via wp_localize_script as
 * window.reelGalleryZoom. The lightbox shell is printed in the footer
 * (templates/lightbox.php) and starts hidden, so there is no layout shift.
 */
// Pure helpers, kept outside the page code so tests/gallery-nav-check.mjs can
// run them without a browser.
window.reelGalleryNav = {
  // Wrap-around step through n images.
  step: (index, delta, n) => (n > 0 ? (((index + delta) % n) + n) % n : 0),
  // The full-size file: WooCommerce puts it on data-large_image and on the
  // wrapping link; currentSrc is only the gallery-size rendition.
  largeSrc: (img) => {
    const link = img.closest ? img.closest('a[href]') : null;
    return img.getAttribute('data-large_image') || (link && link.getAttribute('href')) || img.currentSrc || img.src || '';
  },
};

// Gallery images, minus the "In the gallery" video slide.
const REEL_GALLERY_IMAGES = '.woocommerce-product-gallery__image:not(.reel-gallery-video-slide) img';

document.addEventListener('DOMContentLoaded', () => {
  const nav = window.reelGalleryNav;

  const config = window.reelGalleryZoom;

  if (!config) {
    return;
  }

  // Plugin-local extras injected on the same handle (only the core config object
  // is localized otherwise). Optional, defaults keep prior behaviour.
  const extra = window.reelGalleryExtra || {};
  const isTouch = window.matchMedia ? window.matchMedia('(hover: none)').matches : false;
  const allowZoom = config.enableZoom && !(extra.disableZoomOnTouch && isTouch);

  const lightbox = document.querySelector('[data-reel-gallery-lightbox]');
  const lightboxImage = document.querySelector('[data-reel-gallery-lightbox-image]');
  const closeButton = lightbox ? lightbox.querySelector('[data-reel-gallery-lightbox-close]') : null;
  const caption = lightbox ? lightbox.querySelector('[data-reel-gallery-lightbox-caption]') : null;
  const counter = lightbox ? lightbox.querySelector('[data-reel-gallery-lightbox-counter]') : null;
  const prevButton = lightbox ? lightbox.querySelector('[data-reel-gallery-lightbox-prev]') : null;
  const nextButton = lightbox ? lightbox.querySelector('[data-reel-gallery-lightbox-next]') : null;

  // Element focused before the lightbox opened, so we can restore it on close.
  let lastFocused = null;
  // Images the lightbox steps through, read when it opens so a variation swap
  // or a late-loaded slide is picked up.
  let images = [];
  let current = 0;

  const show = (index) => {
    const img = images[index];
    const source = img ? nav.largeSrc(img) : '';
    if (!source) {
      return false;
    }

    current = index;
    lightboxImage.src = source;
    lightboxImage.alt = img.alt || '';
    if (caption && extra.lightboxCaption) {
      caption.textContent = img.alt || '';
      caption.hidden = !img.alt;
    }
    if (counter) {
      counter.textContent = images.length > 1
        ? (extra.counterLabel || '%1$d / %2$d').replace('%1$d', String(index + 1)).replace('%2$d', String(images.length))
        : '';
    }
    return true;
  };

  const step = (delta) => {
    if (images.length > 1) {
      show(nav.step(current, delta, images.length));
    }
  };

  const openLightbox = (img) => {
    if (!lightbox || !lightboxImage) {
      return;
    }

    images = [...document.querySelectorAll(REEL_GALLERY_IMAGES)];
    if (!images.includes(img)) {
      images = [img];
    }
    const index = images.indexOf(img);

    lastFocused = document.activeElement instanceof HTMLElement ? document.activeElement : null;
    if (!show(index)) {
      return;
    }
    [prevButton, nextButton].forEach((button) => {
      if (button) {
        button.hidden = images.length < 2;
      }
    });
    lightbox.hidden = false;
    document.body.classList.add('reel-gallery-lightbox-open');

    if (closeButton && typeof closeButton.focus === 'function') {
      closeButton.focus();
    } else if (typeof lightbox.focus === 'function') {
      lightbox.focus();
    }
  };

  const closeLightbox = () => {
    if (!lightbox || lightbox.hidden) {
      return;
    }

    lightbox.hidden = true;
    document.body.classList.remove('reel-gallery-lightbox-open');

    if (lastFocused && typeof lastFocused.focus === 'function' && document.contains(lastFocused)) {
      lastFocused.focus();
    }
    lastFocused = null;
  };

  // Two-finger pinch zoom on touch screens. One finger is left to the browser
  // and the slider, so the page still scrolls and the gallery still swipes.
  // A double tap or a slide change puts the image back.
  const pinchResets = [];

  const setupPinch = (img) => {
    const pointers = new Map();
    let scale = 1;
    let x = 0;
    let y = 0;
    let start = null;
    let lastTap = 0;

    const apply = () => {
      img.style.transform = `translate3d(${x}px, ${y}px, 0) scale(${scale})`;
    };

    const reset = () => {
      scale = 1;
      x = 0;
      y = 0;
      start = null;
      img.classList.remove('reel-gallery-pinched');
      img.style.transform = '';
    };

    const pinchPoint = () => {
      const [a, b] = [...pointers.values()];
      return {
        mx: (a.x + b.x) / 2,
        my: (a.y + b.y) / 2,
        d: Math.hypot(a.x - b.x, a.y - b.y) || 1,
      };
    };

    img.classList.add('reel-gallery-pinch');

    img.addEventListener('pointerdown', (event) => {
      if (event.pointerType !== 'touch') {
        return;
      }
      pointers.set(event.pointerId, { x: event.clientX, y: event.clientY });

      if (pointers.size === 2) {
        // Scaling keeps the centre in place and the translate moves it, so the
        // untransformed centre is the current centre minus the translate.
        const rect = img.getBoundingClientRect();
        const cx = rect.left + rect.width / 2 - x;
        const cy = rect.top + rect.height / 2 - y;
        const p = pinchPoint();
        start = {
          cx,
          cy,
          d: p.d,
          s: scale,
          // Image point under the fingers, kept under them while pinching.
          qx: (p.mx - cx - x) / scale,
          qy: (p.my - cy - y) / scale,
        };
        img.classList.add('reel-gallery-pinched');
      }
    });

    img.addEventListener('pointermove', (event) => {
      if (!pointers.has(event.pointerId)) {
        return;
      }
      pointers.set(event.pointerId, { x: event.clientX, y: event.clientY });

      if (!start || pointers.size < 2) {
        return;
      }
      const p = pinchPoint();
      scale = Math.min(4, Math.max(1, (start.s * p.d) / start.d));
      x = p.mx - start.cx - scale * start.qx;
      y = p.my - start.cy - scale * start.qy;
      apply();
    });

    const release = (event) => {
      pointers.delete(event.pointerId);
      if (pointers.size < 2) {
        start = null;
        if (scale <= 1.01) {
          reset();
        }
      }
    };
    img.addEventListener('pointerup', release);
    img.addEventListener('pointercancel', release);

    // Two fingers belong to the pinch: keep them from the browser's own zoom
    // and from the slider's swipe, which listens further up the tree.
    img.addEventListener('touchmove', (event) => {
      if (event.touches.length > 1) {
        event.preventDefault();
        event.stopPropagation();
      }
    }, { passive: false });

    // While zoomed, a tap does not open the lightbox or follow the link; a
    // second tap within 350 ms resets the zoom. Registered before the lightbox
    // handler so it can stop it.
    img.addEventListener('click', (event) => {
      if (scale === 1) {
        return;
      }
      event.preventDefault();
      event.stopImmediatePropagation();
      const now = Date.now();
      if (now - lastTap < 350) {
        reset();
        lastTap = 0;
      } else {
        lastTap = now;
      }
    });

    pinchResets.push([img, reset]);
  };

  document.querySelectorAll(REEL_GALLERY_IMAGES).forEach((img) => {
    if (config.enableZoom && window.PointerEvent) {
      setupPinch(img);
    }

    if (allowZoom) {
      img.style.setProperty('--reel-gallery-zoom-scale', String(config.zoomScale || 1.45));
      img.classList.add('reel-gallery-zoomable');
    }

    if (config.enableLightbox) {
      // Make the image operable by keyboard, since a bare <img> is neither
      // focusable nor activatable with Enter/Space.
      img.classList.add('reel-gallery-lightbox-trigger');
      if (!img.hasAttribute('tabindex')) {
        img.setAttribute('tabindex', '0');
      }
      img.setAttribute('role', 'button');
      if (config.triggerLabel && !img.getAttribute('aria-label')) {
        img.setAttribute('aria-label', config.triggerLabel);
      }

      // The image sits inside a link to the full-size file. Without this the
      // browser followed it and left the page behind the lightbox.
      img.addEventListener('click', (event) => {
        event.preventDefault();
        openLightbox(img);
      });
      img.addEventListener('keydown', (event) => {
        if (event.key === 'Enter' || event.key === ' ' || event.key === 'Spacebar') {
          event.preventDefault();
          openLightbox(img);
        }
      });
    }
  });

  // The slider marks the visible slide with a class; when that moves, a zoomed
  // image that is no longer on screen goes back to normal.
  if (pinchResets.length && window.MutationObserver) {
    const observer = new MutationObserver(() => {
      pinchResets.forEach(([img, reset]) => {
        const slide = img.closest('.woocommerce-product-gallery__image');
        if (img.style.transform && slide && !slide.classList.contains('flex-active-slide')) {
          reset();
        }
      });
    });
    document.querySelectorAll('.woocommerce-product-gallery__image').forEach((slide) => {
      observer.observe(slide, { attributes: true, attributeFilter: ['class'] });
    });
  }

  document.addEventListener('click', (event) => {
    if (!lightbox || lightbox.hidden) {
      return;
    }

    const target = event.target;
    if (!(target instanceof Element)) {
      return;
    }

    if (target.closest('[data-reel-gallery-lightbox-prev]')) {
      step(-1);
      return;
    }
    if (target.closest('[data-reel-gallery-lightbox-next]')) {
      step(1);
      return;
    }

    const close = target.closest('[data-reel-gallery-lightbox-close]');
    const clickedLightbox = target.closest('[data-reel-gallery-lightbox]');

    if (close || (clickedLightbox === target && config.showBackdropClose !== false)) {
      closeLightbox();
    }
  });

  document.addEventListener('keydown', (event) => {
    if (!lightbox || lightbox.hidden) {
      return;
    }

    if (event.key === 'Escape') {
      closeLightbox();
      return;
    }

    if (event.key === 'ArrowLeft' || event.key === 'ArrowRight') {
      event.preventDefault();
      step(event.key === 'ArrowLeft' ? -1 : 1);
      return;
    }

    // Keep Tab cycling through the dialog's own buttons so focus can't escape
    // behind the modal.
    if (event.key === 'Tab') {
      const controls = [closeButton, prevButton, nextButton].filter((el) => el && !el.hidden);
      if (!controls.length) {
        return;
      }
      event.preventDefault();
      const at = controls.indexOf(document.activeElement);
      controls[at < 0 ? 0 : nav.step(at, event.shiftKey ? -1 : 1, controls.length)].focus();
    }
  });

  // Swipe left or right anywhere in the open lightbox to step through the
  // gallery.
  if (lightbox) {
    let swipeStart = null;
    lightbox.addEventListener('pointerdown', (event) => {
      swipeStart = event.pointerType === 'mouse' ? null : { x: event.clientX, y: event.clientY };
    });
    lightbox.addEventListener('pointerup', (event) => {
      if (!swipeStart) {
        return;
      }
      const dx = event.clientX - swipeStart.x;
      const dy = event.clientY - swipeStart.y;
      swipeStart = null;
      if (Math.abs(dx) > 40 && Math.abs(dx) > Math.abs(dy)) {
        step(dx < 0 ? 1 : -1);
      }
    });
    lightbox.addEventListener('pointercancel', () => {
      swipeStart = null;
    });
  }
});
