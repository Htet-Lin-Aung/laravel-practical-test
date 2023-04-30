<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SurveyRequest;
use Illuminate\Database\QueryException;
use App\Services\SurveyService;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    protected $surveyService;

    public function __construct(SurveyService $surveyService)
    {
        $this->surveyService = $surveyService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            $forms = $this->surveyService->surveyLists();

            return view('home',compact('forms'));

        } catch (QueryException $e) {
            // Handle any database query exceptions here
            abort(Response::HTTP_INTERNAL_SERVER_ERROR,"An error occurred while fetching a user.");
        }    
    }

    public function survey(Request $request)
    {   
        try{
            $response = $this->surveyService->createSurvey($request);

            return redirect()->route('home')->with('success',$response);

        }catch(QueryException $e){
            // Handle any database query exceptions here
            abort(Response::HTTP_INTERNAL_SERVER_ERROR,"An error occurred while creating a user.");
        }
    }
}