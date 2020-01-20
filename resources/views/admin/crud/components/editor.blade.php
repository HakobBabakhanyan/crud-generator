<div class="col-lg-12">
    <div class="form-group mt-2">
        <div class="col-md-12 text-right">
            @include('admin.components.form.textarea',[
            'name'=>$name,
            'class'=>'ckeditor',
            'val'=>old($name)? old($name) : $item->$name
            ])
        </div>
    </div>
</div>
