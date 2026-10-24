// Lightbox navigation helpers in assets/js/gallery-zoom.js: the full-size
// source (H-07) and the wrap-around step (H-08).
// Run: node tests/gallery-nav-check.mjs
import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';
import vm from 'node:vm';

const window = {};
vm.runInNewContext(readFileSync(new URL('../assets/js/gallery-zoom.js', import.meta.url), 'utf8'), {
  window,
  document: { addEventListener() {} },
});
const { step, largeSrc } = window.reelGalleryNav;

assert.equal(step(0, 1, 3), 1);
assert.equal(step(2, 1, 3), 0, 'next wraps to the first image');
assert.equal(step(0, -1, 3), 2, 'previous wraps to the last image');
assert.equal(step(0, 1, 1), 0);
assert.equal(step(0, 1, 0), 0);

const img = (attrs, href) => ({
  currentSrc: 'gallery-600.jpg',
  src: 'gallery-600.jpg',
  getAttribute: (name) => attrs[name] ?? null,
  closest: () => (href ? { getAttribute: () => href } : null),
});
assert.equal(largeSrc(img({ 'data-large_image': 'full.jpg' }, 'link.jpg')), 'full.jpg');
assert.equal(largeSrc(img({}, 'link.jpg')), 'link.jpg', 'falls back to the wrapping link');
assert.equal(largeSrc(img({})), 'gallery-600.jpg', 'last resort is the rendered source');

console.log('gallery-nav-check: OK');
