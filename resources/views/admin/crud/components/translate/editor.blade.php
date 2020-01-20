<div class="col-lg-12">
    @component('admin.components.nav',['items'=>$languages,'name'=>$name])
        @foreach($languages as $language)
            <div class="tab-pane fade {{ (!$loop->index)?'show active':null }}"
                 id="{{$language->slug.'-'.$name}}" role="tabpanel">
                <div class="form-group mt-2">
                    <label class="col-md-3 control-label">{{ $name }}</label>
                    <div class="col-md-12 text-right">
                        @include('admin.components.form.textarea',[
                        'name'=>$name.'['.$language->slug.']',
                        'multi_language'=>true,
                        'class'=>'ckeditor',
                        'val'=>isset($item)?$item->$name($language->slug):old($name.'.'.$language->slug)
                        ])
                    </div>
                </div>
            </div>

        @endforeach
    @endcomponent
</div>
