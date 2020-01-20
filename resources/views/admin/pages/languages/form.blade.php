@extends('admin.layouts.app')

@section('content')

    <div class="container">
        @if($action == 'create')
            <form action="{{ route('admin.languages.'.$action) }}" method="post" enctype="multipart/form-data">
                @else
                    <form action="{{ route('admin.languages.'.$action,['language'=>$item->id]) }}" method="post"
                          enctype="multipart/form-data">
                        @method('put')
                        @endif
                        @csrf
                        <h3>Languages</h3>
                        <div class="text-right">
                           <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#settings">
                               <i class="fas fa-sliders-h"></i>
                           </button>

                        </div>
                        <div class="form-group">
                            <label for="name" class="col-lg-3 control-label">Name</label>
                            <div class="col-lg-12">
                                <input id="name" name="name" class="form-control @error('name') is-invalid @enderror "
                                       type="text"
                                       value="{{ isset($item)?$item->name:old('name') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="slug" class="col-lg-3 control-label">slug</label>
                            <div class="col-lg-12">
                                <input id="slug" name="slug" class="form-control @error('slug') is-invalid @enderror "
                                       type="text"
                                       value="{{isset($item)?$item->slug:old('slug') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <div class="col-lg-12">
                                    <input type="file" name="image" class="dropify"  data-default-file="{{ (isset($item))?asset($item->image):null }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-12 text-right">
                                <input type="submit" class="btn btn-primary" value="Save Changes">
                            </div>
                        </div>
                        @component('admin.components.modal',['modal'=>'settings','title'=>'settings'])
                            <div class="form-group">
                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    <input type="checkbox" name="static" {{ (isset($item) && $item->static)?'checked':null }}
                                    class="custom-control-input" id="static">
                                    <label class="custom-control-label" for="static">Static</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    <input type="checkbox" name="status" {{ (isset($item) && $item->status)?'checked':null }} class="custom-control-input" id="status">
                                    <label class="custom-control-label" for="status">Status</label>
                                </div>
                            </div>
                        @endcomponent
                    </form>
    </div>
    <hr>


@endsection
