<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$user = new User([
			'name' => 'Administrator',
			'email' => 'admin@test.com',
			'password' => Hash::make("Test1234!"),
		]);
		$user->save();

	}
}
