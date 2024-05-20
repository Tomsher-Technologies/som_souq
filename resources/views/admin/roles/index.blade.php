@extends('admin.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3">{{translate('All User Roles')}}</h1>
		</div>
		<div class="col-md-6 text-md-right">
			<a href="{{ route('roles.create') }}" class="btn btn-circle btn-info">
				<span>{{translate('Add New Role')}}</span>
			</a>
		</div>
	</div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('Roles')}}</h5>
    </div>
    <div class="card-body">
        <table class="table aiz-table">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>{{translate('Role Name')}}</th>
                    <th class="text-center">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $key => $role)
                    <tr>
                        <td class="text-center">{{ ($key+1) + ($roles->currentPage() - 1)*$roles->perPage() }}</td>
                        <td>{{ $role->name}}</td>
                        <td class="text-center">
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('roles.edit',$role)}}" title="{{ translate('Edit') }}">
                                <i class="las la-edit"></i>
                            </a>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $roles->appends(request()->input())->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
