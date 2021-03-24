<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\User;
use App\Models\Roles;
use Auth,DataTables,DB,File;

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
            $btn = '<a href="javascript:void(0)" class="edit-company btn btn-primary btn-sm" data-value="'.$row->id.'">Edit</a> <a href="javascript:void(0)" class="delete-company btn btn-danger btn-sm" data-value="'.$row->id.'">Delete</a>';
            return $btn;
        })
        ->addColumn('logo_url',function($row){
            $url = asset('storage/logo/');
            return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" />';
        })
        ->rawColumns(['action'])
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
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        //create user for company
        $password = $request->password;
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($password);
        $user->save();
        
        //updload logo
        $logoName = time().'.'.$request->logo->extension();  
        $path = storage_path('app/public/logo');
        if(!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        $request->logo->move($path, $imageName);
        $company = new Company();
        $company->name = $request->name;
        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->logo = $logoName;
        $company->website = $request->website;
        $company->save();

        //find company role
        $role = Roles::where('name','company')->first();
        if($role && $role->count()>0){
            $user->assignRole($role);
        }

        return back()->with('success','You have added company detail successfully.');
    }
    
    /**
    * get single company detail
    * @return company data
    */
    public function getSingleCompany(Request $request){
        $company_id = $request->company_id;
        $company = Company::where("id",$company_id)->first();
        return redirect('add-company')->with("company",$company);
    }

    /**
    * edit compannt
    * @return view
    */    
    public function editCompany(Request $request){
        $request->validate([
            'name' => 'required',
            'phone' => 'required'
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
        return back()->with('success','You have updated company detail successfully.');
    }

    /**
     * Delete Company
     * @return View
     */
    public function deleteCompany(Request $request){
        $company_id = $request->company_id;
        Company::where("id",$company_id)->delete();
        return back()->with('success','You have deleted company detail successfully.');
    }
}
