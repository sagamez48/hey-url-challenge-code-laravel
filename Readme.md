# HeyURL! Code Challenge

## Overview
HeyURL! is a service to create awesome friendly URLs to make it easier for
people to remember. Our team developed some mock views but they lack our awesome
functionality.

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

## Spec for generating short URLs

- It MUST have 5 characters in length e.g. NELNT
- It MUST generate only upper case letters
- It MUST NOT generate special characters
- It MUST NOT generate whitespace
- It MUST be unique
- `short_url` attribute should store only the generated code

## Considerations

1. Check routes defined in `routes/web.rb`
2. Check controller actions in `app/Http/Controllers/UrlController.rb`
3. Check views in `resources/views/urls/`
4. Check models in `app/*`
5. Google Charts is already added to display charts, you can use any library
6. Use the `jenssegers/agent` lib already installed to extract information about each click tracked

## API - Optional Bonus Points

We would like to have a way to retrieve the last 10 URLs created using an API
endpoint. It should be JSON-API complaint. Here is an example of a response from
the API:

```
{
  "data": [
    {
      "type": "urls",
      "id": "1",
      "attributes": {
        "created-at": "2018-08-15T02:48:08.642Z",
        "original-url": "www.fullstacklabs.co/angular-developers",
        "url": "https://domain/fss1",
        "clicks": 2
      },
      "relationships": {
        "clicks": {
          "data": [
            {
              "id": 1,
              "type": "clicks"
            }
          ]
        }
      }
    }
  ],
  "included": [
    {
      "type": "clicks",
      "id": 1,
      "attributes": {
        ...
      }
    }
  ]
}
```

## Accomplishment
- Completed functionality 65%
- Completed test 20%
- Completed bonus 15%
