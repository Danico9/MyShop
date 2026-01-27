# Proyecto MyShop - Tienda Online con Laravel 

## Descripción del Proyecto
TechValencia es una aplicación web de comercio electrónico completa que he desarrollado utilizando el framework Laravel 12. El objetivo del proyecto es simular el funcionamiento real de una tienda online, gestionando desde el catálogo de productos hasta la tramitación de pedidos y su administración.

El sistema está diseñado con una arquitectura MVC y cuenta con un sistema de roles robusto que diferencia claramente entre clientes y administradores, permitiendo funcionalidades específicas para cada uno, como un panel de gestión privado o un historial de pedidos personal.

---

## Tecnologías Utilizadas

Para el desarrollo he utilizado las siguientes herramientas y versiones:

*   **Backend:** Laravel 12 (PHP 8.4+)
*   **Frontend:** Blade Templates con Tailwind CSS para el diseño.
*   **Base de Datos:** MySQL
*   **Entorno:** Docker a través de Laravel Sail (para asegurar que funcione igual en cualquier máquina).
*   **Autenticación:** Laravel Breeze.

---


## Instrucciones de Instalación

## Como instalar el proyecto en otro pc:

### PARTE 1: Preparar la infraestructura

#### 1. Instalar WSL2 y Ubuntu (En PowerShell como Admin)

Debes habilitar el subsistema de Linux y descargar Ubuntu.

-   Ejecuta: `wsl --install -d Ubuntu-24.04`.

-   Reinicia el equipo. Al volver, crea tu usuario y contraseña de Linux.


#### 2. Instalar Docker Desktop (En Windows)

-   Descarga e instala Docker Desktop. Asegúrate de marcar la opción **"Use WSL 2 based engine"** durante la instalación.

-   Abre Docker Desktop, ve a **Settings > Resources > WSL Integration** y activa el interruptor de **Ubuntu-24.04**.


#### 3. Instalar Visual Studio Code (En Windows)

-   Instala VS Code y luego instala la extensión oficial **WSL** para conectar el editor con Ubuntu.


-   Una vez dentro de VS Code conectado a WSL, instala las extensiones recomendadas: _Laravel Extra Intellisense, PHP Intelephense, Laravel Blade Snippets_, etc. .


#### 4. Instalar herramientas base (Dentro de la terminal de Ubuntu)

Abre tu terminal de Ubuntu (el ubuntu24 que acabamos de instalar danic/admin) y ejecuta lo siguiente para tener PHP y Composer (necesarios para instalar las librerías de tu proyecto antes de que arranque Sail):

-   Actualiza el sistema: `sudo apt update && sudo apt upgrade -y`.

-   Instala utilidades: `sudo apt install -y curl wget unzip build-essential`.

-   Añade el repositorio de PHP: `sudo add-apt-repository ppa:ondrej/php -y` y `sudo apt update`.

-   Instala PHP 8.4: `sudo apt install -y php8.4-cli php8.4-common php8.4-curl php8.4-mbstring php8.4-xml php8.4-mysql`.

-   Instala Composer:

    Bash

    ```
    curl -sS https://getcomposer.org/installer | php
    sudo mv composer.phar /usr/local/bin/composer
    
    ```



----------

### PARTE 2: Clonar desde GitHub

En lugar de crear un proyecto nuevo, vamos a clonar el que tenemos.

#### 1. Clonar el repositorio

En la terminal de Ubuntu:

Bash

```
cd ~
mkdir -p development/laravel
cd development/laravel
git clone https://github.com/Danico9/MyShop
cd MyShop

```


#### 2. Instalar dependencias de PHP (Vendor)

Como la carpeta `vendor` no se sube a GitHub, Sail no existe todavía en este dispositivo. Debes instalarlo:

Bash

```
composer install

```

## Para ir a la ruta de forma manual
`\\wsl$\Ubuntu-24.04\home\[tu_usuario]\development\laravel\[nombre_proyecto]` _(Asegúrate de cambiar `[tu_usuario]` por tu usuario de Linux y `[nombre_proyecto]` por el nombre de tu carpeta)._

_Nota: Esto usará el PHP y Composer que se instalo en la Parte 1._

#### 3. Configurar el entorno (.env)

El archivo de configuración tampoco viaja en GitHub.

-   Copia el ejemplo: `cp .env.example .env`.

