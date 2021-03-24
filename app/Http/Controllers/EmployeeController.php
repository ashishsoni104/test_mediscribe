<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Auth,DataTables,DB,File;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
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
    public function getEmployeeRecords(Request $request){
        $user_id = Auth::user()->id;
        $logoUrl = asset('storage/logo/');
        $employee = Employee::get();
        return Datatables::of($employee)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btn = '<a href="javascript:void(0)" class="edit-employee btn btn-primary btn-sm" data-value="'.$row->id.'">Edit</a> <a href="javascript:void(0)" class="delete-employee btn btn-danger btn-sm" data-value="'.$row->id.'">Delete</a>';
            return $btn;
        })
        ->addColumn('profile_picture',function($row){
            $url = asset('storage/profie_picture/');
            return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" />';
        })
        ->rawColumns(['action','profile_picture'])
        ->make(true);    
    }

    /**
    * Add employee View
    * @return view
    */
    public function addEmployee(){
        return view('company.add_employee');
    }

    /**
    * Save Employee data
    * @return view
    */
    public function saveEmployee(Request $request){
        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg',
            'dob'=>'required',
            'designation'=>'required'
        ]);

        //updload profile picture
        $profilePictureName = time().'.'.$request->profile_picture->extension();  
        $path = storage_path('app/public/profile_picture');
        if(!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }
        $request->profile_picture->move($path, $imageName);
        $employee = new Employee();
        $employee->fullname = $request->fullname;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->profile_picture = $profilePictureName;
        $employee->dob = $request->dob;
        $employee->designation = $request->designation;
        $employee->created_at = date('Y-m-d H:i:s');
        $employee->save();

        return back()->with('success','You have added company detail successfully.');
    }
    
    /**
    * get single company detail
    * @return company data
    */
    public function getSingleEmployee(Request $request){
        $employee_id = $request->employee_id;
        $employee = Employee::where("id",$employee_id)->first();
        return redirect('add-employee')->with("employee",$employee);
    }

    /**
    * edit compannt
    * @return view
    */    
    public function editEmployee(Request $request){
        $request->validate([
            'fullname' => 'required',
            'phone' => 'required',
            // 'profile_picture' => 'required|image|mimes:jpeg,png,jpg',
            'dob'=>'required',
            'designation'=>'required'
        ]);
        $profilePictureName = '';
        if ($request->hasFile('profile_picture')) {
            $profilePictureName = time().'.'.$request->profile_picture->extension();  
            $path = storage_path('app/public/profile_picture');
        }
        $employee_id = $request->employee_id;
        $employee = Employee::where("id",$employee_id)->first();
        $employee->fullname = $request->fullname;
        $employee->phone = $request->phone;
        $employee->dob = $request->dob;
        $employee->designation = $request->designation;
        $employee->updated_at = date('Y-m-d H:i:s');
        if($profilePictureName!=""){
            $employee->profile_picture = $profilePictureName;
        }
        $employee->save();
        return back()->with('success','You have updated company detail successfully.');
    }

    /**
     * Delete Company
     * @return View
     */
    public function deleteEmployee(Request $request){
        $employee_id = $request->employee_id;
        Employee::where("id",$employee_id)->delete();
        return back()->with('success','You have deleted company detail successfully.');
    }
}
