<div class="form-group {{ $errors->has('username') ? 'has-error' : ''}}">
    <label name="username" class="col-md-4 control-label">Nombre de Usuario</label>
    <div class="col-md-6">
        <input type="text" name="username" value="{{ $user->username }}" class="form-control" pattern="^[a-zA-Z0-9áéíóú]+$">
        {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    <label name="password" class="col-md-4 control-label">Contraseña</label>
    <div class="col-md-6">
        <input type="password" name="password" value="{{ $user->password }}" class="form-control" pattern="^[a-zA-Z0-9]+$">
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label name="email" class="col-md-4 control-label">Email</label>
    <div class="col-md-6">
        <input type="email" name="email" value="{{ $user->email }}" class="form-control" pattern="^[a-zA-Z0-9-_@.]+$">
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

