# Interfaz de Usuario

## Descripción general

La interfaz de usuario de MesaTI Municipal fue diseñada con un enfoque institucional, considerando que el sistema está orientado al uso interno de funcionarios municipales.

El diseño utiliza una estructura clara, colores asociados a la Municipalidad de San Joaquín, logo institucional, accesos rápidos y bloques informativos que permiten orientar al usuario desde la página principal.

## Objetivo de la interfaz

El objetivo de la interfaz es permitir que el usuario comprenda rápidamente la finalidad del sistema y pueda acceder a las principales secciones disponibles.

La plataforma busca entregar una experiencia simple, ordenada y coherente con un entorno municipal, evitando una sobrecarga visual y priorizando la claridad de la información.

## Diseño institucional

El diseño visual considera elementos propios de una plataforma institucional:

- Logo municipal visible en el encabezado.
- Barra superior con identificación del sistema.
- Colores institucionales aplicados en encabezados, tarjetas y botones.
- Menú de navegación simple.
- Tarjetas de acceso rápido.
- Información del servicio y datos de contacto.
- Lenguaje formal y orientado al usuario funcionario.

## Página principal

La página principal presenta una portada institucional del sistema MesaTI Municipal.

Esta portada incluye:

- Accesos rápidos para funcionario, administración y registro.
- Información del servicio.
- Datos de contacto del área informática.
- Presentación general del sistema.
- Resumen del flujo de registro, seguimiento y gestión TI.

La portada fue diseñada para entregar una primera impresión clara del sistema y facilitar la navegación hacia las funciones principales.

## Inspiración visual

La distribución de la portada se trabajó tomando como referencia estilos actuales de prototipado de interfaces, similares a los diseños que pueden generarse con herramientas como Google Stitch.

No se realizó una copia directa de una plantilla, sino que se tomó como inspiración el uso de tarjetas, bloques visuales, colores institucionales, microinteracciones y una distribución moderna adaptada al contexto municipal.

## Dinamismo de la interfaz

Se incorporaron efectos visuales suaves para mejorar la experiencia de usuario, tales como:

- Animación de entrada en la portada.
- Movimiento suave en tarjetas al pasar el mouse.
- Efecto visual en accesos rápidos.
- Sombras dinámicas.
- Interacción visual en el bloque TI.

Estos efectos buscan entregar una sensación más moderna sin perder el carácter formal e institucional del sistema.

## Vistas desarrolladas

Las principales vistas implementadas son:

- Página principal.
- Login visual.
- Registro visual.
- Panel funcionario.
- Formulario de creación de requerimiento.
- Listado de requerimientos.
- Detalle de requerimiento.
- Administración de requerimientos.
- Gestión de requerimiento.

## Layout reutilizable

El sistema utiliza un layout principal reutilizable ubicado en `resources/views/layout.blade.php`.

Este archivo contiene la estructura común del sistema:

- Encabezado.
- Logo municipal.
- Barra de navegación.
- Contenedor principal.
- Footer.
- Estilos generales.
- Estilos para componentes visuales.
- Estilos para etiquetas de estado.

El uso de este layout permite mantener una apariencia uniforme en todas las páginas del sistema.

## Componente reutilizable de estado

Se creó un componente Blade reutilizable para mostrar el estado de los requerimientos.

El archivo del componente se encuentra en `resources/views/components/estado.blade.php`.

Este componente permite mostrar estados como:

- Pendiente.
- En revisión.
- En proceso.
- Resuelto.
- Cerrado.
- Rechazado.

Cada estado se muestra mediante una etiqueta visual con color diferenciado, mejorando la lectura y comprensión del seguimiento del requerimiento.

## Navegación del sistema

La interfaz permite navegar entre las principales secciones del sistema mediante enlaces y botones.

Las secciones principales son:

- Inicio.
- Login.
- Registro.
- Panel funcionario.
- Crear requerimiento.
- Mis requerimientos.
- Detalle del requerimiento.
- Administración de requerimientos.
- Gestión administrativa del requerimiento.

## Conclusión

La interfaz de MesaTI Municipal permite presentar el sistema de forma clara, ordenada e institucional.

La estructura visual facilita la navegación del usuario y entrega una base coherente para el funcionamiento del sistema, manteniendo una línea gráfica asociada al contexto municipal.