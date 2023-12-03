<?php

namespace App\Services;

use Google\Cloud\Translate\V2\TranslateClient;
use Illuminate\Support\Facades\Cache;
use App\Models\Question;
/**
 * Class TranslatorService.
 */
class TranslatorService
{
    private string $keyFilePath;
    private TranslateClient $client;
    public function __construct(string $keyFilePath)
    {
        $this->keyFilePath = $keyFilePath;
        $this->client = new TranslateClient([
            'keyFilePath' => $this->keyFilePath
        ]);
    }

    public function translate(string $text, string $to): string {

        $cacheKey = sha1(json_encode([$to, $text]));

        return Cache::rememberForever($cacheKey, function () use ($text, $to) {
            $result = $this->client->translate($text, [
                //'source' => 'en',
                'target' => $to,
            ]);

            return $result['text'];
        });
    }

    public function translateQuestion(Question $question) {
        $title = $question->title;
        $languages = ['en', 'uk'];
        $all = $question->title;
        for( $i = 0; $i < count($languages); $i++ ) 
        {
            $all .= $this->translate($title, $languages[$i]);
        }
        $question->translate = $all;
    }
}
