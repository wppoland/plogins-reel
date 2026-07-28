=== Plogins Reel - Product Gallery Zoom & Video for WooCommerce ===
Contributors: motylanogha
Tags: woocommerce, product gallery, product video, image zoom, gallery slider
Requires at least: 6.5
Tested up to: 7.0
Requires PHP: 8.1
Stable tag: 1.0.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Mejoras de la galería de productos de WooCommerce: zoom de imagen, lightbox de galería, controles del carrusel de galería y vídeo de producto. Sin jQuery.

== Description ==

Reel mejora la galería de producto individual de WooCommerce con zoom de imagen de producto, un lightbox de galería accesible y un vídeo de producto destacado:

* <strong>Zoom al pasar el cursor.</strong> Las imágenes de la galería se amplían al pasar el cursor con una escala de zoom que tú defines (1.0× a
  3.0×). La transformación se recorta al marco de la galería, así que el resto de la página
  no se mueve.
* <strong>Lightbox accesible.</strong> Haz clic o pulsa Intro/Espacio en cualquier imagen de la galería para
  abrirla a pantalla completa. El lightbox se puede usar con el teclado: Tab permanece en el botón de
  cierre para que el foco no se escape detrás de la superposición, Escape lo cierra y el foco
  vuelve a la imagen que lo abrió. Es una superposición fija que empieza oculta, así que
  no reserva espacio hasta que se usa.
* <strong>Vídeo destacado.</strong> Muestra un vídeo por producto, un archivo MP4/WebM autohospedado o una
  URL de YouTube/Vimeo (oEmbed), después de la galería o antes del resumen del producto.
  El vídeo va en un marco 16:9 dimensionado con `aspect-ratio`, así que su espacio queda reservado
  antes de cargarse.

El marcado se construye en PHP y se mejora progresivamente con un archivo de JavaScript puro
(sin jQuery), diferido y cargado en el pie de página. Los scripts y estilos solo se
encolan en la página de producto individual.

Los ajustes están en un menú de administración de nivel superior <strong>Reel</strong>. Cada una de las tres funciones
tiene su propio interruptor de encendido/apagado; también puedes fijar la escala de zoom y omitirla en dispositivos
táctiles, mostrar un pie de foto del texto alternativo en el lightbox, cambiar la etiqueta del control de abrir imagen
para lectores de pantalla y elegir la posición del vídeo, la reproducción automática, el encabezado y el texto
de introducción. La URL del vídeo por producto viene del campo meta del producto `_reel_video_url`,
con un `_reel_video_title` opcional como encabezado de ese producto.

Para colocar el vídeo fuera del área de la galería, inserta el shortcode `[reel_video]`
(acepta los atributos `id` y `title`) o el bloque <strong>Reel: Featured video</strong>
en cualquier contenido del producto. Ambos renderizan el vídeo del producto actual en el
mismo marco 16:9.

Código fuente y seguimiento de incidencias: https://github.com/wppoland/plogins-reel, el plugin se desarrolla
de forma abierta (código abierto), así que los informes de errores y las pull requests son bienvenidos allí.

= Documentation and links =

* <strong>Documentación</strong> - https://plogins.com/es/reel/docs/
* <strong>Página del plugin</strong> - https://plogins.com/es/reel/
* <strong>Código fuente</strong> - https://github.com/wppoland/plogins-reel
* <strong>Informes de errores y peticiones de funciones</strong> - https://github.com/wppoland/plogins-reel/issues


= Features =

* Zoom al pasar el cursor sobre imágenes de la galería con escala configurable.
* Lightbox a pantalla completa accesible y manejable con el teclado (Escape / cierre por fondo).
* Vídeo de producto destacado (autohospedado u oEmbed) con posición seleccionable.
* Shortcode `[reel_video]` y un bloque «Reel: Featured video» para colocar el vídeo en cualquier sitio.
* Pie de foto opcional en el lightbox a partir del texto alternativo de la imagen.
* Omitir el zoom al pasar el cursor en dispositivos táctiles (donde el hover no es fiable).
* Etiqueta de accesibilidad personalizada para el control de abrir en lightbox.
* Encabezado de vídeo predeterminado y párrafo de introducción opcional.
* Marcado con espacio reservado en todo el plugin, sin desplazamiento acumulativo del diseño (CLS).
* Sin jQuery; un script diferido en el pie de página, cargado solo en páginas de producto.
* Interruptor de encendido/apagado independiente para cada función.
* Enlace «Ajustes» en la lista de plugins; la desinstalación limpia elimina las opciones del plugin.
* Listo para traducir: plantilla .pot incluida más traducción al polaco (pl_PL).
* Compatible con HPOS y bloques de carrito/pago.

== Installation ==

1. Sube el plugin a `/wp-content/plugins/plogins-reel` o instálalo desde Plugins → Añadir nuevo.
2. Actívalo. WooCommerce debe estar activo.
3. Entra en el menú <strong>Reel</strong> y activa las funciones que quieras.
4. Para un vídeo de producto, establece la URL del vídeo en el meta del producto `_reel_video_url`.

