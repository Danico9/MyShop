<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).



### Modificaicones

Usuario: danic/admin

\\wsl$\Ubuntu-24.04\home\danic\development\laravel\MyShop


# Mientras se esta desarrollando con la consola abierta para que lo haga automaticamente
sail npm run dev

# Cuando termina, aunque estaba haciendose de forma automatica, hay que hacerlo para que se guarde los cambios
Ctrl + C
sail npm run build

# Durante el desarrollo se utiliza sail npm run dev.

# Compila una sola vez
# Genera los archivos finales en public/build
# Antes de la entrega o despliegue, se ejecuta sail npm run build.

## Iniciar los contenedores
sail up -d

## Levantanr los contenedores de docker (asegurarme de que tengo que entrar antes a XAMPP para pararlo y de esta forma no me ocupe los mismos puertos y me de error):
sail up -d --build

# Entrar a localhost:
http://localhost/


## Reiniciar/resetear la base de datos (migraciones + seeders)
sail artisan migrate:refresh --seed


## Actualizar estructura + datos SIN borrar tablas
sail artisan migrate
sail artisan db:seed




# **Como funciona todo:**

# Arquitectura de Desarrollo en Laravel Sail: ¿Cómo funciona la "Magia"?

Este documento explica el flujo de trabajo interno de nuestro entorno de desarrollo. Si alguna vez te has preguntado por qué los cambios en el código se reflejan instantáneamente en el navegador sin necesidad de compilar o reiniciar el servidor, la respuesta radica en la sinergia de tres tecnologías: **Docker (Volúmenes)**, **PHP (Intérprete)** y **Vite (HMR)**.

## 1. El Cimiento: Docker Volumes (El "Espejo")

Aunque el servidor se ejecuta dentro de un contenedor (una "mini máquina virtual" de Linux), Docker utiliza una funcionalidad crítica llamada **Bind Mounts** (Volúmenes).

### ¿Cómo funciona?

Docker crea un vínculo en tiempo real entre tu sistema operativo (Host) y el contenedor.

-   **Tu entorno:** La carpeta del proyecto en Windows/Linux.

-   **Entorno Docker:** La carpeta `/var/www/html` dentro del contenedor.


> **Analogía:** Imagina que tienes dos puertas para entrar a la misma habitación. Si tiras un papel al suelo entrando por la Puerta A (Tu Windows), cualquiera que entre por la Puerta B (Docker) verá ese papel inmediatamente. **No son copias, es el mismo archivo físico en el disco.**

**Resultado:** Latencia cero. El contenedor "ve" el archivo modificado en el mismo milisegundo en que guardas en VS Code.

----------

## 2. El Motor: PHP (Lenguaje Interpretado)

A diferencia de lenguajes compilados como Java, C++ o C# (que requieren transformar el código a binario/exe y reiniciar el proceso), PHP es un lenguaje **interpretado**.

### El Ciclo de Vida de una Petición (Request Lifecycle)

PHP opera bajo un modelo de "Morir en cada petición":

1.  El navegador solicita una página.

2.  PHP lee el archivo `.php` del disco **en ese preciso instante**.

3.  Procesa el código, genera HTML y lo envía.

4.  El proceso se cierra y limpia la memoria.


**Resultado:** Como Docker (punto 1) ya actualizó el archivo al instante, cuando refrescas el navegador, PHP lee y ejecuta el código nuevo. No hace falta "reconstruir" nada.

----------

## 3. La Automatización: Vite (El "Vigilante")

Aquí es donde entra el **HMR (Hot Module Replacement)**. Para evitar que tengas que pulsar `F5` manualmente, usamos Vite (`npm run dev`).

### Componentes de Vite:

1.  **File Watcher:** Un proceso en Node.js que vigila tus carpetas. Si detecta un cambio en la fecha de modificación de un archivo, activa una alerta.

2.  **WebSockets:** Inyecta un pequeño script invisible en tu navegador que mantiene un canal de comunicación abierto con el servidor de desarrollo.


### Flujo de Actualización Automática

-   **Cambios en CSS:** Vite inyecta el nuevo estilo directamente sin recargar (el color cambia al instante).

-   **Cambios en PHP/Blade:** Vite detecta el cambio estructural y envía la señal `window.location.reload()` al navegador.


----------

## Resumen del Flujo de Trabajo

Cuando presionas `Ctrl + S` en tu editor, ocurre esta reacción en cadena:

1.  **Editor:** Guarda el archivo en tu disco duro físico.

2.  **Docker:** El cambio es visible inmediatamente dentro del contenedor Linux gracias a los _Volúmenes_.

3.  **Vite:** El _Watcher_ detecta el cambio y envía un mensaje por _WebSocket_ al navegador.

4.  **Navegador:** Recibe la orden y recarga la página.

5.  **PHP:** Lee el código fresco del disco y sirve la nueva versión.


----------

## Guía de Comandos: `up` vs `up --build`

Es vital entender la diferencia para optimizar tiempos de desarrollo.

### `sail up -d` (El habitual)

-   **Uso:** 99% de las veces.

-   **Acción:** Enciende los contenedores existentes.

-   **Velocidad:** Muy rápida.

-   **Cuándo usarlo:** Para empezar a trabajar, cambios de código (rutas, controladores, vistas).


