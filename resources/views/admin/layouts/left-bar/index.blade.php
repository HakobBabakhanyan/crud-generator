<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"> {{ env('APP_NAME') }} </div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    @include('admin.layouts.left-bar.li',[
'name'=>'Dashboard',
'active'=>$active_menu??null,
'fa_icon'=>'fas fa-fw fa-tachometer-alt',
'route'=>route('admin.index')
])
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Site pages
    </div>

@include('admin.layouts.left-bar.li',[
'name'=>'Languages',
'active'=>(isset($active_menu) && $active_menu == 'Languages')?true:false,
'fa_icon'=>'fas fa-language',
'route'=>route('admin.languages')
])


@foreach(config('custom-config.crud') as $name=>$config)
    @if(isset($config['list_show']) && !$config['list_show']) @continue @endif
    @include('admin.layouts.left-bar.li',[
    'name'=>$name,
    'active'=>(isset($custom_configs) && $custom_configs['route'] == $config['route'])?true:false,
    'fa_icon'=>'fas fa-newspaper',
    'route'=>route('admin.'.$config['route'].'.index')
    ])
@endforeach


<!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
