<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currencies extends Model
{
    public $timestamps = false;
    protected $fillable = ['id', 'name', 'english_name', 'alphabetic_code', 'didgit_code', 'rate'];
    protected $primaryKey = 'id';
    public $incrementing = false;
}
