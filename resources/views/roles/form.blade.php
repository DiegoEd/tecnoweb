{!! csrf_field() !!}
<div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
    <label name="name" class="col-md-4 control-label">Nombre</label>
    <div class="col-md-6">
        <input type="text" name="role" value="{{ $role->role }}" class="form-control" pattern="^[a-zA-Záéíóú]+$">
        {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label name="description" class="col-md-4 control-label">Descripcion</label>
    <div class="col-md-6">
        <input type="text" name="description" value="{{ $role->description }}" class="form-control" pattern="^[a-zA-Záéíóú., ]+$">
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

        @include('roles.accionchecking')

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
    </div>
</div>
