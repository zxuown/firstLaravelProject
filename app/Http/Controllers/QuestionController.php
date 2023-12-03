<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\TranslatorService;
class QuestionController extends Controller
{
    private TranslatorService $translatorService;

    public function __construct(TranslatorService $translatorService)
    {
        $this->translatorService = $translatorService;
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('question.index', [
            'models' => Question::all(),
            't' => $this->translatorService
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('question.create', [
            'model' => new Question()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionRequest $request)
    {
        $question = new Question();
        $question->fill($request->validated());
        $this->translatorService->translateQuestion($question);
        $image = $request->upload();
        if ($image) {
            $question->image()->associate($image);
        }
        $question->save();
        return redirect()->route('questions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        return view('question.edit', [
            'model' => $question
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $question->fill($request->validated());
        $this->translatorService->translateQuestion($question);
        $image = $request->upload();
        $oldImage = null;
        $question->active = $request->has('active');
        if ($image) {
            if ($question->image) {
                $oldImage = $question->image;
            }
            $question->image()->associate($image);
        }
        $question->save();
        if ($oldImage !== null) {
            $oldImage->delete();
        }

        return redirect()->route('questions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }
}
