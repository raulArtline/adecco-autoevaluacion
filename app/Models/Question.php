<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'list_questions'
    ];

    // Get the surveys for the question.
    public function surveys(): HasMany
    {
        return $this->hasMany(Survey::class, 'survey_id');
    }
}
