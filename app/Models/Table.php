<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function user_creator()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function columns()
    {

        return $this->hasMany(Column::class, 'tables_id');
    }
}
