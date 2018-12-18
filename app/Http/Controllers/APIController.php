<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parkables\ParkableFactory;
use App\Services\ParkingService;
use Illuminate\Http\JsonResponse;


class APIController extends Controller
{
    /**
     * @var ParkingService
     */
    private $parkingService;


    /**
     * APIController constructor.
     * @param ParkingService $parkingService
     */
    public function __construct(ParkingService $parkingService)
    {
        $this->parkingService = $parkingService;
    }

    public function index()
    {
        $lots = $this->parkingService->getListLots();
        return new JsonResponse($lots);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \App\Exceptions\ParkingUnavailableException
     * @throws \App\Exceptions\InvalidTypeException
     */
    public function park(Request $request)
    {
        $this->validate($request,[
            'plate' => 'required',
            'type' => 'required|in:bus,car,motorbike'
        ]);

        $type = ParkableFactory::make($request->type);

        $parkable = $this->parkingService->getOrCreateParkable($type, $request->plate);

        if(!empty($parkable->lot()->exists())){
            return new JsonResponse([
                "status"=> 'error',
                "message"=> 'Vehicle Already Parked!.',
                "data" => $parkable
            ]
            );
        }

        if (!$lot = $this->parkingService->getAvailableLot($type)) {
            return new JsonResponse([
                    "status"=> 'error',
                    "message"=> 'No parking lots available!',
                    "data" => $parkable
                ]
            );
        }
        $output = $this->parkingService->park($parkable, $lot);


        return new JsonResponse([
                "status"=> 'success',
                "message"=> 'Parked successfully.',
                "data" => $output
            ],
            201
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \App\Exceptions\DepartingFailedException
     * @throws \App\Exceptions\ParkingUnavailableException
     */
    public function depart(Request $request)
    {
        $this->validate($request,[
            'plate' => 'required',
        ]);


        $parkable = $this->parkingService->getParkable($request->plate);

        if(empty($parkable->lot()->exists())){
            return new JsonResponse([
                    "status"=> 'error',
                    "message"=> 'Vehicle already out of the parking!',
                    "data" => $parkable
                ]
            );
        }

        $this->parkingService->depart($request->plate);

        return new JsonResponse([
            "status"=> 'success',
            "message"=> 'Departed successfully.'
        ]);
    }

}