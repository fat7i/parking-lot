<?php

namespace App\Repositories;

use App\Models\Lot;

class LotRepository
{
    /**
     * @var Lot
     */
    private $model;

    /**
     * LotRepository constructor.
     * @param Lot $model
     */
    public function __construct(Lot $model)
    {
        $this->model = $model;
    }

    /**
     * @param float $lotSize
     * @return Lot
     */
    public function getByLotSize(float $lotSize): ?Lot
    {
        return $this->model->where('size', $lotSize)->doesntHave('parked')->first();
    }

    /**
     * @param int $parkable_id
     * @param int $lot_id
     */
    public function insertParking(int $parkable_id,int $lot_id)
    {
        $this->model->find($lot_id)->parked()->attach($parkable_id);
    }

    /**
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getLotsList(int $perPage = 10)
    {
        return $this->model->with('parked')->paginate($perPage);
    }
}