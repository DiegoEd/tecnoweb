{!! csrf_field() !!}
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label name="name" class="col-md-4 control-label">Nombre</label>
    <div class="col-md-6">
        <input type="text" name="name" value="{{ $suppliers->name }}" class="form-control" pattern="^[a-zA-Záéíóú ]+$">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label name="email" class="col-md-4 control-label">Correo</label>
    <div class="col-md-6">
        <input type="email" name="email" value="{{ $suppliers->email }}" class="form-control" pattern="^[a-zA-Z0-9áéíóú@._-]+$">
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('telephone') ? 'has-error' : ''}}">
    <label name="telephone" class="col-md-4 control-label">Telefono</label>
    <div class="col-md-6">
        <input type="number" name="telephone" value="{{ $suppliers->telephone }}" class="form-control" pattern="^[0-9]+$">
        {!! $errors->first('telephone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label name="address" class="col-md-4 control-label">Direccion</label>
    <div class="col-md-6">
        <input type="text" name="address" value="{{ $suppliers->address }}" class="form-control" pattern="^[a-zA-Z0-9áéíóú#°. ]+$">
        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
    </div>
</div>
