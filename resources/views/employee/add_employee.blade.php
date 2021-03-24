@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add Company</h5>
                    @if(!empty($employee))
                        @php $url = url('/edit-employee'); @endphp
                    @else
                        @php $url = url('/save-employee'); @endphp
                    @endif
                    <form class="form" action="{{ $url }}" method="POST">
                         @csrf
                        <div class="form-group">
                            <label for="name">Fullname</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" value="{{ (!empty($employee)?$employee->fullname:'') }}">
                            @if($errors->has('fullname'))
                                <span class="help-block error">{{ $errors->first('fullname') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" @if(!empty($company)) readonly @endif value="{{ (!empty($employee)?$employee->email:'') }}">
                            @if($errors->has('email'))
                                <span class="help-block error">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ (!empty($employee)?$employee->phone:'') }}">
                            @if($errors->has('phone'))
                                <span class="help-block error">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="phone">Profile Picture</label>
                            <input type="text" class="form-control" id="profile_picture" name="profile_picture" value="{{ (!empty($employee)?$employee->profile_picture:'') }}">
                            @if($errors->has('profile_picture'))
                                <span class="help-block error">{{ $errors->first('profile_picture') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="name">Date of Birth</label>
                            <input type="text" class="form-control" id="dob" name="dob" value="{{ (!empty($employee)?$employee->dob:'') }}">
                            @if($errors->has('dob'))
                                <span class="help-block error">{{ $errors->first('dob') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="name">Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation" value="{{ (!empty($employee)?$employee->designation:'') }}">
                            @if($errors->has('designation'))
                                <span class="help-block error">{{ $errors->first('designation') }}</span>
                            @endif
                        </div>
                        <input type="hidden" id="employee_id" name="employee_id" value="{{ (!empty($employee))?$employee->id:'' }}" />
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>