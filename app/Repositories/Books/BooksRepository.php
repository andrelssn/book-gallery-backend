<?php

namespace App\Repositories\Books;

use App\Interfaces\BooksInterface;
use App\Models\Books;

class BooksRepository implements BooksInterface
{
    function getWhere($id)
    {
        $query = Books::query()
            ->where("id", $id)
            ->first();

        return $query;
    }
}
