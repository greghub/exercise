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
	 		$state  	= Input::get('state');
	 		$pivot_city = Input::get('city');
	 		$radius 	= Input::get('radius');

	 		// used in auth.basic filter. grants access only to the authorized users
			if( !Auth::user() )
			{		
				$e = 'User not authorized';
				//throw new Exception($e);
			}
	         
	        if ( !empty($pivot_city) && !empty($radius))
	        {

	        	$city = City::where('name', $pivot_city)->first();

	        	if ($city) {
			        $latitude    = $city['lat'];
			        $longitude   = $city['lng'];

					$citiesInRadius = DB::select(
						DB::raw('SELECT *,
						SQRT(POW(69.1 * (lat - ?), 2) + POW(69.1 * (? - lng) * COS(lat / 57.3), 2)) AS distance
						FROM `citys` WHERE `status` = "verified" HAVING distance < ? ORDER BY `distance` asc'),
						array($latitude, $longitude, $radius)
					);

			    	if($citiesInRadius) {	  
			        	foreach ($citiesInRadius as $key => $city) 
			        	{
			        		// -- get city object in expected format --
			        		$cityItem['id'] = $city->id;
			        		$cityItem['name'] = $city->name;
			        		$cityItem['state'] = $city->state;
			        		$cityItem['distance'] = $city->distance;
			        		
		    	      		$response['cities'][] = $cityItem;
		    	      	}      	
			        }
			        $response['message'] = "All OK";

	        	} 

	        } else {
		        
		        // if no city name and radius are given, search by state
		        $cities = City::where('state', $state)->where('status', 'verified')->get();

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
