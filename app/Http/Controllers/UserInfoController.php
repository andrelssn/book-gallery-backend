<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Api\UserInfo\UserInfoService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class UserInfoController extends Controller
{

    private $userInfoService;

    public function __construct(UserInfoService $userInfoService)
    {
        $this->userInfoService = $userInfoService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateValue(Request $request, int $id)
    {
        $requisition = $this->userInfoService->updateUserInfo($request, $id);

        if (!$requisition) {
            throw new HttpResponseException(response()->json([
                'error' => "An error has ocurred during the requisition."
            ], 422));
        }

        return response()->json([
            'status' => true,
            'message' => "User info updated.",
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateName(Request $request, int $id)
    {
        $requisition = $this->userInfoService->updateUserName($request, $id);

        if (!$requisition) {
            throw new HttpResponseException(response()->json([
                'error' => "An error has ocurred during the requisition."
            ], 422));
        }

        return response()->json([
            'status' => true,
            'message' => "User info updated.",
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
