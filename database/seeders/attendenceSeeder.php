<?php

namespace Database\Seeders;

use App\Models\Attendence;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class attendenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker =new Factory();
        $min_time_in = strtotime("09:00:00");
        $max_time_in = strtotime("10:00:00");
        $min_time_out = strtotime("16:00:00");
        $max_time_out = strtotime("17:00:00");
        for ($i=1; $i < 31; $i++) { 
            $time_in =  rand($min_time_in,$max_time_in);
            $time_in= date("H:i:s",$time_in);
            $time_out =  rand($min_time_out,$max_time_out);
            $time_out= date('H:i:s',$time_out);
            if(date('l', strtotime("2023-11-".$i)) !== "Friday" && date('l', strtotime("2023-11-".$i)) !== "Saturday"){
                Attendence::create([
                    "type"=>0,
                    "user_id"=>4,
                    "date"=>"2023-11-".$i,
                    "check_in"=>$time_in,
                    "check_out"=>$time_out,
                    "created_at"=>Carbon::now(),
                    "updated_at"=>Carbon::now(),
                ]);
            }
    }
    }
}