-   **Importante:** Edita el archivo `.env` (`nano .env`) y asegúrate de que la configuración de base de datos coincide con la del PDF:

    -   `DB_HOST=mysql`

    -   `DB_USERNAME=sail`

    -   `DB_PASSWORD=password` .



#### 4. Arrancar Sail y Generar Key

-   Si quieres usar el comando corto `sail`, configura el alias: `echo "alias sail='./vendor/bin/sail'" >> ~/.bashrc` y luego `source ~/.bashrc`.

-   Levanta los contenedores: `sail up -d --build`.

-   Genera la clave de encriptación de la app: `sail artisan key:generate`.


#### 5. Configurar la Base de Datos (Manual)

Para crear la base de datos y dar permisos. Si no lo haces, la migración fallará.

1.  Entra a MySQL: `docker exec -it myshop-mysql-1 mysql -u root -ppassword`.

Verificamos que estamos con el usuario root: `SELECT USER();`

2.  Crea la base de datos: `CREATE DATABASE IF NOT EXISTS myshop;` (o el nombre que uses).

3.  Da permisos al usuario sail: `GRANT ALL PRIVILEGES ON myshop.* TO 'sail'@'%';`.

4.  Aplica cambios: `FLUSH PRIVILEGES;` y sal con `exit`.



#### 6. Migraciones y Frontend

Para terminar, llena la base de datos y compila los estilos.

-   Ejecuta migraciones: `sail artisan migrate:refresh --seed`.

-   Instala dependencias de Node: `sail npm install`.

-   Compila los estilos: `sail npm run build`.


----------

**Siguiente paso:** Una vez se realizan estos pasos, se va al navegador en Windows y entra a `http://localhost`. Deberías ver tu proyecto funcionando exactamente igual que en el otro portátil


---

## Usuarios y Roles (Sistema de Permisos)

He implementado un control de acceso basado en un campo `is_admin` en la tabla de usuarios. Esto me permite proteger ciertas rutas mediante un Middleware personalizado.

### 1. Administradores (`is_admin = 1`)

Tienen acceso total al sistema, incluyendo el panel `/admin`.
*   **Usuario Principal:** `admin@tienda.com` / `password`
*   **Usuario Demo:** `demo@example.com` / `password`
*   **Permisos:** Crear/Editar/Eliminar productos, ver todos los pedidos de la tienda, gestionar mensajes de contacto.

### 2. Clientes / Usuarios Normales (`is_admin = 0`)

Solo tienen acceso a la parte pública y a su área privada.
*   **Usuario de Prueba:** `tu@email.com` / `password`
*   **Permisos:** Comprar productos, ver su historial personal "Mis Pedidos", editar su perfil.

---

## Funcionalidades Implementadas

### Carrito de Compras (Lógica Dual)

He programado el carrito para que se comporte diferente según el usuario:
*   **Invitados:** El carrito se guarda en la sesión (`Session`). Al intentar finalizar compra, el sistema avisa de que es una simulación y no guarda nada en la BBDD.
*   **Usuarios Registrados:** El carrito también es persistente, pero al finalizar la compra, se genera un registro real en las tablas `orders` y `order_items`.

### Gestión de Pedidos
*   **Para el Cliente:** He creado una sección "Mis Pedidos" donde el usuario ve solo sus compras. Esto se filtra mediante `where('user_id', auth()->id())` para garantizar la privacidad.
*   **Para el Admin:** Un panel global donde se visualizan todas las ventas de la tienda, con detalles de quién compró, qué productos y el total.

### Sistema de Contacto

El formulario de contacto no solo envía emails (simulado), sino que guarda los mensajes en una tabla `contact_messages`. Los administradores pueden leer y borrar estos mensajes desde su panel.

### Seguridad

He creado un Middleware llamado `AdminMiddleware`. Este actúa de barrera: si un usuario intenta entrar a una ruta `/admin` y no tiene el rol correcto, el sistema lo bloquea automáticamente (Error 403), independientemente de si conoce la URL.

---

## Estructura de Base de Datos (Tablas Clave)

*   **`users`**: Tabla estándar de Laravel modificada con la columna `is_admin`.
*   **`products`**: Contiene la información del catálogo (precio, descripción, ruta de imagen).
*   **`orders`**: Almacena la cabecera del pedido (ID usuario, precio total, estado).
*   **`order_items`**: Tabla pivote que guarda qué productos había en cada pedido y el precio que tenían en ese momento (snapshot).
*   **`contact_messages`**: Almacenamiento persistente de las dudas de los usuarios.
