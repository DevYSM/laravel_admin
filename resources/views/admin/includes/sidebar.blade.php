<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}" style="height: auto">
        <div class="sidebar-brand-text mx-3 font-weight-bold">
            <h3>YSM</h3>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    @forelse(getSidebarLinks() as $link)
        <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link{{ (request()->is('admin/'.$link['name'].'*')) ? ' active' : ' collapsed' }}"
                   href="#"
                   data-toggle="collapse"
                   data-target="#collapse-{{$link['name']}}"
                   aria-expanded="{{ (request()->is('admin/'.$link['name'].'*')) ? 'true' : 'false' }}" aria-controls="collapse-{{$link['name']}}" >
                   {!! $link['icon'] !!}
                    <span>{{ ucfirst($link['name']) }}</span>
                </a>
                <div id="collapse-{{$link['name']}}" class="collapse{{ (request()->is('admin/'.$link['name'].'*')) ? ' show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        <a class="collapse-item {{ isRoute($link['name'].'.create') ? 'active' : '' }}" href="{{ route($link['name'].'.create') }}"> <i class="fas fa-chevron-circle-right mr-1"></i> Create {{ ucfirst($link['name']) }}</a>
                        <a class="collapse-item {{ isRoute($link['name'].'.index') ? 'active' : '' }}" href="{{ route($link['name'].'.index') }}"> <i class="fas fa-chevron-circle-right mr-1"></i> {{ ucfirst($link['name']) }}</a>
                    </div>
                </div>
            </li>
    @empty
    Ther's no menu item found
    @endforelse

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->
