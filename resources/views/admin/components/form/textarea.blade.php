@if(isset($multi_language) && $multi_language)
<textarea id="{{$name}}" name="{{$name}}" class="form-control {{$class??null}} @error($name) is-invalid @enderror " >{{ isset($val)?$val:old($name) }}</textarea>
    @else
    <textarea id="{{$name}}" name="{{$name}}" class="form-control {{$class??null}}  @error($name) is-invalid @enderror " >{{ isset($item)?$item->{$name}:old($name) }}</textarea>
@endif
