*Installation*<br>
<br>
1) clone the repo<br>
2) run ```composer install```<br>
3) run the migrations ```php artisan migrate```<br>
4) the repo comes with the database, so you don't have to add the deafault values.<br>
5) to run the tests (Codeception) build the tests ```./vendor/bin/codecept build``` then run ```./vendor/bin/codecept run```
run ```php artisan db:seed```<br>
<br>
Run ```http://exercise.dev/seed``` if you want to seed your version of database.<br>
Some code for working with user authorization is written. so it can be quickly converted into an API that user authorization e.g. auth.basic<br>
It checks if the user has already visited the city, then adds it.
<br><br>
*Features*<br>
<br>
1) List all cities in a state<br>
this GET request ```http://exercise.dev/v1/states/cities.json?state=IL``` will list all cities in a state. The following example shows all the cities in the state of Illinois.<br>

2) List cities within a given mile radius of a city<br>
this GET request ```http://exercise.dev/v1/states/cities.json?city=Chicago&radius=1``` will list all cities in a given radius of the given city. The following example shows all the cities within 1 mile distance of Chicago.<br>

3) Return a list of cities the user has visited<br>
this GET request ```http://exercise.dev/v1/users/visits.json?user_id=1``` will list all cities a user have visited.<br>

4) Allow a user to update a row of data to indicate they have visited a particular city<br>
this POST request ```http://exercise.dev/v1/users/visits.json?user_id=1&city=Chicago``` will add Chicago to the list of cities a user have visited.<br>
