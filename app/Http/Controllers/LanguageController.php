<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class LanguageController extends BaseController
{
    public function changeLanguage(string $language): JsonResponse
    {

        $languages = ['uk', 'en'];
        
        if (!in_array($language, $languages)) {
            return response()->json(['ok' => false, 'language' => app()->getLocale(), 400]);
        }

        session(['language' => $language]);
        return response()->json(['ok' => true, 'language' => $language]);
    }
}
