# Countries and cities

A practice project - web application showing countries and cities statistics and allowing countries and cities CRUD operations.

**Working web-app: [countries-cities.herokuapp.com](https://countries-cities.herokuapp.com/)**

### Project features
* Written with plain PHP and JS, without any frameworks (except Bootstrap for design). Backend code written using MVC structure.  
* Some pages are updated dynamically, by using AJAX (countries and cities list)  
* Implemented all inputs validation  
* Implemented lists filtering, sorting, and pagination


### Installation
Requires XAMPP stack.  
1. `git clone git@github.com:mindaugasw/countries-and-cities.git`  
2. Set DB connection options (`config-default.php`).  
3. Import DB (`DB_export.sql`).  
4. Start apache server and access app at localhost.


### Data source
Countries and cities list from [simplemaps.com/data/world-cities](https://simplemaps.com/data/world-cities). Other information (area, population, phone numbers, zip codes) was generated randomly.