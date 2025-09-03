<?php

namespace App\Repositories\UserInfo;

use App\Models\User;
use App\Interfaces\UserInfoInterface;

class UserInfoRepository implements UserInfoInterface
{
    function getWhere($id)
    {
        $query = User::query()
            ->where("id", $id)
            ->first();

        return $query;
    }
}
