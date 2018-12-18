<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Services\ParkingService;

class ParkablesTableSeeder extends Seeder
{

    public function __construct(ParkingService $parkingService)
    {
        $this->parkingService = $parkingService;
    }

    /**
     * Run the database seeds.
     * @param \Faker\Generator $faker
     * @throws
     * @return void
     */
    public function run(\Faker\Generator $faker)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('parkables')->truncate();
        DB::table('lot_parkable')->truncate();
        DB::table('movements')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $types = ['bus','car','motorbike'];

        foreach ($types as $type){
            for ($i = 1; $i <= 5; $i++) {

                $plate = strtoupper($faker->bothify('???####'));

                \App\Models\Parkable::create([
                    'plate' => $plate,
                    'type' => $type,
                ]);


                $typeObj = \App\Parkables\ParkableFactory::make($type);

                $lot = $this->parkingService->getAvailableLot($typeObj);

                $parkable = $this->parkingService->getOrCreateParkable($typeObj, $plate);

                $this->parkingService->park($parkable, $lot);

            }
        }





    }
}