== Frequently Asked Questions ==

= Does it require WooCommerce? =

Sí. Reel es un plugin de galería de productos de WooCommerce y funciona en páginas de producto individual.

= Which video sources are supported? =

Los archivos autohospedados (MP4, M4V, WebM, OGV) se reproducen con el reproductor de vídeo
nativo de WordPress. Cualquier URL compatible con oEmbed (YouTube, Vimeo, etc.) se incrusta automáticamente.

= Does it use jQuery? =

No. Reel incluye un archivo de JavaScript puro, diferido y cargado en el pie de página,
y solo en la página de producto individual.

= Does Reel replace the WooCommerce product gallery? =

No. Reel mejora la galería de productos existente de WooCommerce con zoom de imagen, comportamiento de lightbox y vídeo de producto opcional.

= Can I show a product video outside the gallery? =

Sí. Usa el shortcode `[reel_video]` o el bloque «Reel: Featured video» para colocar el vídeo del producto en contenido personalizado del producto.

= Will it cause layout shift (CLS)? =

No. El lightbox es una superposición fija que empieza oculta, la transformación de zoom se
recorta al marco de la galería y el vídeo va en un marco de relación de aspecto fija que
reserva su espacio antes de cargarse.

= Is the lightbox keyboard accessible? =

Sí. Los clientes pueden abrir imágenes con Intro o Espacio, cerrar con Escape, y el foco vuelve a la imagen que abrió el lightbox.


= Does this plugin work on WordPress Multisite? =

Sí. Este plugin es compatible con WordPress Multisite. Actívalo en toda la red o en sitios concretos; cada sitio conserva sus propios ajustes y datos.

== Screenshots ==

1. Zoom al pasar el cursor en la galería de una página de producto individual.
2. El lightbox accesible a pantalla completa.
3. Un vídeo de producto destacado debajo de la galería.
4. La pantalla de ajustes de Reel.

== External Services ==

Reel no realiza llamadas API ni solicitudes de analítica propias; las funciones de zoom, lightbox y vídeo autohospedado se ejecutan por completo en tu sitio, y los únicos datos que almacena Reel son las opciones `reel_settings` y `reel_db_version` más los meta `_reel_video_url` y `_reel_video_title` de cada producto.

La única excepción es cuando estableces la URL del vídeo de un producto en un enlace de YouTube, Vimeo u otro enlace oEmbed. En ese caso, el propio `wp_oembed_get()` del núcleo de WordPress obtiene el marcado de inserción de ese proveedor y envía la URL del vídeo al proveedor que elijas para que pueda devolver el reproductor; Reel almacena el resultado en un transitorio para evitar solicitudes repetidas. No se realiza ninguna petición para vídeos autohospedados (MP4/WebM). El uso de esos proveedores se rige por sus propios términos y políticas de privacidad, p. ej. YouTube (https://www.youtube.com/t/terms, https://policies.google.com/privacy) y Vimeo (https://vimeo.com/terms, https://vimeo.com/privacy).

== Translations ==

Plogins Reel incluye traducciones al polaco, al alemán y al español para la interfaz del plugin. El dominio de texto es `plogins-reel`, por lo que los paquetes de idioma de WordPress.org también pueden sobrescribir o ampliar estas traducciones incluidas.

== Changelog ==

= 1.0.2 =
* Se añadieron traducciones incluidas al polaco, al alemán y al español para la interfaz del plugin.

= 1.0.1 =
* Primera versión estable.

= 0.2.1 =
* Renombrado a Plogins Reel para WooCommerce para conseguir un nombre de plugin más distintivo.

= 0.2.0 =
* Pantalla de ajustes rediseñada: diseño en tarjetas, interruptores, información contextual en línea y control en directo de la intensidad del zoom.
* Estilo de tienda pulido: propiedades CSS personalizadas temáticas, tamaño fluido, compatibilidad con modo oscuro y protección de movimiento reducido.
* Accesibilidad: diálogo de lightbox con nombre, ayuda role=tooltip, estilos de foco visibles y manejo completo con teclado.
* Robustez: estados vacíos/de marcador elegantes, esqueleto de vídeo sin saltos de diseño y manejo de eventos reforzado.
* Se añade el shortcode `[reel_video]` y un bloque «Reel: Featured video» para colocar el vídeo destacado en cualquier sitio.
* Se añade pie de foto en lightbox (del texto alternativo de la imagen) y opción para omitir el zoom al pasar el cursor en dispositivos táctiles.
* Se añaden ajustes para la etiqueta de abrir en lightbox, un encabezado de vídeo predeterminado y un párrafo de introducción opcional.
* Se añade un enlace «Ajustes» en la lista de plugins y una rutina de desinstalación que elimina las opciones del plugin.
* Se incluye una plantilla de traducción (languages/reel.pot) y una traducción al polaco.

= 0.1.0 =
* Versión inicial: zoom al pasar el cursor en la galería, lightbox accesible y vídeo de producto destacado.
