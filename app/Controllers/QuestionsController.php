<?php

namespace App\Controllers;

class QuestionsController extends BaseController
{
    public function index()
    {
        return view('questions');
    }
}