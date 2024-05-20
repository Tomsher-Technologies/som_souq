<div class="aiz-sidebar-wrap">
    <div class="aiz-sidebar left c-scrollbar">
        <div class="aiz-side-nav-logo-wrap">
            <a href="{{ route('admin.dashboard') }}" class="d-block text-left">
                <img class="mw-100" height="100" src="{{ asset('assets/img/logo.png') }}" 
                        alt="{{ env('APP_NAME') }}">
            </a>
        </div>
        <div class="aiz-side-nav-wrap">
            <div class="px-20px mb-3">
                <input class="form-control bg-soft-secondary border-0 form-control-sm text-white" type="text"
                    name="" placeholder="{{ translate('Search in menu') }}" id="menu-search"
                    onkeyup="menuSearch()">
            </div>
            <ul class="aiz-side-nav-list" id="search-menu">
            </ul>
            <ul class="aiz-side-nav-list" id="main-menu" data-toggle="aiz-side-menu">
            
                <li class="aiz-side-nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="aiz-side-nav-link">
                        <i class="las la-home aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">{{ translate('Dashboard') }}</span>
                    </a>
                </li>

                @can('category')
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('categories.index') }}" class="aiz-side-nav-link">
                            <i class="las la-project-diagram aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Categories') }}</span>
                        </a>
                    </li>
                @endcan
                
             
                <!-- Sellers -->
               
                    {{-- <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-user aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Sellers') }}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            
                            <li class="aiz-side-nav-item">
                                <a href="#" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text">{{ translate('Payouts') }}</span>
                                </a>
                            </li>
                          
                        </ul>
                    </li> --}}
                
               
                @can('uploads')
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('uploaded-files.index') }}"
                            class="aiz-side-nav-link {{ areActiveRoutes(['uploaded-files.create']) }}">
                            <i class="las la-upload aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Uploaded Files') }}</span>
                        </a>
                    </li>
                @endcan

                @can('locations')
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-map-marker aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Locations') }}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('states.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['states.index', 'states.edit', 'states.update']) }}">
                                    <span class="aiz-side-nav-text">{{ translate('States') }}</span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('cities.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['cities.index', 'cities.edit', 'cities.update']) }}">
                                    <span class="aiz-side-nav-text">{{ translate('Cities') }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                @can('general_settings')
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('general_setting.index') }}" class="aiz-side-nav-link">
                            <i class="las la-wrench aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('General Settings') }}</span>
                        </a>
                    </li>
                @endcan

                @can('roles')
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('roles.index') }}" class="aiz-side-nav-link">
                            <i class="las la-lock aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('User Roles') }}</span>
                        </a>
                    </li>
                @endcan

                @can('staffs')
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('staffs.index') }}" class="aiz-side-nav-link">
                            <i class="las la-user aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Staffs') }}</span>
                        </a>
                    </li>
                @endcan
             
            </ul><!-- .aiz-side-nav -->
        </div><!-- .aiz-side-nav-wrap -->
    </div><!-- .aiz-sidebar -->
    <div class="aiz-sidebar-overlay"></div>
</div><!-- .aiz-sidebar -->
