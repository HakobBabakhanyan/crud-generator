<div class="input-group date col-6" data-provide="datepicker">
    <input   readonly type="text" class="form-control"  name="{{ $name }}" value="{{ old($name)? old($name) : $item->$name }}">
        <div class="input-group-addon d-flex justify-content-center align-items-center p-2 bg-gradient-dark text-white rounded-right">
            <i class="fa fa-calendar"></i>
        </div>

</div>
