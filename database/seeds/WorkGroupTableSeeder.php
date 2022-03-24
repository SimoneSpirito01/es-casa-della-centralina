<?php

use App\Category;
use App\WorkGroup;
use Illuminate\Database\Seeder;

class WorkGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i < 10; $i++) {
            $categories = [];
            for ($j = 0; $j < rand(1, 3); $j++) {
                $category = rand(1, count(Category::all()));
                if(!in_array($category, $categories)) $categories[] = $category;
            }

            $name = '';

            foreach ($categories as $category) {
                $name = $name.'+'.Category::find($category)->name;
            }
            
            $name = substr($name, 1);

            $newGroup = new WorkGroup();
            
            $newGroup->name = $name;
            $newGroup->save();

            $newGroup->categories()->sync($categories);
        }
    }
}
