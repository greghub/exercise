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

}
