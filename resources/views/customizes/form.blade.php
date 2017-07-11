{!! csrf_field() !!}
<div class="form-group {{ $errors->has('color') ? 'has-error' : ''}}">
    <label name="theme" class="col-md-4 control-label">Tema</label>
    <div class="col-md-6">
        <select name="theme" class="form-control">
            <option {{ $customizes->themeSelected("Rojo") }}>Rojo</option>
            <option {{ $customizes->themeSelected("Azul") }}>Azul</option>
            <option {{ $customizes->themeSelected("Amarillo") }}>Amarillo</option>
            <option {{ $customizes->themeSelected("Verde") }}>Verde</option>
            <option {{ $customizes->themeSelected("Violeta") }}>Violeta</option>
        </select>
        {!! $errors->first('color', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('imagepath') ? 'has-error' : ''}}">
    <label name="imagepath" class="col-md-4 control-label">Imagen</label>
    <div class="col-md-6">
        <input type="file" name="imagepath" class="form-control"> 
        {!! $errors->first('imagepath', '<p class="help-block">:message</p>') !!}
        <input type="hidden" name="filename" value="{{ $customizes->imagepath }}">
    </div>
</div>
<input type="hidden" name="user_id" value="{{ session('id') }}" class="form-control">
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
    </div>
</div>
