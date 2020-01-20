<div class="col-3">
    <!-- Dropdown Card Example -->
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">{{ $files->type }}</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Files settings:</div>
{{--                    <a class="dropdown-item" href="{{ route('admin.'.$params['route'].'.type',[$name,$images->id,1]) }}">to profile</a>--}}
{{--                    <a class="dropdown-item" href="#">alt</a>--}}
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('admin.'.$params['route'].'.file.destroy',[$files->id]) }}">remove</a>
                </div>
            </div>
        </div>
        <!-- Card Body -->
        <div class="card-body d-flex flex-column">
            <div>
                {{ $files->title }}
{{--                <img class="img-fluid"  style="max-height: 250px" src="{{ asset($file['path'].$files->name) }}" alt="">--}}
            </div>
        </div>
    </div>
</div>
