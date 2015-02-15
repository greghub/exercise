<?php

class CitysController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Citys Controller
	|--------------------------------------------------------------------------
	*/

	/**
	 * Display the specified resource.
	 * GET /v1/states/cities.json
	 *
	 * @param  string $state, city  int radius
	 * @return Response
	 */
	public function show()
	{

		$validator = Validator::make(			
		    array(
		    	'state'  => Input::get('state'),
		    	'city'	 => Input::get('city'),
		    	'radius' => Input::get('radius')
		    ),
		    array(	
		    	'state'  => 'string|min:2', 
		    	'city' 	 => 'string',
		    	'radius' => 'numeric'
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
	 		$state  = Input::get('state');
	 		$city 	= Input::get('city');
	 		$radius = Input::get('radius');

	 		// used in auth.basic filter. grants access only to the authorized users
			if( !Auth::user() )
			{		
				$e = 'User not authorized';
				//throw new Exception($e);
			}
	         
	        if ( !empty($city) && !empty($radius))
	        {

	        	

	        } else {

		        // -- get city object in expected format --
		        $cities = City::where('state', $state)->where('status', 'verified')->get();
		        if($cities) {	  
		        	foreach ($cities as $key => $city) 
		        	{
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
