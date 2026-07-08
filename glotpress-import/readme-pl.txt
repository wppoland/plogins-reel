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

* <strong>Documentation</strong> - https://plogins.com/pl/reel/docs/
* <strong>Plugin page</strong> - https://plogins.com/pl/reel/
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

Reel nie wykonuje własnych wywołań API ani żądań analitycznych; funkcje zoomu, lightboxa i wideo hostowane na własnym serwerze działają całkowicie w Twojej witrynie, a jedyne dane, jakie Reel przechowuje, to opcje `reel_settings` i `reel_db_version` oraz meta `_reel_video_url` i `_reel_video_title` każdego produktu.

Jedynym wyjątkiem jest ustawienie adresu URL filmu produktu na link do YouTube, Vimeo lub innego łącza oEmbed. W takim przypadku funkcja `wp_oembed_get()' rdzenia WordPressa pobiera znaczniki do umieszczenia na stronie od tego dostawcy, wysyłając adres URL wideo do wybranego dostawcy, aby mógł zwrócić odtwarzacz; Reel buforuje wynik w trybie przejściowym, aby uniknąć powtarzających się żądań. Nie składa się żadnych próśb o filmy wideo hostowane samodzielnie (MP4/WebM). Korzystanie z usług tych dostawców podlega ich własnym warunkom i politykom prywatności, m.in. YouTube (https://www.youtube.com/t/terms, https://policies.google.com/privacy) i Vimeo (https://vimeo.com/terms, https://vimeo.com/privacy).

== Changelog ==

= 1.0.1 =
* Pierwsza stabilna wersja.

= 0.2.1 =
* Zmieniono nazwę na Plogins Reel dla WooCommerce, aby uzyskać bardziej charakterystyczną nazwę wtyczki.

= 0.2.0 =
* Przeprojektowany ekran ustawień: układ kart, przełączniki, podpowiedzi wbudowanej pomocy i kontrola siły powiększenia na żywo.
* Dopracowana stylistyka witryny sklepowej: niestandardowe właściwości CSS z motywem, płynne dopasowywanie rozmiaru, obsługa trybu ciemnego i osłony o zmniejszonym ruchu.
* Dostępność: nazwane okno dialogowe Lightbox, pomoc dotycząca roli = podpowiedzi, widoczne style fokusu i pełna funkcjonalność klawiatury.
* Solidność: eleganckie stany puste/zastępcze, szkielet wideo bez zmiany układu i ulepszona obsługa zdarzeń.
* Dodaj krótki kod `[reel_video]` i blok „Reel: Polecane wideo”, aby umieścić polecany film w dowolnym miejscu.
* Dodaj podpis lightbox (z tekstu alternatywnego obrazu) i opcję pominięcia powiększania po najechaniu myszką na urządzeniach dotykowych.
* Dodaj ustawienia etykiety open-in-lightbox, domyślnego nagłówka wideo i opcjonalnego akapitu wprowadzającego.
* Dodaj link „Ustawienia” do listy wtyczek i procedurę odinstalowywania, która usuwa opcje wtyczek.
* Połącz szablon tłumaczenia (języki/reel.pot) i tłumaczenie na język polski.

= 0.1.0 =
* Pierwsza wersja: powiększenie galerii po najechaniu myszką, dostępny lightbox i polecany film o produkcie.
