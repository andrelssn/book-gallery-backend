<?php

namespace App\Repositories\Authors;

use App\Interfaces\AuthorsInterface;
use App\Models\Authors;

class AuthorsRepository implements AuthorsInterface
{
    function getWhere($id)
    {
        $query = Authors::query()
            ->where("id", $id)
            ->first();

        return $query;
    }
}
