<?php


namespace App\Http\Controllers;
use App\Http\Requests\OptionsRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Options;
use App\Models\Question;
use App\Models\Vote;
use App\Services\TranslatorService;
class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private TranslatorService $translatorService;

    public function __construct(TranslatorService $translatorService)
    {
        $this->translatorService = $translatorService;
    }
    public function res($questionId){
        $question = Question::findOrFail($questionId); 
        $options = $question->options; 
        $votes = Vote::whereIn('option_id', $options->pluck('id'))->get(); 
        foreach ($options as $option) {
            $voteCount = $votes->where('option_id', $option->id)->count();
            $totalVotes = $votes->count();
            
            if ($totalVotes > 0) {
                $option->vote_percentage = round(($voteCount / $totalVotes) * 100);
            } else {
                $option->vote_percentage = 0;
            }
        }

        return view('vote.res', [
            'model' => $votes,
            'question' => $question,
            'options' => $options,
        ]);
    }
    public function index($questionId)
    {
        // Fetch the question based on the $questionId
        $question = Question::findOrFail($questionId);

        // Pass the question and its options to the view
        return view('vote.index', [
            'question' => $question,
            'models' => $question->options,
            't' => $this->translatorService
        ]);
    }
    public function store($questionId, $optionId)
    {
        $question = Question::findOrFail($questionId);
        $option = Options::findOrFail($optionId);
        
        $user = Auth::user();
        
        // Check if the user has already voted for this question
        $existingVote = Vote::where('user_id', $user->id)
                            ->where('question_id', $question->id)
                            ->exists();
    
        if (!$existingVote) {
            // Create a new vote with the user ID
            $vote = new Vote([
                'user_id' => $user->id,
                'question_id' => $question->id,
                'option_id' => $option->id,
                'vote_at' => now(), // Or any timestamp indicating when the vote occurred
            ]);
            
            $vote->save();
        }
    
        return redirect()->route('home.index');
    }
   
}
