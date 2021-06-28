<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Desk;
use App\Models\DeskList;
use App\Models\Card;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        Desk::factory(5)->create();
//        DeskList::factory(4)->create();
//        Card::factory(3)->create();
//        Task::factory(2)->create();


        for ($i = 0; $i < 5; $i++) {
            $desk = Desk::factory()
                ->create();

            for ($j = 0; $j < 10; $j++) {
                $desk_list = DeskList::factory()
                    ->create(['desk_id'=>$desk->id]);

                for ($k = 0; $k < 15; $k++) {
                    $card = Card::factory()
                        ->create(['desk_list_id'=>$desk_list->id]);

                    Task::factory()
                        ->count(20)
                        ->create(['card_id'=>$card->id]);
                }
            }
        }
    }
}
