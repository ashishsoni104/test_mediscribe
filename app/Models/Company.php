<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    //
    use SoftDeletes;
    protected $table = 'company';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    public $timestamps = false;
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

    public function company_employee(){
        return $this->hasMany('App\Models\Employee','company_id','id');
    }
}
