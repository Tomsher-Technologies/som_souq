@extends('admin.layouts.app')

@section('content')

<div class="col-lg-12 mx-auto">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Role Information')}}</h5>
        </div>
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-3 col-from-label" for="name">{{translate('Role Name')}}</label>
                    <div class="col-md-9 row">
                        <input type="text" placeholder="{{translate('Role Name')}}" id="title" name="title" class="form-control">
                        @error('title')
                            <div class="alert alert-danger mt-1 col-md-12">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                {{-- <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Permissions') }}</h5>
                </div>
                <br> --}}
                <div class="form-group row">
                    <label class="col-md-3 col-from-label">{{ translate('Permissions') }}</label>
                    <div class="col-md-9 row">
                        @foreach($permission as $value)
                            @php 
                                $selected = '';
                                if(old('permission')){
                                    if(in_array($value->id, old('permission'))){
                                        $selected = 'checked';
                                    }
                                }
                            
                            @endphp
                            <div class="col-md-4">
                                <label class="col-from-label">{{ $value->title }}</label>
                            </div>
                            <div class="col-md-2">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="checkbox" name="permission[]" class="form-control demo-sw" value="{{$value->name}}" id="permission" {{ $selected }}>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        @endforeach

                        @error('permission')
                            <div class="alert alert-danger mt-1 col-md-12">{{ $message }}</div>
                        @enderror
                    </div>
                   
                </div>
                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                    <a href="{{ Session::has('roles_last_url') ? Session::get('roles_last_url') : route('roles.index') }}" class="btn btn-sm btn-warning">{{translate('Cancel')}}</a>
                </div>
            </div>
        </from>
    </div>
</div>

@endsection
