<?php

namespace App\Services\Api\MonthlyExpenses;

use App\Http\Resources\MonthlyExpensesCollection;
use App\Models\MonthlyExpenses;
use App\Repositories\MonthlyExpenses\MonthlyExpensesRepository;
use App\Repositories\UserInfo\UserInfoRepository;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class MonthlyExpensesService
{
    private $monthlyExpensesRepository;
    private $userInfoRepository;

    public function __construct(MonthlyExpensesRepository $monthlyExpensesRepository, UserInfoRepository $userInfoRepository)
    {
        $this->monthlyExpensesRepository = $monthlyExpensesRepository;
        $this->userInfoRepository        = $userInfoRepository;
    }

    public function getExpenses(Request $request)
    {
        $data = $this->userInfoRepository->getWhere($request->id);

        if (!isset($data)) {
            throw new HttpResponseException(response()->json([
                'error' => 'User not found'
            ], 422));
        };

        $post = MonthlyExpenses::where('id_user', $request->id)->get(["*"]);

        return new MonthlyExpensesCollection($post);
    }

    public function storeExpense(Request $request)
    {
        $data = $this->userInfoRepository->getWhere($request->id);

        if (!isset($data)) {
            throw new HttpResponseException(response()->json([
                'error' => 'User not found'
            ], 422));
        };

        $post = MonthlyExpenses::create([
            'id_user'        => $request->id,
            'expense_name'   => $request->expense_name,
            'expense_value'  => $request->expense_value,
            'parceled'       => $request->parceled,
            'parcels'        => $request->parcels,
            'current_parcel' => $request->current_parcel,
        ]);

        return $post;
    }

    public function updateExpense(Request $request, int $id): bool
    {
        $data = $this->monthlyExpensesRepository->getWhere($id);

        if (!isset($data)) {
            throw new HttpResponseException(response()->json([
                'error' => 'Expense not found'
            ], 422));
        };

        $update = MonthlyExpenses::where('id', $id)->update([
            'expense_name'   => $request->expense_name,
            'expense_value'  => $request->expense_value,
            'parceled'       => $request->parceled,
            'parcels'        => $request->parcels,
            'current_parcel' => $request->current_parcel,
        ]);

        return $update;
    }

    public function deleteExpense(int $id): bool
    {
        $delete = MonthlyExpenses::where('id', $id)->delete();

        if (!isset($delete)) {
            throw new HttpResponseException(response()->json([
                'error' => 'Expense not found'
            ], 422));
        };

        return $delete;
    }

}
