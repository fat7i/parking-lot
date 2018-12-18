<?php

namespace App\Tasks;

use App\Repositories\MovementRepository;


class RecordMovementTask implements TaskInterface
{
    /**
     * @var int
     */
    private $lot_id;

    /**
     * @var int
     */
    private $parkable_id;

    /**
     * @var string
     */
    private $action;

    /**
     * @var MovementRepository
     */
    private $movementRepository;


    /**
     * RecordMovementTask constructor.
     * @param MovementRepository $movementRepository
     */
    public function __construct(MovementRepository $movementRepository)
    {

        $this->movementRepository = $movementRepository;
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->movementRepository->create($this->lot_id, $this->parkable_id, $this->action);
    }

    /**
     * @param int $lot_id
     * @return RecordMovementTask
     */
    public function setLotId(int $lot_id)
    {
        $this->lot_id = $lot_id;
        return $this;
    }

    /**
     * @param int $parkable_id
     * @return RecordMovementTask
     */
    public function setParkableId(int $parkable_id)
    {
        $this->parkable_id = $parkable_id;
        return $this;
    }

    /**
     * @param string $action
     * @return RecordMovementTask
     */
    public function setAction(string $action)
    {
        $this->action = $action;
        return $this;
    }


}