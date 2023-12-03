<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Question;
use App\Models\Vote;
use App\Services\TranslatorService;
class HomeController extends Controller
{
    private TranslatorService $translatorService;

    public function __construct(TranslatorService $translatorService)
    {
        $this->translatorService = $translatorService;
    }


    /**
     * Display the user's profile form.
     */
    public function index(Request $request): View
    {
        return view('home.index', [
            'models' => Question::all(),
            'votes' => Vote::all(),
            't' => $this->translatorService
        ]);
    }
    public function search(Request $request)
    {
        $searchTerm = $request->input('query');

        $questions = Question::where('translate', 'LIKE', "%{$searchTerm}%")->get();

        return view('home.search', ['models' => $questions,
        'votes' => Vote::all()]);
    }
    
}