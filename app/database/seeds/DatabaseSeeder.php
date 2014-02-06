<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('SentryGroupSeeder');
		$this->call('SentryUserSeeder');
		$this->call('SentryUserGroupSeeder');
		$this->call('PropertiesTableSeeder');
		$this->call('LocationsTableSeeder');
		$this->call('TypesTableSeeder');
		$this->call('DevelopersTableSeeder');
		$this->call('PostsTableSeeder');
		$this->call('TransactionsTableSeeder');
		$this->call('ReservationsTableSeeder');
		$this->call('AgentsTableSeeder');
	}

}