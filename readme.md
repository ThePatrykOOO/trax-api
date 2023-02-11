# Laravel Backend Coding Simulation

## Trax Milage Tracking Application

---

### Overview

In this coding simulation you are being asked to develop the backend for “Trax”. Trax is a hypothetical web application that allows its users to track the number of miles traveled in their cars.

The front-end of the application has already been developed and consists of the following features:

- User registration and authentication (Note: No back-end work is required for user management. This work is already
  complete.)
- Ability for a logged-in user to add car to Trax
- Ability for a logged-in user to remove car from Trax
- Ability for a logged-in user to view a list of all theirs cars
- Ability for a logged-in user to add trip to Trax and specify which car was used.
- Ability for a logged-in user to a view a list of all their trips

The frontend of the application currently makes requests to a set of mock endpoints implemented in-line in
/routes/api.php, with each mock endpoint sending back statically defined JSON objects. It is your task to develop a
functional API for Trax.
You are being asked to:

- Design the Data-Model for Trax and create corresponding Database Migrations.
- Implement the Eloquent Model Layer.
- Design a RESTful API to be consumed by the front-end using the mock end-points as a guide for the expected data
  format.
- Implement the Controller(s) for the API and leverage them in the routes.
    - Entrypoint for list of Trips should be written in clean SQL or using Query Builder (not Eloquent).
- Add at least 2 unit and 2 feature tests.
- Update the frontend’s /resources/assets/js/traxAPI.js file so that the frontend makes uses of your new API. Ideally,
  you should showcase your Laravel experience by using as many Laravel specific features as possible. For example:
  Scopes, Resources, Policies, Requests, etc.

### Additional information

- Miles - Driven miles from the trip.
- Miles Balance - Total Sum of miles driven by the car.

---

### Getting Started

Perform the following steps to get started with the coding simulation.

- Install Docker Desktop from https://www.docker.com/products/docker-desktop
- Clone this repo onto your development machine.

If you have Docker version 20.10.14 or higher, please do:

```
DockerDesktop > Preferences > General > OFF the checkbox "Use Docker Compose V2"
```

Setup your working environment by executing the following commands:

```
cd <trax repo directory>
docker-compose build
docker-compose up
docker exec -it trax_php composer install
docker exec -it trax_php npm install
docker exec -it trax_php npm run dev
docker exec -it trax_php php artisan migrate
```

At this point you can open http://localhost:8080/ and start using the mock-API backed application. As a first step, you
should click ‘Register’ in the upper right to create an account and enter the application.

Should you make changes to
any of the JS files, such as /resources/assets/js/traxAPI.js, you can run the following in order to compile your changes

```
docker exec -it trax_php npm run dev
```

Or to watch for any JS changes you can run

```
docker exec -it trax_php npm run watch
```
Additionally You can run seeders

```
docker exec -it trax_php php artisan db:seed
```
Commit your changes locally and when finished, publish your repo on your public bitbucket or github account. All changes in the code **must** be presented as Pull Request.

**GOOD LUCK!**
