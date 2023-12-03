<?php

namespace App\Http\Controllers;
use App\Http\Requests\OptionsRequest;

use App\Models\Options;
use App\Models\Question;


class OptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Question $question)
    {
        return view('options.index', [
            'question' => $question,
            'models' => $question->options
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Question $question)
    {
        return view('options.create', [
            'model' => new Options(['question_id' => $question->id]),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OptionsRequest $request)
    {
        $option = new Options();
        $option->fill($request->validated());
        $image = $request->upload();
        if ($image) {
            $option->image()->associate($image);
        }
        $option->save();
        return redirect()->route('options.index', [$option->question]);
    }


    public function edit(Options $options)
    {
        return view('options.edit', [
            'model' => $options
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OptionsRequest $request, Options $options)
    {
        $options->fill($request->validated());
        $image = $request->upload();
        $oldImage = null;
        if ($image) {
            if ($options->image) {
                $oldImage = $options->image;
            }
            $options->image()->associate($image);
        }
        $options->save();
        if ($oldImage !== null) {
            $oldImage->delete();
        }

        return redirect()->route('options.index', [$options->question]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Options $options)
    {
        //
    }
}
