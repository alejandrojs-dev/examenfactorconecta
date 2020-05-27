<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Acerca de la aplicación 🚀

Es una API REST que se encarga de la administración de usuarios usando las operaciones básicas CRUD (Crear, Leer, Actualizar y Borrar)

## Descarga del proyecto 🔧

Para descargar el proyecto se debe ejecutar el siguiente comando de git:

```
git clone https://github.com/alejandrojs-dev/examenfactorconecta.git
```

## Instalación de dependencias Laravel 🔧

Una vez descargado el proyecto, procedemos a descargar las dependencias de composer con el comando;

```
composer install
```

## Archivo .env ⚙️

Por cuestion de seguridad el archivo .env no se encuentra en el repositorio pero se puede generar un archivo .env nuevo
y copiar el contenido que se encuentra en el archivo .env.example para tener accesso a los datos de conexión de la base de datos y la aplicación

## Migraciones y Seeders ⚙️

Una vez creada la base de datos en base a la variable de entorno del archivo .env, se deben correr las migraciones existentes. Para esto utilizamos el comando:

```
php artisan migrate
```

Si queremos ejeuctar las migraciones y a su vez los seeders existentes, utilizamos el comando:

```
php artisan migrate --seed
```

Una alternativa para ejecutar los seeders por separado seria:

```
php artisan db:seed
```

O si se quiere ejecutar un seeder en especifico

```
php artisan db:seed --class=UsersTableSeeder
```

En caso de que se necesiten eliminar las tablas y volver a crearlas se puede utilizar el comando:

```
php artisan migrate:fresh
```

## Iniciar aplicación Laravel ⚙️

Posterior a los pasos anteriores, iniciamos la aplicación laravel ejecutando el comando:

```
php artisan serve
```

## Instalación de dependencias Vue 🔧

Para descargar las dependencias utilizadas en la aplicación cliente se debe ejecutar el comando:

```
npm install
```

## Iniciar aplicación Vue ⚙️

Posterior a la descarga de las dependencias ejecutamos el siguiente comando para iniciar la aplicación Vue:

```
npm run dev
```

## Aplicación construida en 🛠️

* [VueJs](https://vuejs.org/) - Framework frontend usado para las interfaces de usuario
* [Laravel](https://laravel.com/) - Framework backend usado para la lógica de la aplicación
* [NPM](https://www.npmjs.com/) - Manejador de dependencias

## Autores ✒️

* **Israel Alejandro Loera Pérez** - *Desarrollo de la aplicación* - [alejandrojs-dev](https://github.com/alejandrojs-dev)
