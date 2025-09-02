<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Api\Panel\PanelService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class PanelController extends Controller
{

    private $panelService;

    public function __construct(PanelService $panelService)
    {
        $this->panelService = $panelService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $requisition = $this->panelService->getPanel($request);

        if (!$requisition) {
            throw new HttpResponseException(response()->json([
                'error' => "An error has ocurred during the requisition."
            ], 422));
        }

        return response()->json([
            'status'    => true,
            'message'   => "Panel data.",
            'data'      => $requisition
        ], 200);
    }
}
