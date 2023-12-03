<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $question_id
 * @property Question $question
 * @property int $option_id
 * @property Options $option
 * @property Carbon $vote_at
 */
class Vote extends Model
{
    protected $fillable = [
        'question_id',
        'option_id',
        'user_id',
        'vote_at'
    ]; 

    public function option() {
        return $this->belongsTo(Options::class);
    }

    public function question() {
        return $this->belongsTo(Question::class);
    }
}
