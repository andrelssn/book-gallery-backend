<?php

namespace App\Services\Api\Objectives;

use App\Http\Resources\ObjectivesCollection;
use App\Models\Objectives;
use App\Models\Repartitions;
use App\Repositories\Objectives\ObjectivesRepository;
use App\Repositories\UserInfo\UserInfoRepository;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class ObjectivesService
{
    private $objectivesRepository;
    private $userInfoRepository;

    public function __construct(ObjectivesRepository $objectivesRepository, UserInfoRepository $userInfoRepository)
    {
        $this->objectivesRepository = $objectivesRepository;
        $this->userInfoRepository   = $userInfoRepository;
    }

    public function getObjectives(Request $request)
    {
        $data = $this->userInfoRepository->getWhere($request->id);

        if (!isset($data)) {
            throw new HttpResponseException(response()->json([
                'error' => 'User not found'
            ], 422));
        };

        $list = Objectives::where('id_user', $request->id)->get(["*"]);

        return new ObjectivesCollection($list);
    }

    public function storeObjective(Request $request)
    {
        $data = $this->userInfoRepository->getWhere($request->id);

        if (!isset($data)) {
            throw new HttpResponseException(response()->json([
                'error' => 'User not found'
            ], 422));
        };

        $post = Objectives::create([
            'id_user'         => $request->id,
            'objective_name'  => $request->objective_name,
            'objective_value' => $request->objective_value,
            'current_value'   => $request->current_value,
            'completed'       => $request->completed,
        ]);

        return $post;
    }

    public function updateObjective(Request $request, int $id): bool
    {
        $data = $this->objectivesRepository->getWhere($id);

        if (!isset($data)) {
            throw new HttpResponseException(response()->json([
                'error' => 'Objective not found'
            ], 422));
        };

        $update = Objectives::where('id', $id)->update([
            'objective_name'  => $request->objective_name,
            'objective_value' => $request->objective_value,
            'current_value'   => $request->current_value,
            'completed'       => $request->completed,
        ]);

        return $update;
    }

    public function deleteObjective(int $id): bool
    {
        $delete = Objectives::where('id', $id)->delete();

        if (!isset($delete)) {
            throw new HttpResponseException(response()->json([
                'error' => 'Objective not found'
            ], 422));
        };

        return $delete;
    }

}
