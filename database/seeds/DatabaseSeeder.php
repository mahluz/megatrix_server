<?php

use Illuminate\Database\Seeder;

use App\Role;
use App\User;
use App\Service;

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
            "email"=>"admin@gmail.com",
            "password"=>bcrypt("admin")
        ]);

    	User::create([
    		"id"=>2,
    		"role_id"=>2,
    		"name"=>"zulham",
    		"email"=>"asegaf@ymail.com",
    		"password"=>bcrypt("zulhamganteng")
    	]);

        User::create([
            "id"=>3,
            "role_id"=>3,
            "name"=>'Kurniawan',
            "email"=>'kurniawan@gmail.com',
            "password"=>bcrypt("kurniawanganteng"),
        ]);

        Service::create([
            "id"=>1,
            "service"=>"Pemasangan Listrik",
            "description"=>"something"
        ]);

        Service::create([
            "id"=>2,
            "service"=>"Pemasangan lampu",
            "description"=>"something"
        ]);

        Service::create([
            "id"=>3,
            "service"=>"Pemasangan Air",
            "description"=>"something"
        ]);

        Service::create([
            "id"=>4,
            "service"=>"Pemasangan Api",
            "description"=>"something"
        ]);

    }
}
