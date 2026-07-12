=== Plogins Reel - Product Gallery Zoom & Video for WooCommerce ===
Contributors: motylanogha
Tags: woocommerce, product gallery, product video, image zoom, gallery slider
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.1
Stable tag: 1.0.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

WooCommerce-Produktgalerie-Upgrades: Bildzoom, Galerie-Lightbox, Galerie-Slider-Steuerung und Produktvideo. Kein jQuery.

== Description ==

Reel erweitert die WooCommerce-Einzelproduktgalerie um Produktbild-Zoom, eine barrierefreie Galerie-Lightbox und ein hervorgehobenes Produktvideo:

* <strong>Hover-Zoom.</strong> Galeriebilder vergrößern sich beim Darüberfahren in einer von dir eingestellten Zoomstufe (1.0× bis
  3.0×). Die Transformation wird auf den Galerierahmen beschnitten, sodass der Rest der Seite
  unverändert bleibt.
* <strong>Barrierefreie Lightbox.</strong> Klicke oder drücke Enter/Leertaste auf ein Galeriebild, um
  es im Vollbild zu öffnen. Die Lightbox ist per Tastatur bedienbar: Tab bleibt auf dem Schließen-
  Button, sodass der Fokus nicht hinter die Überlagerung rutschen kann, Escape schließt sie, und der Fokus
  kehrt zum geöffneten Bild zurück. Es ist eine feste Überlagerung, die anfangs verborgen ist und daher
  keinen Platz reserviert, bis sie genutzt wird.
* <strong>Hervorgehobenes Video.</strong> Zeige ein produktspezifisches Video – eine selbst gehostete MP4/WebM-Datei oder eine
  YouTube/Vimeo-(oEmbed)-URL – nach der Galerie oder vor der Produktzusammenfassung.
  Das Video sitzt in einem 16:9-Rahmen, der mit `aspect-ratio` dimensioniert ist, sodass sein Platz
  vor dem Laden reserviert ist.

Das Markup wird in PHP erstellt und durch eine Datei aus reinem JavaScript
(ohne jQuery) progressiv erweitert, verzögert und in der Fußzeile geladen. Skripte und Styles werden
nur auf der Einzelproduktseite eingebunden.

Die Einstellungen liegen unter einem Admin-Menü der obersten Ebene <strong>Reel</strong>. Jedes der drei Features
hat einen eigenen Ein/Aus-Schalter; du kannst außerdem die Zoomstufe festlegen und sie auf Touch-
Geräten überspringen, eine Alt-Text-Beschriftung in der Lightbox anzeigen, die Steuerung zum Öffnen des Bildes
für Screenreader umbenennen sowie Position, Autoplay, Überschrift und Einleitungstext
des Videos wählen. Die produktspezifische Video-URL stammt aus dem Produkt-Meta-Feld `_reel_video_url`,
mit optionalem `_reel_video_title` als Überschrift für dieses Produkt.

Um das Video außerhalb des Galeriebereichs zu platzieren, füge den `[reel_video]`-
Shortcode (mit den Attributen `id` und `title`) oder den Block <strong>Reel: Featured video</strong>
in beliebige Produktinhalte ein. Beide rendern das Video des aktuellen Produkts im
gleichen 16:9-Rahmen.

Quellcode und Issue-Tracker: https://github.com/wppoland/plogins-reel — das Plugin wird
quelloffen entwickelt, Fehlerberichte und Pull Requests sind dort willkommen.

= Documentation and links =

* <strong>Dokumentation</strong> - https://plogins.com/de/reel/docs/
* <strong>Plugin-Seite</strong> - https://plogins.com/de/reel/
* <strong>Quellcode</strong> - https://github.com/wppoland/plogins-reel
* <strong>Fehlerberichte und Funktionswünsche</strong> - https://github.com/wppoland/plogins-reel/issues


= Features =

* Galeriebild-Hover-Zoom mit konfigurierbarer Stufe.
* Barrierefreie, per Tastatur bedienbare Vollbild-Lightbox (Escape / Schließen per Hintergrund).
* Hervorgehobenes Produktvideo (selbst gehostet oder oEmbed) mit wählbarer Position.
* `[reel_video]`-Shortcode und ein «Reel: Featured video»-Block, um das Video überall zu platzieren.
* Optionale Lightbox-Beschriftung aus dem Alt-Text des Bildes.
* Hover-Zoom auf Touch-Geräten überspringen (wo Hover unzuverlässig ist).
* Eigene barrierefreie Beschriftung für die Steuerung „In Lightbox öffnen“.
* Standard-Videoüberschrift und optionaler Einleitungsabsatz.
* Durchgängig Markup mit reserviertem Platz, also kein Cumulative Layout Shift.
* Kein jQuery; ein verzögertes Skript in der Fußzeile, nur auf Produktseiten geladen.
* Unabhängiger Ein/Aus-Schalter für jedes Feature.
* Link «Einstellungen» in der Plugin-Liste; saubere Deinstallation entfernt Plugin-Optionen.
* Übersetzungsbereit: mitgelieferte .pot-Vorlage plus polnische Übersetzung (pl_PL).
* Kompatibel mit HPOS und Warenkorb-/Kassen-Blöcken.

== Installation ==

1. Lade das Plugin nach `/wp-content/plugins/plogins-reel` hoch oder installiere es über Plugins → Neu hinzufügen.
2. Aktiviere es. WooCommerce muss aktiv sein.
3. Öffne das Menü <strong>Reel</strong> und aktiviere die gewünschten Features.
4. Für ein Produktvideo setze die Video-URL im Produkt-Meta `_reel_video_url`.

== Frequently Asked Questions ==

