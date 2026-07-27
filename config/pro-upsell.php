<?php
/**
 * PRO upsell content, generated from the plogins.com registry by
 * scripts/gen-pro-upsell.mjs. The admin upsell renders this; curate the
 * feature list to fit this plugin's settings screen (do not invent features).
 *
 * @package plogins-reel-pro
 */

defined('ABSPATH') || exit;

return [
    'name'       => 'Reel Pro',
    'url'        => 'https://plogins.com/plogins-reel-pro/pricing/',
    'sellable'   => true,
    'price_from' => 19,
    'currency'   => 'EUR',
    'price_pln'  => 85,
    'lead'       => [
        'en' => 'External video embeds, per-variation galleries, 360° spin, autoplay rules and CDN lazy media ship in the current PRO release.',
        'pl' => 'Wszystkie funkcje PRO, osadzenia wideo, galeria per wariant, spin 360°, reguły autoplay i CDN lazy media, są dostępne w bieżącym wydaniu.',
    ],
    'features'   => [
        [
            'en' => ['title' => 'External video embeds', 'desc' => 'Reel tab on the product editor: YouTube, Vimeo or direct .mp4/.webm URL plus optional title. Rendered through the free Reel media engine.'],
            'pl' => ['title' => 'Osadzenia wideo zewnętrzne', 'desc' => 'Zakładka Reel w edytorze produktu: URL YouTube, Vimeo lub bezpośredni .mp4/.webm plus opcjonalny tytuł. Render przez silnik mediów free Reel.'],
        ],
        [
            'en' => ['title' => 'Per-variation gallery', 'desc' => 'Assign gallery images from the media library to each variation. The storefront gallery swaps when a variation is selected and restores when cleared.'],
            'pl' => ['title' => 'Galeria per wariant', 'desc' => 'Przypisz zestaw obrazów z biblioteki mediów do każdego wariantu. Galeria na froncie przełącza się przy wyborze wariantu i wraca po wyczyszczeniu.'],
        ],
        [
            'en' => ['title' => '360-degree spin', 'desc' => 'Ordered spin frames on the Reel tab; drag/swipe/keyboard viewer with reserved aspect ratio above the gallery.'],
            'pl' => ['title' => 'Spin 360 stopni', 'desc' => 'Sekwencja klatek na zakładce Reel; viewer z przeciąganiem, swipe i klawiszami strzałek, z zarezerwowanym aspect ratio.'],
        ],
        [
            'en' => ['title' => 'Video autoplay rules', 'desc' => 'Reel → Video Autoplay: skip mobile autoplay, play in-view only and respect prefers-reduced-motion when FREE autoplay is on.'],
            'pl' => ['title' => 'Reguły autoplay wideo', 'desc' => 'Reel → Video Autoplay: bez autoplay na mobile, start po wejściu w viewport i szacunek prefers-reduced-motion, gdy autoplay w FREE jest włączony.'],
        ],
        [
            'en' => ['title' => 'CDN & lazy media', 'desc' => 'Reel → CDN Media: rewrite upload URLs to a CDN origin and defer spin-frame preloads and self-hosted video until in-view.'],
            'pl' => ['title' => 'CDN i leniwe media', 'desc' => 'Reel → CDN Media: przepisywanie URL-i uploadów na CDN oraz opóźnione ładowanie klatek spinu i self-hosted wideo do wejścia w viewport.'],
        ],
    ],
];
