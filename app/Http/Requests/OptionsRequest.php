<?php

namespace App\Http\Requests;

use App\Models\Image;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OptionsRequest extends FormRequest
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
            'question_id' => ['required', 'int'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
        ];
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
