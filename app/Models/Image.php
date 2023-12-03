<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $filename
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Image extends Model
{
    protected $table = 'images';

    protected $fillable = [
        'filename',
    ];
}
