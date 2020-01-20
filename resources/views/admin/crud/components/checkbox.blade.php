<div class="col-lg-12">
    <div class="form-group mt-2">
        <label class="col-md-3 control-label">{{ $name }}</label>
        <div class="col-md-12 text-right">
            <div class="custom-control custom-checkbox">
                <input {{ old($name)?'checked':($item->$name?'checked':null) }} value="1" type="checkbox" name="{{ $name }}" class="custom-control-input" id="{{ $name }}">
                <label class="custom-control-label" for="{{ $name }}">{{ $name }}</label>
            </div>
        </div>
    </div>
</div>
