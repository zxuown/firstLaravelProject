<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property int $question_id
 * @property Question $question
 * @property int|null $image_id
 * @property Image|null $image
 */
class Options extends Model
{
    protected $fillable = [
        'title',
        'question_id',
        'image_id',
    ]; 

    public function image() {
        return $this->belongsTo(Image::class);
    }

    public function question() {
        return $this->belongsTo(Question::class);
    }
}
