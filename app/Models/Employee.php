<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $table = 'employee';
    protected $guarded = ['id'];
    protected $fillable = array(
        'company_id', 
        'fullname', 
        'email',
        'phone',
        'profile_picture',
        'dob',
        'designation',
        'created_at',
        'updated_at',
        'deleted_at'
    );

    public function company_employee(){
        return $this->belongsTo('App\Models\Company','company_id','id');
    }
}
