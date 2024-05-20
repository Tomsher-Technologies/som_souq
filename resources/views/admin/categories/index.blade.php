@extends('admin.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">All Categories</h1>
            </div>
            <div class="col-md-6 text-md-right">
                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                    <span>Add new category</span>
                </a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-block d-md-flex">
            <h5 class="mb-0 h6 mr-4">Categories</h5>
            <form class="" id="sort_categories" action="" method="GET" style="width: 100%">

                <div class="row gutters-5">
                    <div class="col-md-4">
                        <select class="form-control form-control-sm aiz-selectpicker mb-2 mb-md-0" data-live-search="true"
                            name="catgeory" id="" data-selected={{ $catgeory }}>
                            <option value="0">All</option>
                            @foreach ($filterCategories as $item)
                                <option value="{{ $item->id }}">{{ $item->en_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="search"
                            name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset
                            placeholder="Type name & Enter">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary" type="submit">Filter</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-warning">{{translate('Reset')}}</a>
                    </div>
                </div>

            </form>
        </div>

        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th >#</th>
                        <th>Name</th>
                        <th >Parent Category</th>
                    
                        <th class="text-center">Icon</th>
                        <th class="text-center">Status</th>
                        <th width="10%" class="text-center">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $category)
                        <tr>
                            <td>{{ $key + 1 + ($categories->currentPage() - 1) * $categories->perPage() }}</td>
                            <td>{{ $category->en_name }}</td>
                            <td>
                                {{ $category->parentCategory?->en_name ?? '-' }}
                            </td>
                           
                            <td class="text-center">
                                @if ($category->icon != null)
                                    <span class="avatar avatar-square avatar-xs">
                                        <img src="{{ uploaded_asset($category->icon) }}" alt="icon">
                                    </span>
                                @else
                                    —
                                @endif
                            </td>
                            <td class="text-center">
                                <label class="aiz-switch aiz-switch-success mb-0">
                                    <input type="checkbox" onchange="update_status(this)" value="{{ $category->id }}"
                                        <?php if ($category->is_active == 1) {
                                            echo 'checked';
                                        } ?>>
                                    <span></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                    href="{{ route('categories.edit', ['id' => $category->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}"
                                    title="Edit">
                                    <i class="las la-edit"></i>
                                </a>
                                {{-- <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                    data-href="{{ route('categories.destroy', $category->id) }}" title="Delete">
                                    <i class="las la-trash"></i>
                                </a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $categories->appends(request()->input())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection


@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')
    <script>
        function copy(that) {
            var inp = document.createElement('input');
            document.body.appendChild(inp)
            inp.value = that.textContent
            inp.select();
            document.execCommand('copy', false);
            inp.remove();
        }
    </script>
    <script type="text/javascript">
        
        function update_status(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('categories.status') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', 'Category status updated successfully');
                } else {
                    AIZ.plugins.notify('danger', 'Something went wrong');
                }
            });
        }
    </script>
@endsection
