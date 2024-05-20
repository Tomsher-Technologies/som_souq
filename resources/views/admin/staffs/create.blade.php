@extends('admin.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Staff Information')}}</h5>
            </div>

            <form class="form-horizontal" action="{{ route('staffs.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            	@csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">{{translate('Name')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('Name')}}" id="name" name="name" class="form-control" value="{{ old('name') }}" autocomplete="off">
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="email">{{translate('Email')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('Email')}}" id="email" name="email" class="form-control" value="{{ old('email') }}" autocomplete="off">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">{{translate('Role')}}</label>
                        <div class="col-sm-9">
                            <select name="role" class="form-control aiz-selectpicker">
                                @foreach ($roles as $role)
                                    <option {{ old('role') == $role['name'] ? 'selected' : '' }}
                                        value="{{ $role['name'] }}">{{ $role['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label">Status</label>
                        <div class="col-sm-9">
                            <select name="status" class="form-control select2-single mb-3">
                                <option {{ old('status') == '1' ? 'selected' : '' }} value="1">
                                    Enabled
                                </option>
                                <option {{ old('status') == '0' ? 'selected' : '' }} value="0">
                                    Disabled
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="password">{{translate('Password')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('Password')}}" id="password" name="password" class="form-control"  autocomplete="off">
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="password">{{translate('Confirm Password')}}</label>
                        <div class="col-sm-9">
                            <input type="password" placeholder="{{translate('Confirm Password')}}" id="confirm-password" name="confirm-password" class="form-control"  autocomplete="off">
                            @error('confirm-password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                        <a href="{{ Session::has('staffs_last_url') ? Session::get('staffs_last_url') : route('staffs.index') }}" class="btn btn-sm btn-warning">{{translate('Cancel')}}</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection
