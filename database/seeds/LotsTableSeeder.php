<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LotsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('lots')->truncate();
        DB::table('lot_parkable')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $size = [0.5, 1, 2];
        $letter = ['M', 'C', 'B'];

        for ($x = 0; $x <= 2; $x++) {
            for ($i = 1; $i <= 10; $i++) {

                \App\Models\Lot::create([
                    'name' => sprintf($letter[$x].'%03d', $i),
                    'size' => $size[$x],
                ]);

            }
        }
    }


}
