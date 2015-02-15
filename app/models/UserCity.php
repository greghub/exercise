<?php

class UserCity extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_citys';

	public function getCityForAPI() 
	{

		$city = City::find($this->city_id);

		$response = [
			"id" => $this->city_id,
			"city" => $city->name,
			"state" => $city->state
		];

		return $response;

	}

}

