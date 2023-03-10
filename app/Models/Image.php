<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'rooms_id_rooms'
    ];

    public function Room()
    {
        return $this->belongsToMany(Room::class);
    }
}
