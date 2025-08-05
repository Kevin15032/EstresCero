<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmotionalEntry extends Model
{
    protected $fillable = ['date', 'stress_level', 'emotion', 'comment', 'user_id'];

    protected $casts = [
        'date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
