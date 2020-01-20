@extends('admin.layouts.app')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{ $params['title'] }}</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $params['title'] }} list</h6>
            </div>
            <div class="container-fluid text-right mt-2">
                <a href="{{ route('admin.'.$params['route'].'.create') }}" class="btn btn-outline-success">Crete</a>
            </div>
            <div class="table-responsive card-body">
                <table class="table table-bordered" @if(isset($params['sortable']) && $params['sortable'])
                data-order="false"
                       data-paginate="false"
                       data-searching="false"
                       @endif  id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        @foreach($params['list'] as $name)
                            <th>{{ $name }}</th>
                        @endforeach
                        <th data-sortable="false" class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody @if(isset($params['sortable']) && $params['sortable'])
                           data-action="{{ route('admin.'.$params['route'].'.sortable') }}"
                           class="table-sortable" id="sortable"
                        @endif
                    >
                    @foreach($items as $item)
                        <tr data-id="{{ $item->id }}">

                            @foreach($params['list'] as $name)
                                <th>{{ $item->$name }}</th>
                            @endforeach
                            <td>
                                <div class="d-flex justify-content-end">
                                    @if(isset($params['childes']) && $params['childes'])
                                        @foreach($params['childes'] as $child=>$key)
                                            @if($child = config('custom-config.crud.'.$child))
                                                <div class="text-right mr-2">
                                                    <a href="{{ route('admin.'.$child['route'].'.index',[$key=>$item->id]) }}"
                                                       class="text-success">
                                                        <i class="fas fa-child"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif

                                    <div class="text-right">
                                        <a href="{{ route('admin.'.$params['route'].'.edit',[$item->id]) }}"
                                           class="text-success">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                        @php($delete = true)
                                    @if(isset($params['custom_column']) && $params['custom_column'])
                                        @foreach($params['custom_column'] as $key=>$value)
                                            @if(isset($value[$item->$key]))
                                                @php($delete = false)
                                                @break
                                            @endif
                                        @endforeach
                                    @endif
                                    @if($delete)
                                        <div class="text-right ml-2">
                                            <form method="post" data-delete=true
                                                  action="{{ route('admin.'.$params['route'].'.destroy',[$item->id]) }}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit"
                                                        class="text-danger delete-modal btn p-0 border-0 align-top">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

@endsection
















{{--@extends('admin.layouts.app')--}}

{{--@section('content')--}}

{{--    <!-- Begin Page Content -->--}}
{{--    <div class="container-fluid">--}}

{{--        <!-- Page Heading -->--}}
{{--        <h1 class="h3 mb-2 text-gray-800">News</h1>--}}

{{--        <!-- DataTales Example -->--}}
{{--        <div class="card shadow mb-4">--}}
{{--            <div class="card-header py-3">--}}
{{--                <h6 class="m-0 font-weight-bold text-primary">News list</h6>--}}
{{--            </div>--}}
{{--            <div class="container-fluid text-right mt-2">--}}
{{--                <a href="{{ route('admin.crud.create',[$route]) }}" class="btn btn-outline-success">Crete</a>--}}
{{--            </div>--}}
{{--            <div class="table-responsive card-body">--}}
{{--                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th>Name</th>--}}
{{--                        <th data-sortable="false">Status</th>--}}
{{--                        <th data-sortable="false" class="text-right">Action</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    --}}{{--                        <tfoot>--}}
{{--                    --}}{{--                        <tr>--}}
{{--                    --}}{{--                            <th>Name</th>--}}
{{--                    --}}{{--                            <th>Status</th>--}}
{{--                    --}}{{--                            <th>Action</th>--}}
{{--                    --}}{{--                        </tr>--}}
{{--                    --}}{{--                        </tfoot>--}}
{{--                    <tbody>--}}
{{--                    @foreach($items as $item)--}}
{{--                        <tr>--}}
{{--                            <td>{{ $item->name }}</td>--}}
{{--                            <td>--}}
{{--                                <div class="d-flex align-items-center">--}}
{{--                                    {{ ($item->status)?'Active':'Cancel' }}--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <div class="d-flex justify-content-end">--}}

{{--                                    <div class="text-right">--}}
{{--                                        <a href="{{ route('admin.crud.update',['name'=>$route,'item'=>$item->id]) }}"--}}
{{--                                           class="text-success">--}}
{{--                                            <i class="fas fa-edit"></i>--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                    <div class="text-right ml-2">--}}
{{--                                        <form method="post" data-delete=true--}}
{{--                                              action="{{ route('admin.crud.delete',['name'=>$route,'item'=>$item->id]) }}">--}}
{{--                                            @csrf--}}
{{--                                            @method('delete')--}}
{{--                                            <button type="submit"--}}
{{--                                                    class="text-danger delete-modal btn p-0 border-0 align-top">--}}
{{--                                                <i class="fas fa-trash"></i>--}}
{{--                                            </button>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}

{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}
{{--    <!-- /.container-fluid -->--}}

{{--@endsection--}}