= Does it require WooCommerce? =

Ja. Reel ist ein WooCommerce-Produktgalerie-Plugin und läuft auf Einzelproduktseiten.

= Which video sources are supported? =

Selbst gehostete Dateien (MP4, M4V, WebM, OGV) werden mit dem nativen Video-
Player von WordPress abgespielt. Jede oEmbed-fähige URL (YouTube, Vimeo usw.) wird automatisch eingebettet.

= Does it use jQuery? =

Nein. Reel liefert eine Datei aus reinem JavaScript, verzögert und in der Fußzeile geladen,
und nur auf der Einzelproduktseite.

= Does Reel replace the WooCommerce product gallery? =

Nein. Reel erweitert die bestehende WooCommerce-Produktgalerie um Bildzoom, Lightbox-Verhalten und optionales Produktvideo.

= Can I show a product video outside the gallery? =

Ja. Verwende den `[reel_video]`-Shortcode oder den «Reel: Featured video»-Block, um das Produktvideo in benutzerdefinierten Produktinhalten zu platzieren.

= Will it cause layout shift (CLS)? =

Nein. Die Lightbox ist eine feste, anfangs verborgene Überlagerung, die Zoom-Transformation wird
auf den Galerierahmen beschnitten, und das Video sitzt in einem Rahmen mit festem Seitenverhältnis, der
seinen Platz vor dem Laden reserviert.

= Is the lightbox keyboard accessible? =

Ja. Kunden können Bilder mit Enter oder Leertaste öffnen, mit Escape schließen, und der Fokus kehrt zum Bild zurück, das die Lightbox geöffnet hat.


= Does this plugin work on WordPress Multisite? =

Ja. Dieses Plugin ist mit WordPress Multisite kompatibel. Aktiviere es netzwerkweit oder auf einzelnen Websites; jede Website behält ihre eigenen Einstellungen und Daten.

== Screenshots ==

1. Galerie-Hover-Zoom auf einer Einzelproduktseite.
2. Die barrierefreie Vollbild-Lightbox.
3. Ein hervorgehobenes Produktvideo unter der Galerie.
4. Der Reel-Einstellungsbildschirm.

== External Services ==

Reel führt keine eigenen API-Aufrufe oder Analyseanfragen durch; Zoom-, Lightbox- und selbstgehostete Video-Features laufen vollständig auf deiner Website, und die einzigen Daten, die Reel speichert, sind die Optionen `reel_settings` und `reel_db_version` sowie die Meta-Felder `_reel_video_url` und `_reel_video_title` jedes Produkts.

Die einzige Ausnahme ist, wenn du die Video-URL eines Produkts auf einen YouTube-, Vimeo- oder anderen oEmbed-Link setzt. In diesem Fall ruft `wp_oembed_get()` des WordPress-Kerns das Einbettungs-Markup von diesem Anbieter ab und sendet die Video-URL an den von dir gewählten Anbieter, damit dieser den Player zurückgeben kann; Reel speichert das Ergebnis in einem Transient, um wiederholte Anfragen zu vermeiden. Für selbst gehostete (MP4/WebM-)Videos wird keine Anfrage gestellt. Die Nutzung dieser Anbieter unterliegt deren eigenen Bedingungen und Datenschutzrichtlinien, z. B. YouTube (https://www.youtube.com/t/terms, https://policies.google.com/privacy) und Vimeo (https://vimeo.com/terms, https://vimeo.com/privacy).

== Translations ==

Plogins Reel enthält deutsche, polnische und spanische Übersetzungen für die Plugin-Oberfläche. Die Textdomain ist `plogins-reel`, sodass Sprachpakete von WordPress.org diese mitgelieferten Übersetzungen ebenfalls überschreiben oder erweitern können.

== Changelog ==

= 1.0.2 =
* Mitgelieferte deutsche, polnische und spanische Übersetzungen für die Plugin-Oberfläche hinzugefügt.

= 1.0.1 =
* Erste stabile Version.

= 0.2.1 =
* Für einen markanteren Plugin-Namen in Plogins Reel für WooCommerce umbenannt.

= 0.2.0 =
* Neu gestalteter Einstellungsbildschirm: Kartenlayout, Kippschalter, Inline-Hilfe-Tooltips und eine Live-Steuerung der Zoomstärke.
* Ausgereiftes Shop-Styling: thematisierbare CSS-Custom-Properties, fluides Sizing, Dark-Mode-Unterstützung und Reduced-Motion-Schutz.
* Barrierefreiheit: benannte Lightbox-Dialoge, role=tooltip-Hilfe, sichtbare Fokusstile und volle Tastaturbedienbarkeit.
* Robustheit: elegante Leer-/Platzhalterzustände, ein Video-Skeleton ohne Layoutverschiebung und gehärtete Ereignisbehandlung.
* `[reel_video]`-Shortcode und einen «Reel: Featured video»-Block hinzugefügt, um das hervorgehobene Video überall zu platzieren.
* Lightbox-Beschriftung (aus dem Bild-Alt-Text) und Option zum Überspringen des Hover-Zooms auf Touch-Geräten hinzugefügt.
* Einstellungen für die Beschriftung „In Lightbox öffnen“, eine Standard-Videoüberschrift und einen optionalen Einleitungsabsatz hinzugefügt.
* Link «Einstellungen» in der Plugin-Liste und eine Deinstallationsroutine, die Plugin-Optionen entfernt, hinzugefügt.
* Übersetzungsvorlage (languages/reel.pot) und polnische Übersetzung mitgeliefert.

= 0.1.0 =
* Erstveröffentlichung: Galerie-Hover-Zoom, barrierefreie Lightbox und hervorgehobenes Produktvideo.
