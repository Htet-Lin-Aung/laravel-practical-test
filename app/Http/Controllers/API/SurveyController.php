<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Requests\SurveyRequest;
use App\Http\Resources\SurveyResource;
use App\Services\SurveyService;
use Illuminate\Http\Response;

class SurveyController extends Controller
{
    protected $surveyService;

    public function __construct(SurveyService $surveyService)
    {
        $this->surveyService = $surveyService;
    }

    public function index()
    {
        try {
            $forms = $this->surveyService->surveyLists();
            $data = SurveyResource::collection($forms);

            return response()->json([
                'data' => $data,
            ], Response::HTTP_OK);

        } catch (QueryException $e) {
            return response()->json([
                'message' => 'An error occurred while fetching a user.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(SurveyRequest $request)
    {
        try {
            $response = $this->surveyService->createSurvey($request);

            return response()->json([
                'message' => $response,
            ], Response::HTTP_CREATED);

        } catch (QueryException $e) {
            return response()->json([
                'message' => 'An error occurred while creating a survey.',
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
