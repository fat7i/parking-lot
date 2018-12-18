<?php

namespace App\Tasks;

use App\Repositories\LotRepository;


class GetLotsTask implements TaskInterface
{
    /**
     * @var LotRepository
     */
    private $lotRepository;
    /**
     * @var int
     */
    private $lotSize;

    /**
     * GetLotsTask constructor.
     * @param LotRepository $lotRepository
     */
    public function __construct(LotRepository $lotRepository)
    {
        $this->lotRepository = $lotRepository;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        return $this->lotRepository->getByLotSize($this->lotSize);
    }

    /**
     * @param float $lotSize
     * @return GetLotsTask
     */
    public function setLotSize(float $lotSize)
    {
        $this->lotSize = $lotSize;
        return $this;
    }

}