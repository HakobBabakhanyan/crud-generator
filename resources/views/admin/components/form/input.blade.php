@if(isset($multi_language) && $multi_language)
<input id="{{$name}}" name="{{$name}}" class="form-control @error($name) is-invalid @enderror " type="text" value="{{ isset($val)?$val:old($name) }}">
    @else
    <input id="{{$name}}" name="{{$name}}" class="form-control @error($name) is-invalid @enderror " type="text" value="{{ isset($item)?$item->{$name}:old($name) }}">
@endif
