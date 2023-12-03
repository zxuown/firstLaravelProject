<?php

namespace App\Http\Requests;

use App\Models\Image;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class QuestionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:254'],
            'description' => ['nullable', 'string', 'max:2000'],
            'start_at' => ['required', 'date', 'before:end_at'],
            'end_at' => ['required', 'date', 'after:start_at'],
            'active' => ['boolean'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);
        $validated['user_id'] = Auth::user()->getAuthIdentifier();
        return $validated;
    }

    public function upload(): ?Image
    {
        if (!$this->hasFile('image')) {
            return null;
        }
        $file = $this->file('image');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();

        if (Storage::disk('images')->putFileAs('', $file, $filename)) {
            $image = new Image();
            $image->filename = $filename;
            $image->save();
            return $image;
        } else {
            return null;
        }


    }
}
