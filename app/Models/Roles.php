<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    //
    protected $table = 'roles';
    protected $guarded = ['id'];
    protected $fillable = array('name', 'label', 'description');
}
