
Instructions to run the application starts

// run composer to setup application
composer install 

//generate application key if not already generated
php artisan key:generate

//update .env file with database credentials. 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

//update .env file for database queue. 
QUEUE_CONNECTION=database

//migration and seeder
php artisan migrate:fresh --seed

//run the application 
php artisan serve

//run the queue
php artisan queue:work

Login Credentials
$emails = ['ramesh@gmail.com','suresh@gmail.com','dinesh@gmail.com','rakesh@gmail.com','hitesh@gmail.com']; 
passwords -> password

Instructions to run the application ends.

Requirements 
Connection management system
 
·         Install fresh Laravel with version >= 6.x
·         User should be able to register with Name, Email, Gender (Radio button), Hobbies (Check box), Password and Confirm password
·         Display multiple hobbies with checkbox, Value should be fetch from the hobbies table do not put static 
·          While user registers do not save comma separated id into database for hobbies use normalization form.
·         While user logged In on home page all registered users will be display, do not show current login user 
·         Logged in user should be able to send friend request to any users from the list, If request sent then show text ‘Request sent’ in green font 
·         If any user from the list already sent a request to logged in user then show Accept button for accept request. If a request is accepted then show ‘Your friend’ in green fonts.
·         Show Block button to block any user from the list. If any user is blocked by a logged in user then show ‘Blocked’  in red fonts.
·         If logged in user blocked by any user then do not show that user name in list
·         Logged in users should be able to filter lists using male, female and hobbies.
·         Please use Laravel observer and queue to store user actions history logs 
·         Queue connection should be Database
·         While run queue command all logs history should be insert into logs table 
·         Display user logs history with action Created by Name, Created for name, Action(Sent request, Accept request, Block request etc) And Created date.
 
Instruction:
 
·         Create a readme file and write all steps to check the whole functionality.
·         Should follow proper coding standards & commenting 
·         Use the internet but full code should not copy from any source otherwise application will reject immediate basis.
·         For UI use existing bootstrap theme of Laravel 
·         Use Laravel migration for databases.
·         Use TDD will be added advantages 
·         Submit your code into your public Repository on github.com 
·         Please do not push code into single commit we need to check your all break down commit  
·         Do not use any package and library 


