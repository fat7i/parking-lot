# Parking Lot Task
Your task for this project is to implement a “parking lot” in PHP. You can use a
framework if you prefer, but there is no need to use any frameworks - a simple
application which shows the data flow is enough. The view layer is not required!.

<img src="https://www.hlaw.ca/wp-content/uploads/2016/12/16.12.01-519196006.jpg" />

### Part 1
Create an OOP implementation of a parking lot and the objects which can interact
with it:
- Bus
- Car
- Motorbike

### Part 2
Implement some basic interactions between the parking lot object and above
objects:
- Parking the vehicle (controlling the free space)
- Departure from the parking lot

### Part 3
Create a REST API with the following functionality:
- Obtain the parking lot status (a list of vehicles that are parked)
- Parking a vehicle action
- Vehicle departure from the parking lot action

We should be able to communicate with the application from any JavaScript
Framework or Postman.

#### Part 4
Database layer (optional)

## Instructions
- Clone the project.
- Run: `composer install` to download all packages.
- Edit database info in `.env` file.
- Run `php artisan migrate` to create database tables.
- Run `php artisan db:seed` to seed the database with some demo data.
- Run `php artisan serve` to run the development server <http://127.0.0.1:8000>.

### Endpoints
| Name | Method | URL |
|------|------|------|
| List | GET | http://127.0.0.1:8000/api/
| Park | GET | http://127.0.0.1:8000/api/park?plate=MUN5799&type=car 
| Depart | GET | http://127.0.0.1:8000/api/depart?plate=MUN5799

