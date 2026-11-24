<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
  protected $fillable = [
        'title',
        'author',
        'category',
        'unit_price',
        'description',
        'availability_status',
    ];

    // A book belongs to one administrator
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
