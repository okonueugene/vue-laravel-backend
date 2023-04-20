<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add statuses

        $status1 = new Status();
        $status1->name = 'Upcoming';
        $status1->save();

        $status2 = new Status();
        $status2->name = 'In Progress';
        $status2->save();

        $status4 = new Status();
        $status4->name = 'Cancelled';
        $status4->save();

        $status5 = new Status();
        $status5->name = 'On Hold';
        $status5->save();

        $status6 = new Status();
        $status6->name = 'Completed';
        $status6->save();

        $status7 = new Status();
        $status7->name = 'Active';
        $status7->save();

        $status8 = new Status();
        $status8->name = 'Priority';
        $status8->save();


    }
}
