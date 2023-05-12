<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=[
            [
                "email"=> "giulia@mail.it",
                "password"=>"pwdgiulia"
            ],
            [
                "email"=> "carlo@mail.it",
                "password"=>"pwdcarlo"
            ],
            [
                "email"=> "simone@mail.it",
                "password"=>"pwdsimone"
            ],
            [
                "email"=> "michele@mail.it",
                "password"=>"pwdmichele"
            ],
            [
                "email"=> "gianmarco@mail.it",
                "password"=>"pwdgianmarco"
            ],

        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}