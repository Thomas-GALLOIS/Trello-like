<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function table()
    {

        return $this->belongsTo(Table::class);
    }

    public function tickets()
    {

        return $this->hasMany(Ticket::class, 'columns_id');
    }
}
