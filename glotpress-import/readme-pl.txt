=== Plogins Reel - Product Gallery Zoom & Video for WooCommerce ===
Contributors: motylanogha
Tags: woocommerce, product gallery, product video, image zoom, gallery slider
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.1
Stable tag: 1.0.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Ulepszenia galerii produktów WooCommerce: powiększenie obrazu, lightbox galerii, sterowanie suwakiem galerii i wideo produktu. Bez jQuery.

== Description ==

Reel ulepsza galerię pojedynczego produktu WooCommerce o powiększenie obrazu produktu, dostępny lightbox galerii i polecane wideo produktu:

* <strong>Powiększenie po najechaniu.</strong> Obrazy w galerii powiększają się po najechaniu kursorem w ustawionej przez Ciebie skali (1.0× do
  3.0×). Transformacja jest przycinana do ramki galerii, więc reszta strony
  pozostaje na miejscu.
* <strong>Dostępny lightbox.</strong> Kliknij lub naciśnij Enter/Spację na dowolnym obrazie galerii, aby
  otworzyć go na pełnym ekranie. Lightbox obsługuje klawiaturę: Tab pozostaje na przycisku
  zamknięcia, więc fokus nie ucieka za nakładkę, Escape go zamyka, a fokus
  wraca do obrazu, który go otworzył. To stała nakładka początkowo ukryta, więc
  nie rezerwuje miejsca, dopóki nie zostanie użyta.
* <strong>Polecane wideo.</strong> Pokaż wideo dla każdego produktu, plik MP4/WebM hostowany na własnym serwerze lub
  adres URL YouTube/Vimeo (oEmbed), po galerii lub przed podsumowaniem produktu.
  Wideo znajduje się w ramce 16:9 wymiarowanej przez `aspect-ratio`, więc jego miejsce jest zarezerwowane
  przed załadowaniem.

Znaczniki są budowane w PHP i progresywnie ulepszane przez jeden plik czystego JavaScriptu
(bez jQuery), ładowany z opóźnieniem w stopce. Skrypty i style są
dołączane tylko na stronie pojedynczego produktu.

Ustawienia znajdują się w menu administracyjnym najwyższego poziomu <strong>Reel</strong>. Każda z trzech funkcji
ma własny przełącznik włącz/wyłącz; możesz też ustawić skalę powiększenia i pominąć ją na urządzeniach
dotykowych, pokazać podpis z tekstu alternatywnego w lightboxie, zmienić etykietę kontrolki otwierania obrazu
dla czytników ekranu oraz wybrać pozycję wideo, autoodtwarzanie, nagłówek i tekst
wprowadzenia. Adres URL wideo dla produktu pochodzi z pola meta produktu `_reel_video_url`,
z opcjonalnym `_reel_video_title` jako nagłówkiem tego produktu.

Aby umieścić wideo poza obszarem galerii, wstaw shortcode `[reel_video]`
(przyjmuje atrybuty `id` i `title`) lub blok <strong>Reel: Polecane wideo</strong>
w dowolnej treści produktu. Oba renderują wideo bieżącego produktu w tej samej
ramce 16:9.

Kod źródłowy i zgłaszanie problemów: https://github.com/wppoland/plogins-reel, wtyczka jest
rozwijana otwarcie (open source), więc zgłoszenia błędów i pull requesty są tam mile widziane.

= Documentation and links =

* <strong>Dokumentacja</strong> - https://plogins.com/pl/reel/docs/
* <strong>Strona wtyczki</strong> - https://plogins.com/pl/reel/
* <strong>Kod źródłowy</strong> - https://github.com/wppoland/plogins-reel
* <strong>Zgłoszenia błędów i propozycje funkcji</strong> - https://github.com/wppoland/plogins-reel/issues


= Features =

* Powiększenie obrazów galerii po najechaniu z konfigurowalną skalą.
* Dostępny, obsługiwany klawiaturą lightbox na pełnym ekranie (Escape / zamknięcie tłem).
* Polecane wideo produktu (hostowane na własnym serwerze lub oEmbed) z wybieralną pozycją.
* Shortcode `[reel_video]` i blok «Reel: Polecane wideo» do umieszczenia wideo w dowolnym miejscu.
* Opcjonalny podpis lightboxa z tekstu alternatywnego obrazu.
* Pomijanie powiększenia po najechaniu na urządzeniach dotykowych (gdzie hover jest zawodny).
* Własna etykieta dostępności dla kontrolki otwierania w lightboxie.
* Domyślny nagłówek wideo i opcjonalny akapit wprowadzenia.
* Znaczniki z zarezerwowanym miejscem w całej wtyczce, więc bez skumulowanego przesunięcia układu (CLS).
* Bez jQuery; jeden skrypt z opóźnieniem w stopce, ładowany tylko na stronach produktów.
* Niezależny przełącznik włącz/wyłącz dla każdej funkcji.
* Link «Ustawienia» na liście wtyczek; czysta dezinstalacja usuwa opcje wtyczki.
* Gotowe do tłumaczenia: dołączony szablon .pot oraz tłumaczenie polskie (pl_PL).
* Zgodne z HPOS oraz blokami koszyka/kasy.

== Installation ==

1. Prześlij wtyczkę do `/wp-content/plugins/plogins-reel` lub zainstaluj przez Wtyczki → Dodaj nową.
2. Włącz ją. WooCommerce musi być aktywne.
3. Wejdź w menu <strong>Reel</strong> i włącz funkcje, których potrzebujesz.
4. Dla wideo produktu ustaw adres URL wideo w meta produktu `_reel_video_url`.

