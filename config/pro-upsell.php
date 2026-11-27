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
    'campaign'   => 'plogins-reel',
    'locales'    => ['pl', 'de', 'es'],
    'sellable'   => true,
    'price_from' => 19,
    'currency'   => 'EUR',
    'lead'       => [
        'en' => '360° spin, autoplay rules, CDN lazy media and per-variation galleries (WooCommerce before 11.1) ship in the current PRO release.',
        'pl' => 'Wszystkie funkcje PRO, spin 360°, reguły autoplay, CDN lazy media i galeria per wariant (WooCommerce przed 11.1), są dostępne w bieżącym wydaniu.',
    ],
    'features'   => [
        [
            'en' => ['title' => 'Per-variation gallery (WooCommerce before 11.1)', 'desc' => 'Assign gallery images from the media library to each variation. The storefront gallery swaps when a variation is selected and restores when cleared. WooCommerce 11.1 and later have their own variation gallery.'],
            'pl' => ['title' => 'Galeria per wariant (WooCommerce przed 11.1)', 'desc' => 'Przypisz zestaw obrazów z biblioteki mediów do każdego wariantu. Galeria na froncie przełącza się przy wyborze wariantu i wraca po wyczyszczeniu. WooCommerce 11.1 i nowsze mają własną galerię wariantów.'],
        ],
        [
            'en' => ['title' => '360-degree spin', 'desc' => 'Ordered spin frames on the Reel tab; drag/swipe/keyboard viewer with reserved aspect ratio above the gallery.'],
            'pl' => ['title' => 'Spin 360 stopni', 'desc' => 'Sekwencja klatek na zakładce Reel; viewer z przeciąganiem, swipe i klawiszami strzałek, z zarezerwowanym aspect ratio.'],
        ],
        [
            'en' => ['title' => 'Video autoplay rules', 'desc' => 'Reel > Video Autoplay: skip mobile autoplay, play in-view only and respect prefers-reduced-motion when FREE autoplay is on.'],
            'pl' => ['title' => 'Reguły autoplay wideo', 'desc' => 'Reel > Video Autoplay: bez autoplay na mobile, start po wejściu w viewport i szacunek prefers-reduced-motion, gdy autoplay w FREE jest włączony.'],
        ],
        [
            'en' => ['title' => 'CDN & lazy media', 'desc' => 'Reel > CDN Media: rewrite upload URLs to a CDN origin and defer spin-frame preloads and self-hosted video until in-view.'],
            'pl' => ['title' => 'CDN i leniwe media', 'desc' => 'Reel > CDN Media: przepisywanie URL-i uploadów na CDN oraz opóźnione ładowanie klatek spinu i self-hosted wideo do wejścia w viewport.'],
        ],
    ],
];
