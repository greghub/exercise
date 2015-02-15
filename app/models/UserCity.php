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

		$response = [
			"id" => $this->id,
			"city" => $this->name,
			"state" => $this->state
		];

		return $response;

	}

}

