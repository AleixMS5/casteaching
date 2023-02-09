## TROUBLESHOOTING

### Error: @vitejs/plugin-vue requires vue (>=3.2.25) to be present in the dependency tree.


Instal·leu 

``` 
npm i vue@3.2.26
```

### Instal·lació de vue amb Vite

```
npm i vue@3.2.26
npm install --save-dev @vitejs/plugin-vue
``` 

i al fitxer config de vite (vite.config.js) cal importar el nou plugin:

``` 
import vue from '@vitejs/plugin-vue';
```

I posar el plugin vue:


```
    vue({
            template: {
                transformAssetUrls: {
                    // The Vue plugin will re-write asset URLs, when referenced
                    // in Single File Components, to point to the Laravel web
                    // server. Setting this to `null` allows the Laravel plugin
                    // to instead re-write asset URLs to point to the Vite
                    // server instead.
                    base: null,

                    // The Vue plugin will parse absolute URLs and treat them
                    // as absolute paths to files on disk. Setting this to
                    // `false` will leave absolute URLs un-touched so they can
                    // reference assets in the public directory as expected.
                    includeAbsolute: false,
                },
            },
        }),
``` 

Podeu veure com queda el fitxer en aquest repositori.

Executeu npm run dev i comprovau no dona cap error. Ja reniu vue instal·lat

### Error migració model_has_permissions de laravel permissions


L'error és:

```
$ php artisan migrate:refresh --seed
...
SQLSTATE[HY000]: General error: 1 near ")": syntax error (SQL: create table "model_has_permissions" ("" integer not null, "model_type" varchar not null, "model_id" integer not null, foreign key() references "permissions"("id") on delete cascade, primary key ("", "model_id", "model_type")))
```

Si us passa això és que us heu instal·lat just la versió 5.9.0 que té un error. A la 5.9.1 s'arregla. Per canviar-ho:

editeu el fitxer composer.json i canvieu 5.9.0 del paquet laravel permission per 5.9.1

I executeu:

```
rm -rf vendor
composer update
composer install
rm -rf database/migrations/*_create_permission_tables.php
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"\n
``
10138  php artisan migrate:refresh --seed
10139  php artisan migrate:fresh --seed
10140  php artisan cache:clear
10141  php artisan migrate:fresh --seed
10142  php artisan cache:clear
10143  php artisan migrate:fresh --seed
10144  php artisan migrate:refresh --seed
10145  php artisan migrate:refresh
10146  git status
10147  composer show spatie/laravel-permission\n
10148  composer install\n
10149  composer show spatie/laravel-permission\n
10150  git status
10151  composer update
10152  git status
10153  php artisan migrate:refresh --seed
10154  php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"\n
10155  php artisan migrate:refresh --seed
10156  git status
10157  git add .
10158  git commit -m "Forçar actualització del paquet laravel_permission a 5.9.1 per evitar error al executar migracions"
10159  git push origin main
10160  gh browse



















<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
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

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
