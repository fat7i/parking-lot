<?php

namespace App\Tasks;

use App\Repositories\ParkableRepository;


class ParkTask implements TaskInterface
{
    /**
     * @var ParkableRepository
     */
    private $parkableRepository;

    /**
     * @var int
     */
    private $parkable_id;
    /**
     * @var int
     */
    private $lot_id;

    /**
     * ParkTask constructor.
     * @param ParkableRepository $parkableRepository
     */
    public function __construct(ParkableRepository $parkableRepository)
    {
        $this->parkableRepository = $parkableRepository;
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->parkableRepository->insertParking($this->parkable_id,$this->lot_id);
    }

    /**
     * @param int $parkable_id
     * @return ParkTask
     */
    public function setParkableId($parkable_id)
    {
        $this->parkable_id = $parkable_id;
        return $this;
    }

    /**
     * @param int $lot_id
     * @return ParkTask
     */
    public function setLotId($lot_id)
    {
        $this->lot_id = $lot_id;
        return $this;
    }


}