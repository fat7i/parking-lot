# Parking Lot Task
Your task for this project is to implement a “parking lot” in PHP. You can use a
framework if you prefer, but there is no need to use any frameworks - a simple
application which shows the data flow is enough. The view layer is not required!.

<img src="https://www.birminghamairport.co.uk/media/4059/img_1114.jpg?crop=0,0.36333333333333334,0,0.08666666666666667&cropmode=percentage&width=600&height=220&rnd=131402648610000000" />

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


#### 1. Listing Lots

    GET /api   optional: (?page=2) for paging
    Response: 200 OK
    {
    	current_page: 1,
    	data: [
    		{
    			id: 1,
    			name: "A001",
    			size: 0.5,
    			created_at: null,
    			updated_at: null,
    			parked: [
    				{
    					id: 11,
    					plate: "MNK0066",
    					type: "motorbike",
    					created_at: null,
    					updated_at: null,
    					pivot: {
    						lot_id: 1,
    						parkable_id: 11
    					}
    				}
    			]
    		},
    		{
    			id: 2,
    			name: "A002",
    			size: 0.5,
    			created_at: null,
    			updated_at: null,
    			parked: [ ]
    		},
    		{...},
    		
    	from: 1,
    	last_page: 3,
    	next_page_url: "http://127.0.0.1:8000/api?page=2",
    	path: "http://127.0.0.1:8000/api",
    	per_page: 10,
    	prev_page_url: null,
    	to: 10,
    	total: 30
    }


#### 1. Park a vehicle

    GET /api/park?plate=MUN5799&type=car 
    Params:
        plate = plate number
        type  = bus, car, or motorbike 
    Response: 200 OK
    {
    	status: "success",
    	message: "Parked successfully.",
    	data: {
    		id: 16,
    		plate: "MUN5799",
    		type: "car",
    		created_at: "2018-12-18 11:18:20",
    		updated_at: "2018-12-18 11:18:20",
    		lot: [{
    			id: 16,
    			name: "C006",
    			size: 1,
    			created_at: "2018-12-18 10:11:24",
    			updated_at: "2018-12-18 10:11:24",
    			pivot: {
    				parkable_id: 16,
    				lot_id: 16
    			}
    		}]
    	}
    }
    
    
### Depart a vehicle

    GET /api/depart?plate=MUN5799
    Params:
        plate = plate number 
    Response: 200 OK    
    {
        status: "success",
        message: "Departed successfully."
    }