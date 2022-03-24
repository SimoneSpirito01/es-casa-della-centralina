<?php

use App\Workshop;
use Illuminate\Database\Seeder;

class WorkshopTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $workshops = [
            'Officina 1',
            'Officina 2',
            'Officina 3',
        ];

        foreach($workshops as $workshop) {
            $newWorkshop = new Workshop();
            $newWorkshop->name = $workshop;
            $newWorkshop->save();
        }
    }
}
