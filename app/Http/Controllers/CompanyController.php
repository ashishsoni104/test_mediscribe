<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Auth;
use DataTables;

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
        $company = Company::select(
            'name',
            'email',
            'phone',
            DB::raw('CONCAT('.$logoUrl.',logo) as logo_url'),
            'website',
            'created_at',
            'id',
            DB::raw('SELECT COUNT(*) as total_emp FROM employee join company on employee.company_id = company.id'))
            ->where('user_id',$user_id)
            ->get();
            return Datatables::of($company)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);    
    }
}
