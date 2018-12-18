<?php

namespace App\Repositories;

use App\Models\Movement;


class MovementRepository
{
    /**
     * @var Movement
     */
    private $model;

    /**
     * MovementRepository constructor.
     * @param Movement $model
     */
    public function __construct(Movement $model)
    {
        $this->model = $model;
    }

    /**
     * @param $lot_id
     * @param $parkable_id
     * @param $action
     * @return Movement
     */
    public function create($lot_id, $parkable_id, $action)
    {
        $this->model::create([
            "lot_id" => $lot_id,
            "parkable_id" => $parkable_id,
            "action" => $action
        ]);

    }
}