{!! csrf_field() !!}
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label name="name" class="col-md-4 control-label">Nombre</label>
    <div class="col-md-6">
        <input type="text" name="name" value="{{ $accion->name }}" class="form-control">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('pageroute') ? 'has-error' : ''}}">
    <label name="pageroute" class="col-md-4 control-label">Ruta de pagina</label>
    <div class="col-md-6">
        <input type="text" name="pageroute" value="{{ $accion->pageroute }}" class="form-control">
        {!! $errors->first('pageroute', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<input type="hidden" name="module_id" value="{{$accion->module_id}}">
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
    </div>
</div>



