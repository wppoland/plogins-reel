=== Plogins Reel - Product Video Gallery for WooCommerce ===
Contributors: motylanogha
Tags: woocommerce, product gallery, product video, image zoom, gallery slider
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.1
Stable tag: 1.0.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

WooCommerce product gallery upgrades: image zoom, gallery lightbox, gallery slider controls and product video. No jQuery.

== Description ==

Reel upgrades the WooCommerce single product gallery with product image zoom, an accessible gallery lightbox and a featured product video:

* <strong>Hover zoom.</strong> Gallery images magnify on hover at a zoom scale you set (1.0× to
  3.0×). The transform is clipped to the gallery frame, so the rest of the page
stays put.
* <strong>Accessible lightbox.</strong> Click, or press Enter/Space, on any gallery image to
  open it full screen. The lightbox is keyboard-operable: Tab stays on the close
  button so focus can't slip behind the overlay, Escape closes it, and focus
  returns to the image you opened. It's a fixed overlay that starts hidden, so it
  reserves no space until used.
* <strong>Featured video.</strong> Show a per-product video, a self-hosted MP4/WebM file or a
  YouTube/Vimeo (oEmbed) URL, after the gallery or before the product summary.
  The video sits in a 16:9 frame sized with `aspect-ratio`, so its space is held
  before it loads.

The markup is built in PHP and progressively enhanced by one vanilla-JavaScript
file (no jQuery), deferred and loaded in the footer. Scripts and styles only
enqueue on the single product page.

Settings live under a top-level <strong>Reel</strong> admin menu. Each of the three features
has its own on/off switch; you can also set the zoom scale and skip it on touch
devices, show an alt-text caption in the lightbox, relabel the open-image control
for screen readers, and choose the video's position, autoplay, heading and intro
text. The per-product video URL comes from the `_reel_video_url` product meta
field, with an optional `_reel_video_title` for that product's heading.

To place the video somewhere other than the gallery area, drop the `[reel_video]`
shortcode (it takes `id` and `title` attributes) or the <strong>Reel: Featured video</strong>
block into any product content. Both render the current product's video in the
same 16:9 frame.

Source and issue tracker: https://github.com/wppoland/plogins-reel, the plugin is
developed in the open, so bug reports and pull requests are welcome there.

= Documentation and links =

* <strong>Documentation</strong> - https://plogins.com/es/reel/docs/
* <strong>Plugin page</strong> - https://plogins.com/es/reel/
* <strong>Source code</strong> - https://github.com/wppoland/plogins-reel
* <strong>Bug reports and feature requests</strong> - https://github.com/wppoland/plogins-reel/issues


= Features =

* Gallery image hover zoom with a configurable scale.
* Accessible, keyboard-operable full-screen lightbox (Escape / backdrop close).
* Featured product video (self-hosted or oEmbed) with selectable position.
* `[reel_video]` shortcode and a "Reel: Featured video" block to place the video anywhere.
* Optional lightbox caption from the image alt text.
* Skip hover zoom on touch devices (where hover is unreliable).
* Custom accessible label for the open-in-lightbox control.
* Default video heading and optional intro paragraph.
* Reserved-space markup throughout, so no Cumulative Layout Shift.
* No jQuery; one deferred, in-footer script loaded only on product pages.
* Independent on/off toggle for each feature.
* "Settings" link on the plugins list; clean uninstall removes plugin options.
* Translation-ready: bundled .pot template plus a Polish (pl_PL) translation.
* HPOS and cart/checkout blocks compatible.

== Installation ==

1. Upload the plugin to `/wp-content/plugins/plogins-reel`, or install via Plugins → Add New.
2. Activate it. WooCommerce must be active.
3. Go to the <strong>Reel</strong> menu and enable the features you want.
4. For a product video, set the video URL in the product's `_reel_video_url` meta.

== Frequently Asked Questions ==

= Does it require WooCommerce? =

Yes. Reel is a WooCommerce product gallery plugin and runs on single product pages.

= Which video sources are supported? =

