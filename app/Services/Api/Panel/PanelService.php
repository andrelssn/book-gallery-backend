<?php

namespace App\Services\Api\Panel;

use App\Models\MonthlyExpenses;
use App\Models\Objectives;
use App\Models\Repartitions;
use App\Repositories\UserInfo\UserInfoRepository;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class PanelService
{
    private $userInfoRepository;

    public function __construct(UserInfoRepository $userInfoRepository)
    {
        $this->userInfoRepository   = $userInfoRepository;
    }

    public function getPanel(Request $request)
    {
        $data = $this->userInfoRepository->getWhere($request->id);

        if (!isset($data)) {
            throw new HttpResponseException(response()->json([
                'error' => 'User not found'
            ], 422));
        };

        $list["MonthlyExpenses"] = MonthlyExpenses::where('id_user', $request->id)->get(["*"]);
        $list["Repartitions"] = Repartitions::where('id_user', $request->id)->get(["*"]);
        $list["Objectives"] = Objectives::where('id_user', $request->id)->get(["*"]);

        return $list;
    }
}
