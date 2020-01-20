@extends('admin.layouts.app')

@section('content')

    <div class="container">
        @if($action == 'store')
            <form action="{{ route('admin.'.$params['route'].'.'.$action) }}" method="post"
                  enctype="multipart/form-data">
                @else
                    <form action="{{ route('admin.'.$params['route'].'.'.$action,[$item->id]) }}"
                          method="post"
                          enctype="multipart/form-data">
                        @method('put')
                        @endif
                        @csrf
                        <h3> {{ $params['title'] }} </h3>
                            @foreach($params['column'] as $column=>$info)
                                <div class="form-group">
                                    @if($item && isset($info['custom']))
                                        @foreach($info['custom'] as $k=>$v)
                                            @if(isset($v[$item->$k]) && $custom = true && is_array($v[$item->$k]) && ( $info = array_merge($info,$v[$item->$k])) )
                                                <label for="name" class="col-lg-3 control-label">{{ $info['title'] }}</label>
                                                @if(isset($info['translate']) && $info['translate'])
                                                    @include('admin.crud.components.translate.'.$info['type'],['class'=>isset($info['class'])?$info['class']:null,'name'=>$column,'label'=>$info['title']])
                                                @else
                                                    @include('admin.crud.components.'.$info['type'],['name'=>$column,'class'=>isset($info['class'])?$info['class']:null,])
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                    @if(!isset($custom))
                                        <label for="name" class="col-lg-3 control-label">{{ $info['title'] }}</label>
                                        @if(isset($info['translate']) && $info['translate'])
                                          @include('admin.crud.components.translate.'.$info['type'],['class'=>isset($info['class'])?$info['class']:null,'name'=>$column,'label'=>$info['title']])
                                        @else
                                            @include('admin.crud.components.'.$info['type'],['name'=>$column,'class'=>isset($info['class'])?$info['class']:null,])
                                        @endif
                                    @else
                                        @php unset($custom) @endphp
                                    @endif
                                </div>
                            @endforeach

                        @if(isset($params['images']) && $params['images'])
                            @foreach($params['images'] as $name=>$image)
                                @if(isset($image['custom']) && $image['custom'])
                                    @foreach($image['custom'] as $k=>$v)
                                        @if(isset($v[$item->$k]))
                                            @php($image = $v[$item->$k])
                                        @endif
                                    @endforeach
                                @endif
                                @if($image)
                                    <div class="form-group">
                                        <div class="text-center">
                                            <div class="col-lg-12">
                                                <label class="text-left w-100 pb-2 font-weight-bold"
                                                       for="">{{ isset($image['title'])?$image['title']:null }}</label>
                                                <input type="file"
                                                       name="{{ $name.((isset($image['multiple']) && $image['multiple'])?'[]':null) }}"
                                                       class="dropify"
                                                       {{ (isset($image['multiple']) && $image['multiple'])?'multiple':null }}
                                                       data-default-file="">
                                            </div>
                                        </div>
                                    </div>
                                    @if(isset($item) && $item->$name)
                                        <div>
                                            <div class="container">
                                                <div class="row">
                                                    @if(isset($image['multiple']) && $image['multiple'])
                                                        @foreach($item->$name as $images)
                                                            @include('admin.crud.components.card.image')
                                                        @endforeach
                                                    @else
                                                        @include('admin.crud.components.card.image',['images'=>$item->$name])
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        @endif

                        @if(isset($params['custom_files']) && $params['custom_files'])
                            @foreach($params['custom_files'] as $key=>$custom_files)
                                @foreach($custom_files as $k=>$v)
                                    @if($item->$key == $k)
                                        @php($custom_param_files = false)
                                        @if($v)
                                            @foreach($v as $name=>$file)
                                                <div class="form-group">
                                                    <div class="text-center">
                                                        <div class="col-lg-12">
                                                            <label class="text-left w-100 pb-2 font-weight-bold"
                                                                   for="">{{ isset($file['title'])?$file['title']:null }}</label>
                                                            <input type="file"
                                                                   name="{{ $name.((isset($file['multiple']) && $file['multiple'])?'[]':null) }}"
                                                                   class="dropify"
                                                                   {{ (isset($file['multiple']) && $file['multiple'])?'multiple':null }}
                                                                   data-default-file="">
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(isset($item) && $item->$name)
                                                    <div>
                                                        <div class="container">
                                                            <div class="row">
                                                                @if(isset($file['multiple']) && $file['multiple'])
                                                                    @foreach($item->$name as $files)
                                                                        @include('admin.crud.components.card.file')
                                                                    @endforeach
                                                                @else
                                                                    @include('admin.crud.components.card.file',['files'=>$item->$name])
                                                                @endif
                                                            </div>
                                                        </div>

                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                        @endif

                        @if(!isset($custom_param_files) &&  isset($params['files']) && $params['files'])
                            @foreach($params['files'] as $name=>$file)
                                <div class="form-group">
                                    <div class="text-center">
                                        <div class="col-lg-12">
                                            <label class="text-left w-100 pb-2 font-weight-bold"
                                                   for="">{{ isset($file['title'])?$file['title']:null }}</label>
                                            <input type="file"
                                                   name="{{ $name.((isset($file['multiple']) && $file['multiple'])?'[]':null) }}"
                                                   class="dropify"
                                                   {{ (isset($file['multiple']) && $file['multiple'])?'multiple':null }}
                                                   data-default-file="">
                                        </div>
                                    </div>
                                </div>
                                @if(isset($item) && $item->$name)
                                    <div>
                                        <div class="container">
                                            <div class="row">
                                                @if(isset($file['multiple']) && $file['multiple'])
                                                    @foreach($item->$name as $files)
                                                        @include('admin.crud.components.card.file')
                                                    @endforeach
                                                @else
                                                    @include('admin.crud.components.card.file',['files'=>$item->$name])
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                @endif
                            @endforeach
                        @endif



                        @if(isset($params['relationships']) && $params['relationships'])
                            @foreach($params['relationships'] as $name=>$relationships)
                                <div class="form-group">
                                    <label class="col-md-3 control-label"
                                           for="{{ $relationships['foreignKey'] }}"></label>
                                    <div class="col-md-12">
                                        <select class="select2 w-100" name="{{ $relationships['foreignKey'] }}"
                                                id="{{ $relationships['foreignKey'] }}">
                                            <option value="" disabled selected></option>
                                            @foreach($item->getRelationships($name,$item)  as $reference)
                                                <option
                                                    @if(($relationship=$item->getRelationship($name,$item) )->isNotEmpty() && $relationship->where('id',$reference->id)->isNotEmpty()) selected
                                                    @endif
                                                    value="{{ $reference->id }}">
                                                    {{ $reference->{$relationships['show']} }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-12 text-right">
                                <input type="submit" class="btn btn-primary" value="Save Changes">
                            </div>
                        </div>
                    </form>
    </div>
    <hr>

@endsection



{{--@extends('admin.layouts.app')--}}

{{--@section('content')--}}

{{--    <div class="container">--}}
{{--        @if($action == 'create')--}}
{{--            <form action="{{ route('admin.crud.'.$action,['name'=>$route]) }}" method="post" enctype="multipart/form-data">--}}
{{--                @else--}}
{{--                    <form action="{{ route('admin.crud.'.$action,['name'=>$route,'item'=>$model->id]) }}"--}}
{{--                          method="post"--}}
{{--                          enctype="multipart/form-data">--}}
{{--                        @method('put')--}}
{{--                        @endif--}}
{{--                        @csrf--}}
{{--                        <h3>crud info</h3>--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="name" class="col-lg-3 control-label">crud name</label>--}}
{{--                            @foreach($model::$info['column'] as $column)--}}
{{--                                @if(in_array($column,$model::$info['translate']))--}}
{{--                                    @include('admin.crud.components.languages.'.$model::$info['type'][$column],['name'=>$column])--}}
{{--                                @else--}}
{{--                                    @include('admin.crud.components.'.$model::$info['type'][$column],['name'=>$column])--}}
{{--                                @endif--}}
{{--                            @endforeach--}}
{{--                        </div>--}}

{{--                        @if($model->img)--}}
{{--                            <div class="form-group">--}}
{{--                                <div class="text-center">--}}
{{--                                    <div class="col-lg-12">--}}
{{--                                        <input type="file" name="image{{ ($model::$multipleImage)?'[]':null }}" class="dropify" {{ ($model::$multipleImage)?'multiple':null }}--}}
{{--                                               data-default-file="{{ ($model->image)?asset($model->getImage()):null }}">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <div class="container">--}}
{{--                                    <div class="row">--}}
{{--                                        @if($model::$multipleImage)--}}
{{--                                            @foreach($model->images as $images)--}}
{{--                                                <div class="col-3">--}}
{{--                                                    <!-- Dropdown Card Example -->--}}
{{--                                                    <div class="card shadow mb-4">--}}
{{--                                                        <!-- Card Header - Dropdown -->--}}
{{--                                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">--}}
{{--                                                            <h6 class="m-0 font-weight-bold text-primary">{{ $images->type }}</h6>--}}
{{--                                                            <div class="dropdown no-arrow">--}}
{{--                                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>--}}
{{--                                                                </a>--}}
{{--                                                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">--}}
{{--                                                                    <div class="dropdown-header">Image Setting:</div>--}}
{{--                                                                    <a class="dropdown-item" href="{{ route('admin.image.type',[$route,$images->id,1]) }}">to profile</a>--}}
{{--                                                                    <a class="dropdown-item" href="#">alt</a>--}}
{{--                                                                    <div class="dropdown-divider"></div>--}}
{{--                                                                    <a class="dropdown-item" href="{{ route('admin.image.delete',[$route,$images->id]) }}">remove</a>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <!-- Card Body -->--}}
{{--                                                        <div style="height: 300px" class="card-body d-flex flex-column">--}}
{{--                                                            <div>--}}
{{--                                                                <img class="img-fluid"  style="max-height: 250px" src="{{ asset($model->getImagePath($images->name)) }}" alt="">--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            @endforeach--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                        @endif--}}

{{--                        @foreach($model->references as $key=>$references)--}}
{{--                            <div class="form-group">--}}
{{--                                <label class="col-md-3 control-label" for="{{ $key }}"></label>--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <select class="select2 w-100" name="{{ $key }}" id="{{ $key }}">--}}
{{--                                        <option value="" disabled selected></option>--}}
{{--                                        @foreach($references  as $reference)--}}
{{--                                            <option--}}
{{--                                                @if(isset($model->$key) && $model->$key->where('id',$reference->id)->isNotEmpty()) selected--}}
{{--                                                @endif value="{{ $reference->id }}">--}}
{{--                                                {{ $reference->name }}--}}
{{--                                            </option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                        @foreach($model->references_many as $key=>$references)--}}

{{--                            <div class="form-group">--}}
{{--                                <label class="col-md-3 control-label" for="{{ $key }}"></label>--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <select multiple class="select2 w-100" name="{{ $key }}[]" id="{{ $key }}">--}}
{{--                                        @foreach($references  as $reference)--}}
{{--                                            <option--}}
{{--                                                @if(isset($model->relation_many[$key]) && $model->relation_many[$key]->where('id',$reference->id)->isNotEmpty()) selected--}}
{{--                                                @endif value="{{ $reference->id }}">--}}
{{--                                                {{ $reference->name }}--}}
{{--                                            </option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                        <div class="form-group">--}}
{{--                            <label class="col-md-3 control-label"></label>--}}
{{--                            <div class="col-md-12 text-right">--}}
{{--                                <input type="submit" class="btn btn-primary" value="Save Changes">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--    </div>--}}
{{--    <hr>--}}

{{--@endsection--}}
