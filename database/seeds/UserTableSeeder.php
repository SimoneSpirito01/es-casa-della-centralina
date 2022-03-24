<?php

use App\User;
use App\WorkGroup;
use App\Workshop;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Aleardo ',
                'surname' => 'Folliero',
                'hire_date' => '2019-10-18',
                'email' => 'aleardo@gmail.com',
                'password' => 'ciao2022',
            ],
            [
                'name' => 'Tranquillino ',
                'surname' => 'Conti',
                'hire_date' => '2016-10-20',
                'email' => 'conti@gmail.com',
                'password' => 'ciao2022',
            ],
            [
                'name' => 'Luigina ',
                'surname' => 'Trentino',
                'hire_date' => '2021-01-22',
                'email' => 'luigina@gmail.com',
                'password' => 'ciao2022',
            ],
            [
                'name' => 'Petronio ',
                'surname' => 'Pirozzi',
                'hire_date' => '2015-10-11',
                'email' => 'petronio@gmail.com',
                'password' => 'ciao2022',
            ],
            [
                'name' => 'Ilenia ',
                'surname' => 'Sabbatini',
                'hire_date' => '2019-12-01',
                'email' => 'ilenia@gmail.com',
                'password' => 'ciao2022',
            ],
        ];

        foreach ($users as $user) {
            $newUser = new User();
            $newUser->name = $user['name'];
            $newUser->surname = $user['surname'];
            $newUser->email = $user['email'];
            $newUser->password = Hash::make($user['password']);
            $newUser->hire_date = $user['hire_date'];
            $newUser->workshop_id = rand(1, count(Workshop::all()));
            $newUser->save();

            $workGroups = [];
            for ($i = 0; $i < rand(1, 3); $i++) {
                $workGroup = rand(1, count(WorkGroup::all()));
                if (!in_array($workGroup, $workGroups)) $workGroups[] = $workGroup;
            }

            $newUser->workGroups()->sync($workGroups);
        }
    }
}
