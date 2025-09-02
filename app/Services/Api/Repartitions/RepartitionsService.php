<?php

namespace App\Services\Api\Repartitions;

use App\Http\Resources\RepartitionsCollection;
use App\Models\Repartitions;
use App\Repositories\Repartitions\RepartitionsRepository;
use App\Repositories\UserInfo\UserInfoRepository;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class RepartitionsService
{
    private $repartitionsRepository;
    private $userInfoRepository;

    public function __construct(RepartitionsRepository $repartitionsRepository, UserInfoRepository $userInfoRepository)
    {
        $this->repartitionsRepository = $repartitionsRepository;
        $this->userInfoRepository        = $userInfoRepository;
    }

    public function getRepartitions(Request $request)
    {
        $data = $this->userInfoRepository->getWhere($request->id);

        if (!isset($data)) {
            throw new HttpResponseException(response()->json([
                'error' => 'User not found'
            ], 422));
        };

        $post = Repartitions::where('id_user', $request->id)->get(["*"]);

        return new RepartitionsCollection($post);
    }

    public function storeRepartition(Request $request)
    {
        $data = $this->userInfoRepository->getWhere($request->id);

        if (!isset($data)) {
            throw new HttpResponseException(response()->json([
                'error' => 'User not found'
            ], 422));
        };

        $post = Repartitions::create([
            'id_user'           => $request->id,
            'repartition_name'  => $request->repartition_name,
            'repartition_value' => $request->repartition_value,
        ]);

        return $post;
    }

    public function updateRepartition(Request $request, int $id): bool
    {
        $data = $this->repartitionsRepository->getWhere($id);

        if (!isset($data)) {
            throw new HttpResponseException(response()->json([
                'error' => 'Expense not found'
            ], 422));
        };

        $update = Repartitions::where('id', $id)->update([
            'repartition_name'  => $request->repartition_name,
            'repartition_value' => $request->repartition_value,
        ]);

        return $update;
    }

    public function deleteRepartition(int $id): bool
    {
        $delete = Repartitions::where('id', $id)->delete();

        if (!isset($delete)) {
            throw new HttpResponseException(response()->json([
                'error' => 'Expense not found'
            ], 422));
        };

        return $delete;
    }

}
