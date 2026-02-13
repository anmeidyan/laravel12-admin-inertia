@if(session()->has('danger'))
    <div class="alert alert-danger alert-dismissible">
        <h5 style="margin-bottom:0;font-size: 17px;"><i class="icon fas fa-ban"></i> {{ session('danger') }}</h5>
    </div>
@elseif(session()->has('info'))
    <div class="alert alert-info alert-dismissible">
        <h5 style="margin-bottom:0;font-size: 17px;"><i class="icon fas fa-info"></i> {{ session('info') }}</h5>
    </div>
@elseif(session()->has('warning'))
    <div class="alert alert-warning alert-dismissible">
        <h5 style="margin-bottom:0;font-size: 17px;"><i class="icon fas fa-exclamation-triangle"></i> {{ session('warning') }}</h5>
    </div>
@elseif(session()->has('success'))
    <div class="alert alert-success alert-dismissible">
        <h5 style="margin-bottom:0;font-size: 17px;"><i class="icon fas fa-check"></i> {{ session('success') }}</h5>
    </div>
@endif