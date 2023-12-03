<?php

namespace App\Console\Commands;

use App\Services\TranslatorService;
use Illuminate\Console\Command;

class TestTranslate extends Command
{
    private TranslatorService $translatorService;

    public function __construct(TranslatorService $translatorService)
    {
        parent::__construct();
        $this->translatorService = $translatorService;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-translate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
//        $translate = new TranslateClient([
//            'keyFilePath' => '/home/raid3r81/projects/rv211-laravel/example/config/glassy-automata-332610-9623e9c577da.json'
//        ]);
//
        $text = "Hello world";
        var_dump($this->translatorService->translate($text, 'fr'));
//
//        $result = $translate->translate($text, [
//            'source' => 'en',
//            'target' => 'uk',
//        ]);
//
//        var_dump($result);

        //
    }
}