== Frequently Asked Questions ==

= Does it require WooCommerce? =

Tak. Reel to wtyczka galerii produktów WooCommerce i działa na stronach pojedynczego produktu.

= Which video sources are supported? =

Pliki hostowane na własnym serwerze (MP4, M4V, WebM, OGV) są odtwarzane natywnym odtwarzaczem
wideo WordPressa. Każdy adres URL obsługiwany przez oEmbed (YouTube, Vimeo itd.) jest osadzany automatycznie.

= Does it use jQuery? =

Nie. Reel dostarcza jeden plik czystego JavaScriptu, ładowany z opóźnieniem w stopce,
tylko na stronie pojedynczego produktu.

= Does Reel replace the WooCommerce product gallery? =

Nie. Reel ulepsza istniejącą galerię produktów WooCommerce o powiększenie obrazu, zachowanie lightboxa i opcjonalne wideo produktu.

= Can I show a product video outside the gallery? =

Tak. Użyj shortcode’u `[reel_video]` lub bloku «Reel: Polecane wideo», aby umieścić wideo produktu w niestandardowej treści produktu.

= Will it cause layout shift (CLS)? =

Nie. Lightbox to stała nakładka początkowo ukryta, transformacja powiększenia jest
przycinana do ramki galerii, a wideo znajduje się w ramce o stałym proporcjach, która
rezerwuje miejsce przed załadowaniem.

= Is the lightbox keyboard accessible? =

Tak. Klienci mogą otwierać obrazy klawiszami Enter lub Spacja, zamykać klawiszem Escape, a fokus wraca do obrazu, który otworzył lightbox.


= Does this plugin work on WordPress Multisite? =

Tak. Ta wtyczka jest zgodna z WordPress Multisite. Włącz ją w całej sieci lub na poszczególnych witrynach; każda witryna zachowuje własne ustawienia i dane.

== Screenshots ==

1. Powiększenie galerii po najechaniu na stronie pojedynczego produktu.
2. Dostępny lightbox na pełnym ekranie.
3. Polecane wideo produktu pod galerią.
4. Ekran ustawień Reel.

== External Services ==

Reel nie wykonuje własnych wywołań API ani żądań analitycznych; funkcje powiększenia, lightboxa i wideo hostowanego na własnym serwerze działają w całości w Twojej witrynie, a jedyne dane, które Reel przechowuje, to opcje `reel_settings` i `reel_db_version` oraz meta `_reel_video_url` i `_reel_video_title` każdego produktu.

Jedynym wyjątkiem jest ustawienie adresu URL wideo produktu na link YouTube, Vimeo lub inny link oEmbed. W takim przypadku `wp_oembed_get()` rdzenia WordPressa pobiera znaczniki osadzenia od tego dostawcy, wysyłając adres URL wideo do wybranego dostawcy, aby mógł zwrócić odtwarzacz; Reel buforuje wynik w transiencie, aby uniknąć powtarzających się żądań. Dla wideo hostowanych na własnym serwerze (MP4/WebM) nie jest wysyłane żadne żądanie. Korzystanie z tych dostawców podlega ich własnym warunkom i politykom prywatności, np. YouTube (https://www.youtube.com/t/terms, https://policies.google.com/privacy) i Vimeo (https://vimeo.com/terms, https://vimeo.com/privacy).

== Translations ==

Wtyczka Plogins Reel zawiera polskie, niemieckie i hiszpańskie tłumaczenia interfejsu wtyczki. Domena tekstowa to `plogins-reel`, więc pakiety językowe z WordPress.org mogą również nadpisywać lub rozszerzać te dołączone tłumaczenia.

== Changelog ==

= 1.0.2 =
* Dodano dołączone polskie, niemieckie i hiszpańskie tłumaczenia interfejsu wtyczki.

= 1.0.1 =
* Pierwsza stabilna wersja.

= 0.2.1 =
* Zmieniono nazwę na Plogins Reel dla WooCommerce, aby uzyskać bardziej charakterystyczną nazwę wtyczki.

= 0.2.0 =
* Przeprojektowany ekran ustawień: układ kart, przełączniki, podpowiedzi wbudowanej pomocy i kontrola siły powiększenia na żywo.
* Dopracowany styl sklepu: niestandardowe właściwości CSS z motywem, płynne dopasowywanie rozmiaru, obsługa trybu ciemnego i ochrona przed ruchem (reduced motion).
* Dostępność: nazwane okno dialogowe lightboxa, pomoc role=tooltip, widoczne style fokusu i pełna obsługa klawiatury.
* Solidność: eleganckie stany puste/zastępcze, szkielet wideo bez przesunięcia układu i utwardzona obsługa zdarzeń.
* Dodano shortcode `[reel_video]` i blok «Reel: Polecane wideo», aby umieścić polecane wideo w dowolnym miejscu.
* Dodano podpis lightboxa (z tekstu alternatywnego obrazu) i opcję pominięcia powiększenia po najechaniu na urządzeniach dotykowych.
* Dodano ustawienia etykiety otwierania w lightboxie, domyślnego nagłówka wideo i opcjonalnego akapitu wprowadzenia.
* Dodano link «Ustawienia» na liście wtyczek i procedurę dezinstalacji usuwającą opcje wtyczki.
* Dołączono szablon tłumaczenia (languages/reel.pot) i tłumaczenie polskie.

= 0.1.0 =
* Pierwsza wersja: powiększenie galerii po najechaniu, dostępny lightbox i polecane wideo produktu.
