<?php

use Illuminate\Database\Seeder;

use App\Role;
use App\User;
use App\Service;
use App\Problem;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Role::create([
        	"id"=>1,
        	"role"=>"admin"
        ]);

        Role::create([
        	"id"=>2,
        	"role"=>"client"
        ]);

        Role::create([
        	"id"=>3,
        	"role"=>"technician"
        ]);

        User::create([
            "id"=>1,
            "role_id"=>1,
            "name"=>"admin",
            "email"=>"zulham@gmail.com",
            "password"=>bcrypt("zulhamganteng")
        ]);

    	User::create([
    		"id"=>2,
    		"role_id"=>2,
    		"name"=>"zulham",
    		"email"=>"asegaf@ymail.com",
    		"password"=>bcrypt("zulhamganteng")
    	]);

        Problem::create([
            "id"=>1,
            "problem"=>"Pemasangan Listrik"
        ]);

        Problem::create([
            "id"=>2,
            "problem"=>"Pemasangan lampu"
        ]);

        Problem::create([
            "id"=>3,
            "problem"=>"Pemasangan Air"
        ]);

        Problem::create([
            "id"=>4,
            "problem"=>"Pemasangan Api"
        ]);

    }
}
