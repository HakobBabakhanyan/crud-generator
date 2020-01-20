<div class="col-lg-12">
    <div class="form-group mt-2">
        <label class="col-md-3 control-label">{{ $name }}</label>
        <div class="col-md-12 text-right">
            @include('admin.components.form.textarea',[
            'name'=>$name,
            'multi_language'=>true,
            'val'=>old($name)? old($name) : $item->$name
            ])
        </div>
    </div>
</div>
