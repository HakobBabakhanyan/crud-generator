<div class="col-lg-12">
    <div class="form-group mt-2">
        <label class="col-md-3 control-label">{{ $name }}</label>
        <input id="{{$name}}" name="{{$name}}" class="form-control @error($name) is-invalid @enderror " type="number" value="{{ old($name)? old($name) : $item->$name }}">
    </div>
</div>
