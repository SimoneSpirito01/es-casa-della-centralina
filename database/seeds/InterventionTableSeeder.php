<?php

use App\Category;
use App\Intervention;
use App\User;
use App\Workshop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InterventionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $interventions = [
            [
                'name' => 'Cambio olio',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde laborum nesciunt odio assumenda totam sed eos molestiae exercitationem inventore vel ipsam aut aperiam sint culpa alias omnis deleniti, atque repellat!',
            ],
            [
                'name' => 'Pressione e usura pneomatici ',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde laborum nesciunt odio assumenda totam sed eos molestiae exercitationem inventore vel ipsam aut aperiam sint culpa alias omnis deleniti, atque repellat!',
            ],
            [
                'name' => 'Batteria ',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde laborum nesciunt odio assumenda totam sed eos molestiae exercitationem inventore vel ipsam aut aperiam sint culpa alias omnis deleniti, atque repellat!',
            ],
            [
                'name' => 'Sostituzione liquido e pasticche freni',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde laborum nesciunt odio assumenda totam sed eos molestiae exercitationem inventore vel ipsam aut aperiam sint culpa alias omnis deleniti, atque repellat!',
            ],
            [
                'name' => 'Filtro antipolline',
                'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde laborum nesciunt odio assumenda totam sed eos molestiae exercitationem inventore vel ipsam aut aperiam sint culpa alias omnis deleniti, atque repellat!',
            ],
        ];

        function rand_float($st_num = 0, $end_num = 1, $mul = 1000000)
        {
            if ($st_num > $end_num) return false;
            return mt_rand($st_num * $mul, $end_num * $mul) / $mul;
        }

        foreach ($interventions as $intervention) {
            $newIntervention = new Intervention();
            $newIntervention->name = $intervention['name'];
            $newIntervention->user_id = rand(1, count(User::all()));
            $newIntervention->category_id = rand(1, count(Category::all()));
            $newIntervention->workshop_id = rand(1, count(Workshop::all()));
            $newIntervention->description = $intervention['description'];
            $newIntervention->estimated_duration = rand(1, 15);
            $newIntervention->price = rand_float(10, 10000, 2);
            $newIntervention->start_date = date('Y-m-d', strtotime('-12 days'));

            if(rand(1,4) != 1) {
                $newIntervention->end_date = '2022-03-'.rand(11,22);
            } 
            
            $newIntervention->save();
        }
    }
}
