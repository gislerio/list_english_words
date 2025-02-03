<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorites';

    protected $fillable = [
        'user_id',
        'word_id',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'word_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function word()
    {
        return $this->belongsTo(Word::class);
    }
}
