<div class="form-group">
    <label class="col-md-3 control-label"
           for="{{ $name }}"></label>
    <div class="col-md-12">
        <select placeholder="Select items" class="select2 w-100" @if(isset($info['multiple']) && $info['multiple']) multiple @endif name="{{ $name.((isset($info['multiple']) && $info['multiple'])?'[]':null) }}"
                id="{{ $name }}">
            <option disabled  value="">Select items</option>
            @if($info['custom'] && $info['custom']['items'] && is_array($info['custom']['items']))
                @foreach($info['custom']['items']  as $key=>$value)
                    <option value="{{ $key }}">
                        {{ $value }}
                    </option>
                @endforeach
            @endif
        </select>
    </div>
</div>
