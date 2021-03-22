<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $table = 'company';
    protected $guarded = ['id'];
    protected $fillable = array(
        'user_id', 
        'name', 
        'email',
        'phone',
        'logo',
        'website',
        'created_at',
        'updated_at',
        'deleted_at'
    );
}
