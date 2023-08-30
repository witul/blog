<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //User::factory()->admin()->count(1)->create();
        DB::table('users')->truncate();
        $u=[
            "name"=> "Łukasz",
            "email"=> "witkowski@ipws.pl",
            "email_verified_at"=> "2023-08-30 00:43:54",
            "password"=> '$2y$10$pGIBrJDfQtkOXXAguQzE2OjrOVIUu7nRXfwJGLctu7PnDbEl0OgH6',
            "role"=> "admin",
            "remember_token"=> null,
            "created_at"=> "2023-08-30 00:41:40",
            "updated_at"=> "2023-08-30 00:44:19",
        ];
        DB::table('users')->insert($u);

        // ]);
    }


}
