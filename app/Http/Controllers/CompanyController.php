<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Auth,DataTables,DB;

class CompanyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *  Get all user created record
     *  @return collection
     */
    public function getCompanyRecords(Request $request){
        $user_id = Auth::user()->id;
        $logoUrl = asset('storage/logo/');
        $company = Company::withCount('company_employee')->get();
        return Datatables::of($company)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
            return $btn;
        })
        ->rawColumns(['action'])
        ->make(true);    
    }
}
