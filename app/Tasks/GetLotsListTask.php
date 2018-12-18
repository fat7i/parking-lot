<?php

namespace App\Tasks;

use App\Repositories\LotRepository;


class GetLotsListTask implements TaskInterface
{
    /**
     * @var LotRepository
     */
    private $lotRepository;


    public function __construct(LotRepository $lotRepository)
    {
        $this->lotRepository = $lotRepository;
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->lotRepository->getLotsList();
    }

}