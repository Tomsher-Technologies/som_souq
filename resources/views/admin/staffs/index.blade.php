@extends('admin.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class="row align-items-center">
		<div class="col-md-6">
			<h1 class="h3">{{translate('All Staffs')}}</h1>
		</div>
		<div class="col-md-6 text-md-right">
			<a href="{{ route('staffs.create') }}" class="btn btn-circle btn-info">
				<span>{{translate('Add New Staffs')}}</span>
			</a>
		</div>
	</div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('Staffs')}}</h5>
    </div>
    <div class="card-body">
        <table class="table aiz-table mb-0">
            <thead>
                <tr>
                    <th class="text-center" width="10%">#</th>
                    <th>{{translate('Name')}}</th>
                    <th>{{translate('Email')}}</th>
                    <th class="text-center">{{translate('Role')}}</th>
                    <th class="text-center">{{translate('Status')}}</th>
                    <th  class="text-center">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staffs as $key => $staff)
                    <tr>
                        <td class="text-center">{{ ($key+1) + ($staffs->currentPage() - 1)*$staffs->perPage() }}</td>
                        <td>{{$staff->name}}</td>
                        <td>{{$staff->email}}</td>
                        <td class="text-center">
                            @if(!empty($staff->getRoleNames()))
                                @foreach($staff->getRoleNames() as $v)
                                {{ $v }}
                                @endforeach
                            @endif
                        </td>
                        <td class="text-center">
                            <b>{!! $staff->status == 1 ? '<span class="text-success">Enabled</span>' : '<span class="text-danger">Disabled</span>' !!}</b>
                        </td>
                        <td class="text-center">
                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('staffs.edit', $staff)}}" title="{{ translate('Edit') }}">
                                    <i class="las la-edit"></i>
                                </a>
                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('staffs.destroy', $staff)}}" title="{{ translate('Delete') }}">
                                    <i class="las la-trash"></i>
                                </a>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $staffs->appends(request()->input())->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection
