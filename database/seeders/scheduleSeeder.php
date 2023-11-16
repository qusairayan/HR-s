<?php

namespace Database\Seeders;

use App\Models\Schedules;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class scheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = new Factory();
        $users = collect(User::all()->modelKeys());
        $arr=[];

        for ($i=26; $i <31 ; $i++) { 
            Schedules::create([
                "user_id"=>4,
                "date"=>"2023-11-".$i,
                "day"=>date('l', strtotime("2023-11-".$i)),
                "off-day"=>date('l', strtotime("2023-11-".$i)) === "Friday" || date('l', strtotime("2023-11-".$i)) === "Saturday" ? 1 : NULL,
                "from"=>"09:00:00",
                "to"=>"17:00:00",
                "shift"=>null,
                "created_at"=>Carbon::now(),
                "updated_at"=>Carbon::now(),
            ]);
        }

    }
}
