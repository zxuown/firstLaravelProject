<?php

namespace App\Console\Commands;

use App\Services\TranslatorService;
use Illuminate\Console\Command;
use App\Models\Question;
class TransaleOldQuestions extends Command
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
    protected $signature = 'app:translate-old-questions';

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
        foreach(Question::all() as $qestion){
            if(empty($qestion->translate)){
                $this->translatorService->translateQuestion($qestion);
                $qestion->save();
            }
        } 
    }
}
