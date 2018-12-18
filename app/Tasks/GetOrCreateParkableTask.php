<?php

namespace App\Tasks;

use App\Repositories\ParkableRepository;


class GetOrCreateParkableTask implements TaskInterface
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
     * @var string
     */
    private $type;

    /**
     * GetOrCreateParkableTask constructor.
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
        return $this->parkableRepository->getOrCreate($this->plate, $this->type);
    }

    /**
     * @param string $plate
     * @return GetOrCreateParkableTask
     */
    public function setPlate(string $plate)
    {
        $this->plate = $plate;
        return $this;
    }

    /**
     * @param string $type
     * @return GetOrCreateParkableTask
     */
    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }

}