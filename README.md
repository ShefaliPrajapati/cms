 Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Installation Steps

- clone project into your www/htdocs dir by running below command 
``git clone https://shefaliprajapati@bitbucket.org/shefalipotter/cms.git``

- Goto dir ``cd cms``
- Run ``composer install``
- Set ``.env`` file credential to yours 
    ``DB_CONNECTION=mysql
    
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=cms
      DB_USERNAME=root
      DB_PASSWORD=root
  ``
 - Run command `` php artisan migrate:fresh`` 
 - Register users and check 
