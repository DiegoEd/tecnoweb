{!! csrf_field() !!}
<div class="form-group {{ $errors->has('color') ? 'has-error' : ''}}">
    <label name="color" class="col-md-4 control-label">Color</label>
    <div class="col-md-6">
        <select name="color" class="form-control">
            <option>Rojo</option>
            <option>Azul</option>
            <option>Amarillo</option>
            <option>Verde</option>
            <option>Violeta</option>
        </select>
        {!! $errors->first('color', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('font') ? 'has-error' : ''}}">
    <label name="font" class="col-md-4 control-label">Tipo de Letra</label>
    <div class="col-md-6">
        <select name="font" class="form-control">
            <option>Arial</option>
            <option>New Times Roman</option>
        </select>
        {!! $errors->first('font', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('imagepath') ? 'has-error' : ''}}">
    <label name="imagepath" class="col-md-4 control-label">Imagen</label>
    <div class="col-md-6">
        <input type="radio" name="imagepath" value="imagen1" {{ $customizes->imagepathSelected("imagen1") }}>Imagen 1 
        <input type="radio" name="imagepath" value="imagen2" {{ $customizes->imagepathSelected("imagen2") }}>Imagen 2 
        {!! $errors->first('imagepath', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('imagepath') ? 'has-error' : ''}}">
    <label name="employee_id" class="col-md-4 control-label">ID del Empleado</label>
    <div class="col-md-6">
        <input type="text" name="employee_id" value="{{ $customizes->employee_id }}" class="form-control">
        {!! $errors->first('employee_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
    </div>
</div>
