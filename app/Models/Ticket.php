<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function column()
    {

        return $this->belongsTo(Column::class);
    }

    public function comments()
    {

        return $this->hasMany(Comment::class, "tickets_id");
    }
}
