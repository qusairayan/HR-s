<?php

namespace Database\Seeders;

use App\Models\Leave;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeavesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        $min_time_in = strtotime("13:00:00");
        $max_time_in = strtotime("17:00:00");
        $faker = Factory::create();
        for ($i=0; $i < 5 ; $i++) { 
            $time_in =  rand($min_time_in,$max_time_in);
            $time_in= date("H:i:s",$time_in);
            if(date('l', strtotime("2023-11-".$i)) !== "Friday" && date('l', strtotime("2023-11-".$i)) !== "Saturday"){
                Leave::create([
                    "user_id"=>4,
                    "time"=>$time_in,
                    "date"=>"2023-11-".$i+3,
                    "period"=>"0".rand(1,4).":00:00",
                    "reason"=>$faker->sentence,
                    "status"=>1,
                    "created_at"=>Carbon::now(),
                    "updated_at"=>Carbon::now(),
                ]);
            }
        }
    }
}