Self-hosted files (MP4, M4V, WebM, OGV) are played with WordPress's native video
player. Any oEmbed-supported URL (YouTube, Vimeo, etc.) is embedded automatically.

= Does it use jQuery? =

No. Reel ships one vanilla-JavaScript file, deferred and loaded in the footer,
and only on the single product page.

= Does Reel replace the WooCommerce product gallery? =

No. Reel enhances the existing WooCommerce product gallery with image zoom, lightbox behaviour and optional product video.

= Can I show a product video outside the gallery? =

Yes. Use the `[reel_video]` shortcode or the "Reel: Featured video" block to place the product video in custom product content.

= Will it cause layout shift (CLS)? =

No. The lightbox is a fixed overlay that starts hidden, the zoom transform is
clipped to the gallery frame, and the video sits in a fixed-ratio frame that
reserves its space before loading.

= Is the lightbox keyboard accessible? =

Yes. Shoppers can open images with Enter or Space, close with Escape, and focus returns to the image that opened the lightbox.


= Does this plugin work on WordPress Multisite? =

Yes. This plugin is compatible with WordPress Multisite. Network activate it or activate it on individual sites; each site keeps its own settings and data.

== Screenshots ==

1. Gallery hover zoom on a single product page.
2. The accessible full-screen lightbox.
3. A featured product video below the gallery.
4. The Reel settings screen.

== External Services ==

Reel no realiza llamadas API ni solicitudes de análisis propias; las funciones de zoom, lightbox y video autohospedado se ejecutan completamente en tu sitio, y los únicos datos que almacena Reel son las opciones `reel_settings` y `reel_db_version` más los meta `_reel_video_url` y `_reel_video_title` de cada producto.

La única excepción es cuando configura la URL del video de un producto en un enlace de YouTube, Vimeo u otro enlace integrado. En ese caso, el propio `wp_oembed_get()` del núcleo de WordPress obtiene el marcado de inserción de ese proveedor y envía la URL del vídeo al proveedor que elegiste para que pueda devolver el reproductor; Reel almacena en caché el resultado de forma transitoria para evitar solicitudes repetidas. No se realizan solicitudes de vídeos autohospedados (MP4/WebM). El uso de dichos proveedores se rige por sus propios términos y políticas de privacidad, p. YouTube (https://www.youtube.com/t/terms, https://policies.google.com/privacy) y Vimeo (https://vimeo.com/terms, https://vimeo.com/privacy).

== Changelog ==

= 1.0.1 =
* Primera versión estable.

= 0.2.1 =
* Renombrado a Plogins Reel para WooCommerce para obtener un nombre de complemento más distintivo.

= 0.2.0 =
* Pantalla de configuración rediseñada: diseño de tarjeta, interruptores de palanca, información sobre herramientas de ayuda en línea y control de intensidad del zoom en vivo.
* Estilo de escaparate pulido: propiedades personalizadas de CSS temáticas, tamaño fluido, compatibilidad con modo oscuro y protecciones de movimiento reducido.
* Accesibilidad: cuadro de diálogo con nombre, función = ayuda con información sobre herramientas, estilos de enfoque visibles y operatividad completa del teclado.
* Robustez: elegantes estados vacíos/de marcador de posición, un esqueleto de vídeo sin cambios de diseño y manejo de eventos reforzado.
* Añade el código corto `[reel_video]` y un bloque "Reel: Video destacado" para colocar el video destacado en cualquier lugar.
* Añade un título de caja de luz (del texto alternativo de la imagen) y una opción para omitir el zoom al pasar el mouse en dispositivos táctiles.
* Añade configuraciones para la etiqueta de apertura en lightbox, un encabezado de video predeterminado y un párrafo de introducción opcional.
* Añade un enlace "Configuración" en la lista de complementos y una rutina de desinstalación que elimine las opciones de complementos.
* Incluye una plantilla de traducción (idiomas/reel.pot) y una traducción al polaco.

= 0.1.0 =
* Lanzamiento inicial: zoom al desplazarse por la galería, caja de luz accesible y video del producto destacado.
