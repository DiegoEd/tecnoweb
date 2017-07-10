@if(count($modules)>0)
	<div class="form-group">
		<label name="check" class="col-md-4 control-label">Modulos</label>
	    <div class="col-md-4">
	    	@foreach ($modules as $module)
	    		<br/>
	    		<label name="{{$module->name}}">{{$module->name}}</label>
	    		<br/>
              	@foreach ($module->accions as $accion)
             	       <input type="checkbox" name="accions[]" id="{{$accion->id}}" value="{{$accion->id}}" {{$role->inrole($accion->id)}} ><label for="{{$accion->id}}">{{$accion->name}}</label>
             	       <br/>
            	@endforeach
            @endforeach

	    </div>
	</div>
@endif