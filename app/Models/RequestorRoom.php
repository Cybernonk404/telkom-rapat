<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestorRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'name_requestor',
        'date',
        'time',
        'unit',
        'telephone',
        'status',
        'id_rooms',
    ];

    protected $attributes = [
        'total_participants' => 1,
        'status' => 1
    ];

    public function room()
    {
        return $this->belongsToMany(Room::class, 'id_rooms');
    }

}
