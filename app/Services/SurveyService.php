<?php

namespace App\Services;

use App\Models\Form;
use App\Models\Survey;
use App\Notifications\EmailSurvey;
use Illuminate\Support\Facades\Notification;
use App\Events\SurveyCreated;

class SurveyService
{
    public function surveyLists()
    {
        $forms = Form::with('fields', 'surveys')->paginate(25);

        return $forms;
    }
    
    public function createSurvey($request)
    {
        $survey = Survey::where('user_id',auth()->id())
            ->where('form_id',$request->form_id)
            ->first();
        
        if ($survey) {
            return 'You had already answered this survey!';
        }

        $form = Form::with('fields', 'surveys')->findOrFail($request->form_id);

        $newSurvey = $form->surveys()->createMany($request->surveys);

        event(new SurveyCreated($newSurvey->first()));
        
        return 'Thank you for your answer.';
    }
}