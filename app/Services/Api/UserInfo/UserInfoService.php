<?php

namespace App\Services\Api\UserInfo;

use App\Models\User;
use App\Repositories\UserInfo\UserInfoRepository;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class UserInfoService
{
    private $userInfoRepository;

    public function __construct(UserInfoRepository $userInfoRepository)
    {
        $this->userInfoRepository = $userInfoRepository;
    }

    public function updateUserInfo(Request $request, int $id): bool
    {
        $data = $this->userInfoRepository->getWhere($id);

        if (!isset($data)) {
            throw new HttpResponseException(response()->json([
                'error' => 'User not found'
            ], 422));
        };

        $update = User::where('id', $id)->update([
            'fixed_value' => $request->value,
        ]);

        return $update;
    }

    public function updateUserName(Request $request, int $id): bool
    {
        $data = $this->userInfoRepository->getWhere($id);

        if (!isset($data)) {
            throw new HttpResponseException(response: response()->json([
                'error' => 'User not found'
            ], 422));
        };

        $update = User::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return $update;
    }
}
