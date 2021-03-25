@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    
                    @if(!empty($employee))
                        @php $url = url('/edit-employee'); @endphp
                        <h5 class="card-title">Edit Employee</h5>
                    @else
                        @php $url = url('/save-employee'); @endphp
                        <h5 class="card-title">Add Employee</h5>
                    @endif
                    <form class="form" action="{{ $url }}" method="POST" enctype="multipart/form-data">
                         @csrf
                        <div class="form-group">
                            <label for="name">Fullname</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" value="{{ (!empty($employee)?$employee->fullname:old('fullname')) }}">
                            @if($errors->has('fullname'))
                                <span class="help-block error">{{ $errors->first('fullname') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" @if(!empty($employee)) readonly @endif value="{{ (!empty($employee)?$employee->email:old('email')) }}">
                            @if($errors->has('email'))
                                <span class="help-block error">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ (!empty($employee)?$employee->phone:old('fullname')) }}">
                            @if($errors->has('phone'))
                                <span class="help-block error">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="profile_picture">Profile Picture</label>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                            @if($errors->has('profile_picture'))
                                <span class="help-block error">{{ $errors->first('profile_picture') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="dob">Date of Birth</label>
                            <input type="text" class="form-control" id="dob" name="dob" value="{{ (!empty($employee)?$employee->dob:old('dob')) }}">
                            @if($errors->has('dob'))
                                <span class="help-block error">{{ $errors->first('dob') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="name">Designation</label>
                            <input type="text" class="form-control" id="designation" name="designation" value="{{ (!empty($employee)?$employee->designation:old('designation')) }}">
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
<script type="text/javascript">
    $( "#dob" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat:'yy-mm-dd'
    });
</script>
@endsection
