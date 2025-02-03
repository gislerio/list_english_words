<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Word extends Model
{
    use HasFactory;

    protected $table = 'words';

    protected $fillable = [
        'word',
        'definition',
    ];

    protected $casts = [
        'word' => 'string',
        'definition' => 'string',
    ];

    public function history(): HasMany
    {
        return $this->hasMany(History::class);
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }
}
