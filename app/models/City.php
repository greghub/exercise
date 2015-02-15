<?php

class City extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'citys';

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

