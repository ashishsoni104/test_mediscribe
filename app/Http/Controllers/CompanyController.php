<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;
use App\User;
use App\Models\Roles;
use Auth,DataTables,DB,File,Hash;

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
        $company = Company::withCount('company_employee')->get();
        return Datatables::of($company)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn = '<a href="javascript:void(0)" class="edit-company btn btn-primary btn-sm" data-value="'.$row->id.'">Edit</a> <a href="javascript:void(0)" class="delete-company btn btn-danger btn-sm" data-value="'.$row->id.'">Delete</a>';
            return $btn;
        })
        ->addColumn('logo_url',function($row){
            $url = asset('storage/logo/').'/'.$row->logo;
            return "<img src='".$url."'  width='150' class='img-rounded' align='center' />";
        })
        ->rawColumns(['action','logo_url'])
        ->make(true);    
    }

    /**
    * Add Company View
    * @return view
    */
    public function addCompany(){
        return view('company.add_company');
    }

    /**
    * Save Company data
    * @return view
    */
    public function saveCompany(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:App\User,email',
            'password' => 'required',
            'phone' => 'numeric|required|digits:10',
            'logo' => 'required'
        ]);

        //create user for company
        $password = $request->password;
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($password);
        $user->save();
        
        //updload logo
        $logoName = time().'.'.$request->file('logo')->getClientOriginalExtension();  
        $path = storage_path('app/public/logo');
        if(!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        $request->file('logo')->move($path, $logoName);
        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->logo = $logoName;
        $company->website = $request->website;
        $company->user_id = $user->id;
        $company->save();

        //find company role
        $role = Roles::where('name','company')->first();
        if($role && $role->count()>0){
            $user->assignRole($role);
        }
        return redirect('home');
    }
    
    /**
    * get single company detail
    * @return company data
    */
    public function getSingleCompany(Request $request){
        $company_id = $request->company_id;
        $company = Company::where("id",$company_id)->first();
        return view('company.add_company',compact('company'));
    }

    /**
    * edit compannt
    * @return view
    */    
    public function editCompany(Request $request){
        $request->validate([
            'name' => 'required',
            'phone' => 'numeric|required|digits:10'
        ]);
        $logoName = '';
        if ($request->hasFile('logo')) {
            $logoName = time().'.'.$request->logo->extension();  
            $path = storage_path('app/public/logo');
            if(!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
        }
        $company_id = $request->company_id;
        $company = Company::where("id",$company_id)->first();
        $company->name = $request->name;
        $company->phone = $request->phone;
        $company->website = $request->website;
        if($logoName!=""){
            $company->logo = $logoName;
        }
        $company->save();
        return redirect('home');
    }

    /**
     * Delete Company
     * @return View
     */
    public function deleteCompany(Request $request){
        $company_id = $request->company_id;
        $company = Company::where("id",$company_id)->first();
        Company::where("id",$company_id)->delete();
        User::where('id',$company->user_id)->delete();
        Employee::where('company_id',$company_id)->delete();
        return back()->with('success','You have deleted company detail successfully.');
    }
}
