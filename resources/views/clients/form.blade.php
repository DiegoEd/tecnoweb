{!! csrf_field() !!}
@include('users.form')
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label name="name" class="col-md-4 control-label">Nombre</label>
    <div class="col-md-6">
        <input type="text" name="name" value="{{ $client->name }}" class="form-control" pattern="^[a-zA-Záéíóú ]+$">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('nit') ? 'has-error' : ''}}">
    <label name="nit" class="col-md-4 control-label">Nit</label>
    <div class="col-md-6">
        <input type="number"  name="nit" value="{{ $client->nit }}" class="form-control" pattern="^[0-9]+$">
        {!! $errors->first('nit', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('number') ? 'has-error' : ''}}">
    <label name="number" class="col-md-4 control-label">Numero</label>
    <div class="col-md-6">
        <input type="number"  name="number" value="{{ $client->number }}" class="form-control" pattern="^[0-9]+$">
        {!! $errors->first('number', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
    <label name="address" class="col-md-4 control-label">Direccion</label>
    <div class="col-md-6">
        <input type="text" name="address" value="{{ $client->address }}" class="form-control" pattern="^[a-zA-Z0-9áéíóú#°. ]+$">
        {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
