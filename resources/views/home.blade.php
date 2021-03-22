@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if(Auth::user()->hasRole('superadmin'))
                        @include('partials.company')
                    @endif
                    @if(Auth::user()->hasRole('company'))
                        @include('partials.employee')
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
