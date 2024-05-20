@extends('admin.layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h1 class="mb-0 h6">{{translate('General Settings')}}</h1>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('business_settings.update') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <h6 class="mb-0"><u> APP Links</u> </h6>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{translate('App Store Link')}}</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="types[]" value="app_store_link">
                                <input type="text" name="app_store_link" class="form-control" value="{{ get_setting('app_store_link') }}">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{translate('Play Store Link')}}</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="types[]" value="play_store_link">
                                <input type="text" name="play_store_link" class="form-control" value="{{ get_setting('play_store_link') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <h6><u> Social Links</u></h6>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{translate('Facebook Link')}}</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="types[]" value="facebook_link">
                                <input type="text" name="facebook_link" class="form-control" value="{{ get_setting('facebook_link') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{translate('Instagram Link')}}</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="types[]" value="instagram_link">
                                <input type="text" name="instagram_link" class="form-control" value="{{ get_setting('instagram_link') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{translate('Twitter Link')}}</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="types[]" value="twitter_link">
                                <input type="text" name="twitter_link" class="form-control" value="{{ get_setting('twitter_link') }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{translate('LinkedIn Link')}}</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="types[]" value="linkedin_link">
                                <input type="text" name="linkedin_link" class="form-control" value="{{ get_setting('linkedin_link') }}">
                            </div>
                        </div>


                       
                        <div class="text-right">
    						<button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
    					</div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
