@extends('admin.layouts.app')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">News</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">News list</h6>
            </div>
            <div class="container-fluid text-right mt-2">
                <a href="{{ route('admin.news.create') }}" class="btn btn-outline-success">Crete</a>
            </div>
            <div class="table-responsive card-body">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th data-sortable="false">Status</th>
                        <th data-sortable="false" class="text-right">Action</th>
                    </tr>
                    </thead>
                    {{--                        <tfoot>--}}
                    {{--                        <tr>--}}
                    {{--                            <th>Name</th>--}}
                    {{--                            <th>Status</th>--}}
                    {{--                            <th>Action</th>--}}
                    {{--                        </tr>--}}
                    {{--                        </tfoot>--}}
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    {{ ($item->status)?'Active':'Cancel' }}
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end">

                                    <div class="text-right">
                                        <a href="{{ route('admin.news.update',['news'=>$item->id]) }}"
                                           class="text-success">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="text-right ml-2">
                                        <form method="post" data-delete=true
                                              action="{{ route('admin.news.delete',['news'=>$item->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                    class="text-danger delete-modal btn p-0 border-0 align-top">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
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
