# How to start

1. Create .env file by example
2. `composer install`
3. Create a new database for this project
4. Run migrations: `php yii migrate`
6. Ready to test

## Resources

### Create starship

Resource: _/starship_  
Method: POST  
Payload: `{ "name": "xxx", "planet_id": 1, "type": "boat", "capacity": 100 }`

### Update starship

Resource: _/starship/1_  
Method: PUT  
Payload: `{"name":"Awesome"}`

### Delete starship

Resource: _/starship/1_  
Method: DELETE  

### Load cargo

Resource: _/starship/load_  
Method: PUT  
Payload: `{ "load": 3500, "planet_id": 1 }`

### Register arrival

Resource: _/starship/arrive/{id}_    
Method: PUT  
Parameters:  
- **id**: starship id  

Payload: `{ "planet_id": 3 }`

### Unload the cargo

Resource: _/starship/unload/{id}_    
Method: PUT  
Parameters:  
- **id**: starship id  
