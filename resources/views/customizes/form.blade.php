{!! csrf_field() !!}
<div class="form-group {{ $errors->has('color') ? 'has-error' : ''}}">
    <label name="color" class="col-md-4 control-label">Color</label>
    <div class="col-md-6">
        <input type="text" name="color" value="{{ $customizes->color }}" class="form-control">
        {!! $errors->first('color', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('font') ? 'has-error' : ''}}">
    <label name="font" class="col-md-4 control-label">Tipo de Letra</label>
    <div class="col-md-6">
        <input type="text" name="font" value="{{ $customizes->font }}" class="form-control">
        {!! $errors->first('font', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('imagepath') ? 'has-error' : ''}}">
    <label name="imagepath" class="col-md-4 control-label">Imagen</label>
    <div class="col-md-6">
        <input type="text" name="imagepath" value="{{ $customizes->imagepath }}" class="form-control">
        {!! $errors->first('imagepath', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
    </div>
</div>
