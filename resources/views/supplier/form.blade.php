{!! csrf_field() !!}
<div class="form-group {{ $errors->has('nombre') ? 'has-error' : ''}}">
    <label name="nombre" class="col-md-4 control-label">Nombre</label>
    <div class="col-md-6">
        <input type="text" name="nombre" value="{{ isset($supplier)?$supplier->nombre:'' }}" class="form-control">
        {!! $errors->first('nombre', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('correo') ? 'has-error' : ''}}">
    <label name="correo" class="col-md-4 control-label">Correo</label>
    <div class="col-md-6">
        <input type="email" name="correo" value="{{ isset($supplier)?$supplier->correo:'' }}" class="form-control">
        {!! $errors->first('correo', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('telefono') ? 'has-error' : ''}}">
    <label name="telefono" class="col-md-4 control-label">Telefono</label>
    <div class="col-md-6">
        <input type="text" name="telefono" value="{{ isset($supplier)?$supplier->telefono:'' }}" class="form-control">
        {!! $errors->first('telefono', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('direccion') ? 'has-error' : ''}}">
    <label name="nombre" class="col-md-4 control-label">Direccion</label>
    <div class="col-md-6">
        <input type="text" name="direccion" value="{{ isset($supplier)?$supplier->direccion:'' }}" class="form-control">
        {!! $errors->first('direccion', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
    </div>
</div>
