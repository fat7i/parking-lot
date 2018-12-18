<?php

namespace App\Repositories;

use App\Models\Parkable;


class ParkableRepository
{
    /**
     * @var Parkable
     */
    private $model;

    /**
     * ParkableRepository constructor.
     * @param Parkable $model
     */
    public function __construct(Parkable $model)
    {
        $this->model = $model;
    }

    /**
     * @param $plate
     * @param $type
     * @return Parkable
     */
    public function getOrCreate($plate, $type = null)
    {
        //return $this->model->firstOrCreate(['plate' => $plate, 'type' => $type]);

        $parkable = $this->getParkableByPlate($plate);

        if (empty($parkable)) {
            $parkable = $this->model;
            $parkable->plate = $plate;
            $parkable->type = $type;
            $parkable->save();
        }

        return $parkable;
    }

    /**
     * @param $plate
     * @return Parkable
     */
    public function getParkableByPlate(string $plate): ?Parkable
    {
        return $this->model->where('plate', $plate)->with('lot')->first();
    }

    /**
     * @param $plate
     */
    public function deleteParkingByPlate(string $plate)
    {
        $model = $this->model->where('plate',$plate)->first();
        $model->lot()->detach();
    }

    /**
     * @param int $parkable_id
     * @param int $lot_id
     * @return Parkable
     */
    public function insertParking(int $parkable_id,int $lot_id): Parkable
    {
        $parkable = $this->model->find($parkable_id);

        $parkable->lot()->attach($lot_id);

        return $this->getParkableByPlate($parkable->plate);
    }


}