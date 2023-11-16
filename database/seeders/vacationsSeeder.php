<?php

namespace Database\Seeders;

use App\Models\Vacation;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class vacationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i=1; $i < 4; $i++) { 
            Vacation::create([
                "user_id"=>4,
                "date"=>"2023-11-1".$i,
                "period"=>1,
                "type"=>1,
                "status"=>1,
                "asset"=>null,
                "created_at"=>Carbon::now(),
                "updated_at"=>Carbon::now(),
            ]);
        }
    }
}
