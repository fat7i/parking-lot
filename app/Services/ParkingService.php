<?php

namespace App\Services;


use App\Exceptions\DepartingFailedException;
use App\Exceptions\ParkingUnavailableException;
use App\Exceptions\LotsListFailedException;
use App\Models\Lot;
use App\Models\Parkable;
use App\Parkables\ParkableInterface;
use App\Tasks\DepartTask;
use App\Tasks\GetLotsTask;
use App\Tasks\GetOrCreateParkableTask;
use App\Tasks\GetLotsListTask;
use App\Tasks\GetParkableTask;
use App\Tasks\ParkTask;
use App\Tasks\RecordMovementTask;

class ParkingService
{
    /**
     * @var GetLotsListTask
     */
    private $getLotsListTask;

    /**
     * @var GetLotsTask
     */
    private $getLotsTask;

    /**
     * @var GetParkableTask
     */
    private $getParkableTask;

    /**
     * @var GetOrCreateParkableTask
     */
    private $getOrCreateParkableTask;

    /**
     * @var ParkTask
     */
    private $parkTask;

    /**
     * @var DepartTask
     */
    private $departTask;

    /**
     * @var RecordMovementTask
     */
    private $recordMovementTask;


    public function __construct(
        GetLotsListTask $listLotsTask,
        GetLotsTask $getLotsTask,
        GetParkableTask $getParkableTask,
        GetOrCreateParkableTask $getOrCreateParkableTask,
        ParkTask $parkTask,
        DepartTask $departTask,
        RecordMovementTask $recordMovementTask
    )
    {

        $this->getLotsListTask = $listLotsTask;
        $this->getLotsTask = $getLotsTask;
        $this->getParkableTask = $getParkableTask;
        $this->getOrCreateParkableTask = $getOrCreateParkableTask;
        $this->parkTask = $parkTask;
        $this->departTask = $departTask;
        $this->recordMovementTask = $recordMovementTask;
    }


    /**
     * @param Parkable $parkable
     * @param Lot $lot
     * @throws ParkingUnavailableException
     * @return Parkable
     */
    function park(Parkable $parkable, Lot $lot): Parkable
    {
        try {

            $parkable = $this->parkTask
                ->setParkableId($parkable->id)
                ->setLotId($lot->id)
                ->run();

            $this->recordMovementTask
                ->setParkableId($parkable->id)
                ->setLotId($lot->id)
                ->setAction('park')
                ->run();

            return $parkable;

        } catch (\Exception $exception) {
            throw new ParkingUnavailableException();
        }

    }

    /**
     * @param string $plate
     * @return Parkable
     * @throws ParkingUnavailableException
     */
    function getParkable(string $plate)
    {
        try {
            return $this->getParkableTask
                ->setPlate($plate)
                ->run();
        } catch (\Exception $exception) {
            throw new ParkingUnavailableException();
        }

    }

    /**
     * @param ParkableInterface $parkableType
     * @param string $plate
     * @return Parkable
     * @throws ParkingUnavailableException
     */
    function getOrCreateParkable(ParkableInterface $parkableType, string $plate)
    {
        try {
            return $this->getOrCreateParkableTask
                ->setPlate($plate)
                ->setType($parkableType->getName())
                ->run();
        } catch (\Exception $exception) {
            throw new ParkingUnavailableException();
        }

    }

    /**
     * @param ParkableInterface $parkableType
     * @return Lot
     * @throws ParkingUnavailableException
     */
    function getAvailableLot(ParkableInterface $parkableType)
    {
        try {
            return $this->getLotsTask
                ->setLotSize($parkableType->getLaneSize())
                ->run();
        } catch (\Exception $exception) {
            throw new ParkingUnavailableException();
        }

    }

    /**
     * @param string $plate
     * @throws DepartingFailedException
     */
    function depart(string $plate)
    {
        try {

            $parkable = $this->getOrCreateParkableTask
                ->setPlate($plate)
                ->setType('car')
                ->run();

            $this->departTask->setPlate($plate)->run();


            $this->recordMovementTask
                ->setParkableId($parkable->id)
                ->setLotId($parkable->lot->first()->id)
                ->setAction('depart')
                ->run();

        } catch (\Exception $exception) {
            throw new DepartingFailedException();
        }
    }

    /**
     * @return mixed
     * @throws LotsListFailedException
     */
    function getListLots()
    {
        try {
            return $this->getLotsListTask->run();
        } catch (\Exception $exception) {
            throw new LotsListFailedException();
        }
    }
}