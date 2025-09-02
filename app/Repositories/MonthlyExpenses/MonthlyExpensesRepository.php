<?php

namespace App\Repositories\MonthlyExpenses;

use App\Interfaces\MonthlyExpensesInterface;
use App\Models\MonthlyExpenses;

class MonthlyExpensesRepository implements MonthlyExpensesInterface
{
    function getWhere($id)
    {
        $query = MonthlyExpenses::query()
            ->where("id", $id)
            ->first();

        return $query;
    }
}
