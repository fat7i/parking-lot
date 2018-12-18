<?php

namespace App\Tasks;

use App\Repositories\ParkableRepository;


class GetParkableTask implements TaskInterface
{
    /**
     * @var ParkableRepository
     */
    private $parkableRepository;

    /**
     * @var string
     */
    private $plate;

    /**
     * GetParkableTask constructor.
     * @param ParkableRepository $parkableRepository
     */
    public function __construct(ParkableRepository $parkableRepository)
    {
        $this->parkableRepository = $parkableRepository;
    }

    /**
     * @inheritdoc
     */
    function run()
    {
        return $this->parkableRepository->getParkableByPlate($this->plate);
    }

    /**
     * @param string $plate
     * @return DepartTask
     */
    public function setPlate(string $plate)
    {
        $this->plate = $plate;
        return $this;
    }
}