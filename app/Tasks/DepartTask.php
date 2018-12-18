<?php

namespace App\Tasks;


use App\Repositories\ParkableRepository;

class DepartTask implements TaskInterface
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
     * DepartTask constructor.
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
        $this->parkableRepository->deleteParkingByPlate($this->plate);
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