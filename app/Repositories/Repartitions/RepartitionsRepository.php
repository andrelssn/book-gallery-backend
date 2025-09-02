<?php

namespace App\Repositories\Repartitions;

use App\Interfaces\MonthlyExpensesInterface;
use App\Models\Repartitions;

class RepartitionsRepository implements MonthlyExpensesInterface
{
    function getWhere($id)
    {
        $query = Repartitions::query()
            ->where("id", $id)
            ->first();

        return $query;
    }
}
