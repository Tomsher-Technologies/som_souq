@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">Update Category Information</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('categories.update', $category->id) }}" method="POST"
                        enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="PATCH">
                        @csrf
                        <div class="form-group row">
                            <h5 class="mb-0 h6 col-md-12 col-form-label"><u>Category Name</u></h5>
                            {{-- <label class="col-md-12 col-form-label"></label> --}}
                            <div class="col-md-4">
                                <label class="col-form-label">English Name<span class="required">*</span></label>
                                <input type="text" placeholder="English Name" id="en_name" name="en_name" class="form-control" value="{{ old('en_name', $category->getTranslation('name', 'en')) }}">
                                @error('en_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label">Arabic Name</label>
                                <input type="text" placeholder="Arabic Name" id="ar_name" name="ar_name" class="form-control"  value="{{ old('ar_name', $category->getTranslation('name', 'ar')) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label">Somali Name</label>
                                <input type="text" placeholder="Somali Name" id="so_name" name="so_name" class="form-control"  value="{{ old('so_name', $category->getTranslation('name', 'so')) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-form-label"><u>Parent Category</u></label>
                                <select class="select2 form-control aiz-selectpicker" name="parent_id" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true" data-selected="{{ $category->parent_id }}">
                                    <option value="0">No Parent</option>
                                    @foreach ($categories as $categ)
                                        <option {{ old('parent_id') == $categ->id ? 'selected' : '' }} value="{{ $categ->id }}">{{ $categ->en_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label">
                                    <u>Slug</u><span class="required">*</span>
                                </label>
                                <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" value="{{ old('slug', $category->slug) }}">
                                @error('slug')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-form-label"><u>Is Active</u></label>
                                <select class="select2 form-control" name="is_active">
                                    <option {{ old('is_active',$category->is_active) == 1 ? 'selected' : '' }} value="1">Yes
                                    </option>
                                    <option {{ old('is_active',$category->is_active) == 0 ? 'selected' : '' }} value="0">No
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label" for="signinSrEmail"><u>Icon<small>(1000x1000)</small></u></label>
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            Browse</div>
                                    </div>
                                    <div class="form-control file-amount">Choose File</div>
                                    <input type="hidden" name="icon" class="selected-files" value="{{ $category->icon }}">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>
                        
                       
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            <a href="{{ Session::has('category_last_url') ? Session::get('category_last_url') : route('categories.index') }}" class="btn btn-sm btn-warning">{{translate('Cancel')}}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @livewireScripts
    @livewireStyles
    <script type="text/javascript">
        
        $('.slug_title').on('change', function() {
            let str = $(this).val();
            str = str.replace(/[^\w\s]/gi, '')
            let output = str.replace(/\s+/g, '-').toLowerCase();
            $('#slug').val(output);
        });
    </script>
@endsection
