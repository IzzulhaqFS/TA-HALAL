<?php

namespace App\Http\Controllers;

use App\Helpers\KeywordBahan;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function index(Request $request)
    {
        $activity =  $request->query('activity');
        $query = KeywordBahan::getRecommendationQuery($activity);

        return view('recommendation.index', compact('query'));
    }
}
