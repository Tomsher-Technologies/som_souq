@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">Category Information</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('categories.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <h5 class="mb-0 h6 col-md-12 col-form-label"><u>Category Name</u></h5>
                            {{-- <label class="col-md-12 col-form-label"></label> --}}
                            <div class="col-md-4">
                                <label class="col-form-label">English Name<span class="required">*</span></label>
                                <input type="text" placeholder="English Name" id="en_name" name="en_name" class="form-control slug_title" value="{{ old('en_name') }}">
                                @error('en_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label">Arabic Name</label>
                                <input type="text" placeholder="Arabic Name" id="ar_name" name="ar_name" class="form-control"  value="{{ old('ar_name') }}">
                            </div>

                            <div class="col-md-4">
                                <label class="col-form-label">Somali Name</label>
                                <input type="text" placeholder="Somali Name" id="so_name" name="so_name" class="form-control"  value="{{ old('so_name') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-form-label"><u>Parent Category</u></label>
                                <select class="select2 form-control aiz-selectpicker" name="parent_id" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
                                    <option value="0">No Parent</option>
                                    @foreach ($categories as $category)
                                        <option {{ old('parent_id') == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->en_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="col-form-label">
                                    <u>Slug</u><span class="required">*</span>
                                </label>
                                <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" value="{{ old('slug') }}">
                                @error('slug')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="col-form-label"><u>Is Active</u></label>
                                <select class="select2 form-control" name="is_active">
                                    <option {{ old('is_active') == 1 ? 'selected' : '' }} value="1">Yes
                                    </option>
                                    <option {{ old('is_active') == 0 ? 'selected' : '' }} value="0">No
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
                                    <input type="hidden" name="icon" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>

                        {{-- <div class="form-group row repeater">
                            <div data-repeater-list="outer-list">
                                <div data-repeater-item style="border: 1px solid red">
                                  Repeater <input type="text" name="text-input" value="A"/>
                                  <input data-repeater-delete type="button" value="Delete"/>
                          
                                  <!-- innner repeater -->
                                  <div class="inner-repeater">
                                    <div data-repeater-list="inner-list">
                                      <div data-repeater-item style="background: #f1f1f1">
                                        Inner Repeater <input type="text" name="inner-text-input" value="B"/>
                                        <input data-repeater-delete type="button" value="Delete"/>
                                        
                                        <!-- innner repeater -->
                                      
                                      </div>
                                    </div>
                                    <input data-repeater-create type="button" value="Add Inner Repeater"/>
                                  </div>
                          
                                </div>
                              </div>
                              <input data-repeater-create type="button" value="Add Repeater"/>
                            
                        </div> --}}
                       
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
    <script type="text/javascript">
        
        $('.slug_title').on('change', function() {
            let str = $(this).val();
            str = str.replace(/[^\w\s]/gi, '')
            let output = str.replace(/\s+/g, '-').toLowerCase();
            $('#slug').val(output);
        });
    </script>
    <script>
       var $repeater = $('.repeater').repeater({
            repeaters: [{
                selector: '.inner-repeater',
                repeaters: [{ 
                    selector: '.deep-inner-repeater' 
                }]
            }]
        });

        </script>
        
@endsection
