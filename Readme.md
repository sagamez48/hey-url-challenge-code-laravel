# HeyURL! Code Challenge

## Getting Started

1. Clone repository

2. Setup Homestead(optional)

3. Install dependencies
```sh
$ composer install
```

1. Clone repository
2. Composer install
3. Modify .env
  ```
    DB_DATABASE=hey_url_challenge_laravel
    DB_USERNAME=<-- your local pg role
  ```
4. createdb hey_url_challenge_laravel
5. php artisan migrate
6. php artisan serve
7. Open localhost:8000

## Requirements

- Implement actions to create shorter URLs based on a given full URL
- If URL is not valid, the application returns an error message to the user
- We want to be able to provide click metrics to our users for each URL in the
system. Every time that someone clicks a short URL, it should record that click
and also user platform and browser using the user agent request header
- We want to create a metrics panel for the user to view the stats for every
short URL. The user should be able to see total clicks per day on the current
month along with a breakdown of browsers and platforms
- If someone tries to visit a invalid short URL then it should return a custom
404 page
- Unit Tests should be created which cover the code that is added as applicable

## Considerations

1. Check routes defined in `routes/web.rb`
2. Check controller actions in `app/Http/Controllers/UrlController.rb`
3. Check views in `resources/views/urls/`
4. Check models in `app/*`
5. Google Charts is already added to display charts, you can use any library
6. Use the `jenssegers/agent` lib already installed to extract information about each click tracked
