{!! csrf_field() !!}
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label name="name" class="col-md-4 control-label">Nombre</label>
    <div class="col-md-6">
        <input type="text" name="name" value="{{ $employees->name }}" class="form-control">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('lastname') ? 'has-error' : ''}}">
    <label name="lastname" class="col-md-4 control-label">Apellido</label>
    <div class="col-md-6">
        <input type="text" name="lastname" value="{{ $employees->lastname }}" class="form-control">
        {!! $errors->first('lastname', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('sex') ? 'has-error' : ''}}">
    <label name="sex" class="col-md-4 control-label">Sexo</label>
    <div class="col-md-6">
        <select name="sex" value="{{ $employees->sex }}" class="form-control">
            <option value="Masculino" {{ $employees->maleSelected() }}>Masculino</option>
            <option value="Femenino" {{ $employees->femaleSelected() }}>Femenino</option>
        </select>
        {!! $errors->first('sex', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('age') ? 'has-error' : ''}}">
    <label name="age" class="col-md-4 control-label">Edad</label>
    <div class="col-md-6">
        <input type="number" name="age" value="{{ $employees->age }}" class="form-control">
        {!! $errors->first('age', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('career') ? 'has-error' : ''}}">
    <label name="career" class="col-md-4 control-label">Profesion</label>
    <div class="col-md-6">
        <input type="text" name="career" value="{{ $employees->career }}" class="form-control">
        {!! $errors->first('career', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
    </div>
</div>
