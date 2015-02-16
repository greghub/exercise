<?php

class UsersController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Users Controller
	|--------------------------------------------------------------------------
	*/

	/**
	 * Display the specified resource.
	 * GET /v1/users/visits.json
	 *
	 * @param  string $user_id
	 * @return Response
	 */
	public function visits()
	{

		$validator = Validator::make(			
		    array(
		    	'user_id'  => Input::get('user_id'),
		    ),
		    array(	
		    	'user_id' => 'integer'
		    )
		);

	    try{

	    	// setting the default response and status code
	        $response = [
	            'cities' => []
	        ];
	        $statusCode = 200;

	        // handling invalid input values
	    	if ($validator->fails())
			{
				$e = $validator->messages();
				throw new Exception($e);
			}

			// get the input values
	 		$user_id = Input::get('user_id');

	 		// used in auth.basic filter. grants access only to the authorized users
			if( !Auth::user() )
			{		
				$e = 'User not authorized';
				//throw new Exception($e);
			}
	         
	        if ( !empty($user_id) )
	        {
		        
		        // if no city name and radius are given, search by state
		        $cities = UserCity::where('user_id', $user_id)->get();

				// -- if cities matching the request found --
		    	if($cities) {	  
		        	foreach ($cities as $key => $city) 
		        	{
		        		// -- get city object in expected format --
	    	      		$response['cities'][] = $city->getCityForAPI();
	    	      	}      	
			        $response['message'] = "All OK";
		        }
		    }


	 
	    } catch (Exception $e) {
	        $statusCode = 404;
	    } finally {
	        // return Response::json($response, $statusCode);
	    	return Response::json($response, $statusCode, array(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

	    }
	 
	}


	/**
	 * Update the user visits.
	 * PUT /users/{uuid}
	 *
	 * @param  int $user_id, city
	 * @return Response
	 */
	public function update()
	{

		$validator = Validator::make(			
		    array(
		    	'user_id' => Input::get('user_id'),
		    	'city'    => Input::get('city'),
		    ),
		    array(	
		    	'user_id' => 'required|integer', 
		    	'city'	  => 'required|string'
		    )
		);
		$response = [
	        'city' => []
        ];	        
        $statusCode = 200;

		try {

			if ($validator->fails())
			{
				$e = $validator->messages();
				throw new Exception($e);
			}
	 	
	 		$user_id = Input::get('user_id');
	 		$city_input = Input::get('city');

	 		$city = City::where('name', $city_input)->first();

	 		if( $city ) {

				$check_visit = UserCity::where('city_id', $city["id"])->where('user_id', $user_id)->first();

				// checking if the user has already visited the city
				// if not, add it
				if(!$check_visit) 
				{			 	
				 	$visit = new UserCity;
				 	$visit->user_id = $user_id;
				 	$visit->city_id = $city["id"];
				 	$visit->save();


			        $response = [
			        	'result' => 'Visit successfully updated',
				        'city' => $visit->getCityForAPI()
			        ];
			    } else 			        
			    	$response = [
			        	'result' => 'The user has already visited the city',
				        'city' => $check_visit->getCityForAPI()
			        ];{

			    }
		        $statusCode = 200;

		    } else {

		        $response = [
		        	'result' => 'City not found',
			        'city' => []
		        ];
		        $statusCode = 404;

		    }
	 
	    } catch (Exception $e) {
	    	$response = [
	    		'error' => $e->getMessage()
	    	];	    	
        	$statusCode = 404;
	    } finally {
	    	return Response::json($response, $statusCode, array(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	    }

	}
}
