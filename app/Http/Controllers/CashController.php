<?php

namespace App\Http\Controllers;

use App\Http\Requests\CashRequest;
use App\Http\Resources\CashMovementResource;
use App\Http\Resources\CashResource;
use App\Service\CashService;
use App\Models\Cash;

class CashController extends Controller
{

    private $cashService;

    public function __construct(CashService $cashService)
    {
        $this-> cashService = $cashService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getList()
    {
        $cash = $this->cashService->list();
        return CashResource::collection($cash);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CashRequest $request)
    {
        $cash = $this->cashService->createOrUpdateCash($request->validated());
        $this->cashService->cashMovements($request->validated(), $cash->id);
        return new CashResource($cash->load('client'));
    }

    public function showClient($clientId)
    {
        $cash = $this->cashService->cashPoint($clientId);
        return  CashResource::collection($cash);
    }

    public function showHistory($cashId)
    {
        $cash = $this->cashService->cashHistory($cashId);
        return  CashMovementResource::collection($cash);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CashRequest $request, Cash $cash)
    {
        $cash = $this->cashService->updateCash($request->validated(), $cash);
        return  new CashResource($cash->load("client"));
    }
}
