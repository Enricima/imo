<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'firstName',
        'address',
        'city',
        'zip',
        'surface',
        'type',
        'state',
        'rooms',
        'sdb',
        'extras',
        'photos',
        'status',
        'price',
    ];

    protected $casts = [
        'extras' => 'array', 
        'photos' => 'array', 
    ];

    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_favorites')->withTimestamps();
    }
}
