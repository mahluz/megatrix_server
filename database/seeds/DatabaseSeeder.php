<?php

use Illuminate\Database\Seeder;

use App\Models\Role;
use App\Models\User;
use App\Models\Service;
use App\Models\Biodata;
use App\Models\Material;
use App\Models\Order;
use App\Models\OrderMaterial;

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

        Biodata::create([
            "user_id"=>1,
            "gender"=>"Laki-laki",
            "cp"=>"089682169754",
            "date_of_birth"=>"1995-12-12",
            "province"=>"JAWA TENGAH",
            "regency"=>"KABUPATEN SEMARANG",
            "district"=>"GUNUNGPATI",
            "village"=>"KALISEGORO",
            "home_address"=>"Office Griya Sekar Gading Blok Q-9 Sekaran, Gunungpati Kota Semarang",
            "last_education"=>"S1 UNNES",
            "profession"=>"Founder and CTO Ardata",
            "skill"=>"marketing and programming"
        ]);

        Biodata::create([
            "user_id"=>2,
            "gender"=>"Laki-laki",
            "cp"=>"089682169754",
            "date_of_birth"=>"1995-12-12",
            "province"=>"JAWA TENGAH",
            "regency"=>"KABUPATEN SEMARANG",
            "district"=>"GUNUNGPATI",
            "village"=>"KALISEGORO",
            "home_address"=>"Office Griya Sekar Gading Blok Q-9 Sekaran, Gunungpati Kota Semarang",
            "last_education"=>"S1 UNNES",
            "profession"=>"Founder and CTO Ardata",
            "skill"=>"marketing and programming"
        ]);

        Biodata::create([
            "user_id"=>3,
            "gender"=>"Laki-laki",
            "cp"=>"089682169754",
            "date_of_birth"=>"1995-12-12",
            "province"=>"JAWA TENGAH",
            "regency"=>"KABUPATEN SEMARANG",
            "district"=>"GUNUNGPATI",
            "village"=>"KALISEGORO",
            "home_address"=>"Office Griya Sekar Gading Blok Q-9 Sekaran, Gunungpati Kota Semarang",
            "last_education"=>"S1 UNNES",
            "profession"=>"Founder and CTO Ardata",
            "skill"=>"marketing and programming"
        ]);

        Service::create([
            "id"=>1,
            "service"=>"Pemasangan Listrik",
            "description"=>"something",
            "price"=>"2000"
        ]);

        Service::create([
            "id"=>2,
            "service"=>"Pemasangan lampu",
            "description"=>"something",
            "price"=>"2000"
        ]);

        Service::create([
            "id"=>3,
            "service"=>"Pemasangan Air",
            "description"=>"something",
            "price"=>"2000"
        ]);

        Service::create([
            "id"=>4,
            "service"=>"Pemasangan Api",
            "description"=>"something",
            "price"=>"2000"
        ]);

        Material::create([
            "material"=>"Lampu Neon",
            "description"=>"something",
            "price"=>"2000"
        ]);

        Material::create([
            "material"=>"Lampu Zig Zag",
            "description"=>"something",
            "price"=>"2000"
        ]);

        Order::create([
            "id"=>1,
            "service_id"=>3,
            "client_id"=>2,
            "technician_id"=>1,
            "province"=>"JAWA TENGAH",
            "regency"=>"KABUPATEN SEMARANG",
            "district"=>"GUNUNGPATI",
            "village"=>"KALISEGORO",
            "home_address"=>"Office Griya Sekar Gading Blok Q-9 Sekaran, Gunungpati Kota Semarang",
            "status"=>"requested"
        ]);

        OrderMaterial::create([
            "id"=>1,
            "order_id"=>1,
            "material_id"=>1
        ]);

        OrderMaterial::create([
            "id"=>2,
            "order_id"=>1,
            "material_id"=>2
        ]);

    }
}
