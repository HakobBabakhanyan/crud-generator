@extends('admin.layouts.app')

@section('content')

    <div class="container">
        @if($action == 'create')
            <form action="{{ route('admin.news.'.$action) }}" method="post" enctype="multipart/form-data">
                @else
                    <form action="{{ route('admin.news.'.$action,['news'=>$item->id]) }}" method="post"
                          enctype="multipart/form-data">
                        @method('put')
                        @endif
                        @csrf
                        <h3>News info</h3>
                        <div class="form-group">
                            <label for="name" class="col-lg-3 control-label">News Name</label>
                            <div class="col-lg-12">
                                @component('admin.components.nav',['items'=>$languages,'name'=>'name'])
                                    @foreach($languages as $language)
                                        <div class="tab-pane fade {{ (!$loop->index)?'show active':null }}"
                                             id="{{$language->slug.'-name'}}" role="tabpanel">
                                            <div class="form-group mt-2">
                                                <label class="col-md-3 control-label">Name</label>
                                                <div class="col-md-12 text-right">
                                                    @include('admin.components.form.input',[
                                                    'name'=>'name['.$language->slug.']',
                                                    'multi_language'=>true,
                                                    'val'=>isset($item)?$item->name($language->slug):old('name.'.$language->slug)
                                                    ])
                                                </div>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label class="col-md-3 control-label">Name</label>
                                                <div class="col-md-12 text-right">
                                                    @include('admin.components.form.textarea',[
                                                    'name'=>'description['.$language->slug.']',
                                                    'multi_language'=>true,
                                                    'class'=>'ckeditor',
                                                    'val'=>isset($item)?$item->description($language->slug):old('name.'.$language->slug)
                                                    ])
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                @endcomponent
                            </div>
                        </div>
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
