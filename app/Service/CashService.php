<?php

namespace App\Service;

use App\Constants\CashConstants;
use App\Models\Cash;
use App\Models\Cash_movement;

class CashService
{

    public function list()
    {
        return Cash::query()->get();
    }

    public function createOrUpdateCash(array $validated)
    {

        $cash = Cash::query()->where("clientId", $validated["clientId"])->first();
        if ($cash)
        {
            switch ($validated["type"])
            {
                case CashConstants::INPUT:
                    $cash->cash = $cash->cash + $validated["cash"];

                    break;
                case CashConstants::OUTPUT:
                    $cash->cash = $cash->cash - $validated["cash"];
                    break;
            }
        }
        else
        {
            $cash = Cash::query()->create($validated);
        }
        $cash->save();

        return $cash;
    }

    public function cashMovements(array $validated, int $cashId)
    {
        $cashMovement = new Cash_movement();
        $cashMovement->cash = $validated["cash"];
        $cashMovement->type = $validated["type"];
        $cashMovement->cashId = $cashId;
        $cashMovement->save();
    }

    public function cashPoint($clientId)
    {
        return Cash::query()->where("clientId", "=", $clientId)->get();
    }

    public function cashHistory($cashId)
    {
        return Cash_movement::query()->where("cashId", "=", $cashId)->get();
    }

    public function updateCash(array $validated, Cash $cash)
    {
        $cash->cash = $validated['cash'];
        $cash->clientId = $validated['clientId'];
        $cash->save();
        return $cash;
    }
}







?>
