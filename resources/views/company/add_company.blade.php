@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add Company</h5>
                    @if(!empty($company))
                        @php $url = url('/edit-company'); @endphp
                    @else
                        @php $url = url('/save-company'); @endphp
                    @endif
                    <form class="form" action="{{ $url }}" method="POST">
                         @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ (!empty($company)?$company->name:'') }}">
                            @if($errors->has('name'))
                                <span class="help-block error">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" @if(!empty($company)) readonly @endif  value="{{ (!empty($company)?$company->email:'') }}" >
                            @if($errors->has('email'))
                                <span class="help-block error">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        @if(empty($company))
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            @if($errors->has('password'))
                                <span class="help-block error">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ (!empty($company)?$company->phone:'') }}">
                            @if($errors->has('phone'))
                                <span class="help-block error">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo">
                            @if($errors->has('logo'))
                                <span class="help-block error">{{ $errors->first('logo') }}</span>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" class="form-control" id="website" name="website" value="{{ (!empty($company)?$company->website:'') }}">
                        </div>
                        <input type="hidden" id="company_id" name="company_id" value="{{ (!empty($company))?$company->id:'' }}" />
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection