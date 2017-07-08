{!! csrf_field() !!}
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label name="name" class="col-md-4 control-label">Nombre</label>
    <div class="col-md-6">
        <input type="text" name="name" value="{{ isset($supplier)?$supplier->name:'' }}" class="form-control">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label name="email" class="col-md-4 control-label">Correo</label>
    <div class="col-md-6">
        <input type="email" name="email" value="{{ isset($supplier)?$supplier->email:'' }}" class="form-control">
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('telephone') ? 'has-error' : ''}}">
    <label name="telephone" class="col-md-4 control-label">Telefono</label>
    <div class="col-md-6">
        <input type="text" name="telephone" value="{{ isset($supplier)?$supplier->telephone:'' }}" class="form-control">
        {!! $errors->first('telephone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label name="address" class="col-md-4 control-label">Direccion</label>
    <div class="col-md-6">
        <input type="text" name="address" value="{{ isset($supplier)?$supplier->address:'' }}" class="form-control">
        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
    </div>
</div>
