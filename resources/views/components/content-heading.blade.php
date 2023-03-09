<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ $pageHeading }}</h1>
            </div><!-- /.col -->
            @if ($showBredCrumb == 'true')
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url(route('admin.dashboard')) }}">Home</a></li>
                        <li class="breadcrumb-item active">{{ $pageHeading }}</li>
                    </ol>
                </div><!-- /.col -->
            @endif
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
