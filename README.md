## Installation

To get started, make sure you have [Docker installed](https://docs.docker.com/docker-for-mac/install/) on your system, and then clone this repository.

Navigate in your terminal screen to the directory you cloned this, and spin up the containers for the web server by running `docker-compose up -d --build`.

The following are built for our web server, with their exposed ports detailed:

Three additional containers are included that handle Composer, NPM, and Artisan commands *without* having to have these platforms installed on your local computer. Use the following command examples from your project root, modifying them to fit your particular use case.

- `docker-compose run --rm composer install`
- `docker-compose run --rm artisan migrate`
- `docker-compose run --rm artisan queue:work`

Front-end side does not developed by me but i append npm container to docker-compose in case you want to develop it
- `docker-compose run --rm npm run dev`


## Usage

###   Register

Endpoint : http://localhost/api/auth/register

Request Payload Without Reference Code

    {
    	"name": "test",
    	"email": "test@yandex.com.tr",
    	"password": "password",
    	"password_confirmation": "password"
    }

Request Payload With Reference Code

    {
    	"name": "test",
    	"email": "test@yandex.com",
    	"password": "password",
    	"password_confirmation": "password",
    	"reference_code":"60eb50301973c"
    }

Response

    {
      "status": "Success",
      "message": null,
      "data": {
        "user": {
          "name": "test",
          "email": "test@yandex.com",
          "reference_code": "60eb57155d3b9",
          "updated_at": "2021-07-11T20:39:49.000000Z",
          "created_at": "2021-07-11T20:39:49.000000Z",
          "id": 9
        },
        "token": "8|zZVb6m1Ux3qwrZtVQs5aFfsIyXlGIItaRLP7cG9C"
      }
    }

------

### Login

Endpoint : http://localhost/api/auth/login

Request

    {
        "email":"test@yandex.com.tr",
        "password":"password"
    }

Response

    {
      "status": "Success",
      "message": null,
      "data": {
        "token": "7|OmBtd1sRSqAcNI4SbN9a31zSfTBvGDwMwka5Obcs"
      }
    }

------

### Profile

Endpoint: http://localhost/api/me

Request

    curl --request GET \
      --url http://localhost/api/me \
      --header 'Authorization: Bearer 7|OmBtd1sRSqAcNI4SbN9a31zSfTBvGDwMwka5Obcs'

Response

    {
      "id": 1,
      "name": "test",
      "email": "test@yandex.com.tr",
      "email_verified_at": null,
      "reference_code": "60eb50301973c",
      "created_at": "2021-07-11T20:10:24.000000Z",
      "updated_at": "2021-07-11T20:10:24.000000Z"
    }

------

### Invite People

Endpoint: http://localhost/api/invite

Request

    curl --request POST \
      --url http://localhost/api/invite \
      --header 'Authorization: Bearer 7|OmBtd1sRSqAcNI4SbN9a31zSfTBvGDwMwka5Obcs' \
      --header 'Content-Type: application/json' \
      --data '{
        "to": "test@yandex.ru",
        "code": "60eb50301973c"
    }'

Response

    {
      "status": "Success",
      "message": null,
      "data": {
        "status": "succes"
      }
    }

------

### Logout

Endpoint : http://localhost/api/auth/logout

Request

    curl --request POST \
      --url http://localhost/api/auth/logout \
      --header 'Authorization: Bearer 7|OmBtd1sRSqAcNI4SbN9a31zSfTBvGDwMwka5Obcs'

Response

    {
      "message": "Tokens Revoked"
    }

------

### I-AM-ALIVE

Endpoint : http://localhost/api/auth/logout

Request

    curl --request GET \
      --url http://localhost/api/i-am-alive

Response

    "OK"