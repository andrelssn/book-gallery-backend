<?php

namespace App\Repositories\Objectives;

use App\Interfaces\ObjectivesInterface;
use App\Models\Objectives;

class ObjectivesRepository implements ObjectivesInterface
{
    function getWhere($id)
    {
        $query = Objectives::query()
            ->where("id", $id)
            ->first();

        return $query;
    }
}
