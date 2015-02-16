<?php

class UserCitysTableSeeder extends Seeder {

	/**
	 * Auto generated seed file
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('user_citys')->delete();
        
		\DB::table('user_citys')->insert(array (
			0 => 
			array (
				'id' => 1,
				'user_id' => 1,
				'city_id' => 2249,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			1 => 
			array (
				'id' => 2,
				'user_id' => 1,
				'city_id' => 1,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			2 => 
			array (
				'id' => 3,
				'user_id' => 1,
				'city_id' => 2,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			3 => 
			array (
				'id' => 4,
				'user_id' => 2,
				'city_id' => 3,
				'created_at' => '0000-00-00 00:00:00',
				'updated_at' => '0000-00-00 00:00:00',
			),
			4 => 
			array (
				'id' => 7,
				'user_id' => 1,
				'city_id' => 30,
				'created_at' => '2015-02-16 10:08:18',
				'updated_at' => '2015-02-16 10:08:18',
			),
		));
	}

}
