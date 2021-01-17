<h1 class="font-weight-bold text-dark mb-3 text-uppercase h2">{{ $name }} Management</h1>
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total ({{ $name }})</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $total }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-flag fa-2x text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total (Active)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $active }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pending Requests Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Total (Disabled)</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$disabled}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