### `sail up -d --build` (Mantenimiento)

-   **Uso:** Solo cuando cambias la infraestructura.

-   **Acción:** Destruye los contenedores viejos y construye nuevos basándose en cambios del `Dockerfile`.

-   **Velocidad:** Lenta.

-   **Cuándo usarlo:**

    -   Instalar una nueva extensión de PHP.

    -   Cambiar la versión de MySQL o PHP.

    -   Modificar el archivo `docker-compose.yml`.


----------

**Nota:** La única vez que necesitas ejecutar un comando manual extra tras guardar código es si modificas la estructura de la Base de Datos (migraciones), donde requerirás `sail artisan migrate`.


# Cuando usar o no los comandos:

Para entender por qué no necesitas ejecutar comandos constantemente, debemos distinguir entre **Infraestructura** (el servidor) y **Código Fuente** (tu aplicación).

Aquí tienes la explicación técnica estricta:

### 1. El concepto de "Proceso en Ejecución" (Daemon)

Cuando ejecutas `sail up -d`, estás iniciando procesos de servidor (Nginx, PHP-FPM, MySQL) que se quedan **residentes en la memoria RAM**. Estos procesos están en un bucle infinito esperando peticiones HTTP.

-   **Estado:** El servidor está "encendido" (Running).

-   **Comportamiento:** No carga tu código en memoria de forma permanente. Simplemente espera una petición.


Si vuelves a ejecutar `sail up -d` cuando ya está corriendo, Docker detecta que los contenedores ya están en estado "Running" y no hace nada. Sería un comando redundante.

### 2. Diferencia entre "Tiempo de Construcción" y "Tiempo de Ejecución"

Aquí está la clave de tu duda.

#### A. Infraestructura (Build Time / Tiempo de Construcción)

-   **Comando:** `sail up -d --build`

-   **Qué altera:** El sistema operativo del contenedor.

-   **Explicación:** Imagina que tu servidor Linux necesita tener instalada la librería `gd` para procesar imágenes. Eso es software del sistema, no código tuyo. Si modificas el archivo `Dockerfile` para añadir esa librería, necesitas "reconstruir" la imagen del sistema operativo.

-   **Frecuencia:** Muy baja (una vez al mes, o al iniciar el proyecto).


#### B. Código de Aplicación (Runtime / Tiempo de Ejecución)

-   **Acción:** Guardar un archivo `.php` o `.js`.

-   **Qué altera:** Un archivo de texto en el disco duro.

-   **Explicación:** Cuando llega una petición al servidor (que ya está corriendo desde el paso 1), el servidor lee el archivo de texto **en ese preciso instante**.

    -   Si cambias el código, el archivo en el disco cambia.

    -   La siguiente vez que el servidor lea el disco (cuando recargas la página), leerá el texto nuevo.

-   **Frecuencia:** Constante (cada minuto mientras programas).

### Tabla Técnica de Decisiones

Esta tabla resume exactamente cuándo debes interactuar con la terminal y cuándo no.

| Tipo de Cambio        | Ejemplo                                                     | ¿Requiere comando Sail?        | Razón Técnica                                                                 |
|----------------------|-------------------------------------------------------------|--------------------------------|--------------------------------------------------------------------------------|
| Lógica de Código     | Cambiar un if, una variable, una vista HTML, una ruta.      | NO                             | PHP interpreta el archivo desde el disco en cada petición. El cambio ya está ahí. |
| Estilos / Frontend   | Cambiar CSS, Vue, React, JS.                                | NO                             | Vite detecta el cambio de archivo y lo inyecta al navegador (HMR).             |
| Datos                | Insertar un usuario manualmente en la DB.                  | NO                             | La base de datos es un servicio persistente; los datos se guardan al instante. |
| Estructura de BD     | Crear una nueva tabla o columna (Migration).               | SÍ (artisan migrate)           | Necesitas ejecutar un script específico para alterar el esquema de la base de datos. |
| Configuración PHP    | Instalar una extensión de PHP (ej. Redis, Imagick).        | SÍ (up --build)                | Estás cambiando los binarios del servidor, necesitas recompilar el contenedor. |
| Dependencias         | Instalar una librería nueva (composer require ...).        | A VECES (sail up)              | Solo si la librería requiere reiniciar el servicio para ser detectada (raro en PHP moderno). |



### Resumen del Flujo Técnico

1.  **Inicio de la jornada:** Ejecutas `sail up -d`. Esto asigna recursos de CPU y RAM y levanta los servicios (PHP, MySQL). **El servidor pasa a estado ACTIVO.**

2.  **Desarrollo:** Editas archivos. Gracias al montaje de volúmenes del sistema de archivos, el proceso ACTIVO de PHP tiene acceso directo a tus ediciones. No necesitas reiniciar el proceso para que "vea" los archivos, porque los lee bajo demanda.

3.  **Fin de la jornada:** Ejecutas `sail stop` para liberar la RAM de tu ordenador.


**Conclusión:** Solo tocas la terminal para gestionar el **ciclo de vida del servidor** (encender/apagar) o para cambiar su **arquitectura** (instalar software base). Para programar, el servidor simplemente "sirve" lo que tú guardas.
