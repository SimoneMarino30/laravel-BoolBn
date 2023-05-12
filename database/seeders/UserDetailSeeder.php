<?php

namespace Database\Seeders;

use App\Models\UserDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $user_details=[
            [
                "user_id"=> "1",
                "name"=> "Giulia",
                "surname"=> "Glave",
                "date_of_birth"=>"1996-11-26",
                //"user_image"=>"https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png?20150327203541"
            ],
            [
                "user_id"=> "2",
                "name"=> "Carlo",
                "surname"=> "Colletti",
                "date_of_birth"=>"2000-07-11",
                //"user_image"=>"https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png?20150327203541"
            ],
            [
                "user_id"=> "3",
                "name"=> "Simone",
                "surname"=> "Marino",
                "date_of_birth" => "1989-03-30",
                //"user_image"=>"https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png?20150327203541"
            ],
            [
                "user_id"=> "4",
                "name"=> "Michele Pio",
                "surname"=> "Bombai",
                "date_of_birth" => "2003-12-06",
                //"user_image"=>"https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png?20150327203541"
            ],
            [
                "user_id"=> "5",
                "name"=> "Gianmarco",
                "surname"=> "Leone",
                "date_of_birth" => "1996-04-24",
                //"user_image"=>"https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png?20150327203541"
            ],
           
        ];

        foreach ($user_details as $key => $user) {
            UserDetail::create($user);
        }
    }
}