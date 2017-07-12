{!! csrf_field() !!}
<div class="form-group {{ $errors->has('salesdate') ? 'has-error' : ''}}">
    <label name="salesdate" class="col-md-4 control-label">Fecha de Venta</label>
    <div class="col-md-6">
        <input type="date" name="salesdate" value="{{ $salesbill->salesdate }}" class="form-control">
        {!! $errors->first('salesdate', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@if(count($clients)>0)
    <div class="form-group {{ $errors->has('clients') ? 'has-error' : ''}}">
        <label name="clients" class="col-md-4 control-label">Cliente</label>
        <div class="col-md-6">
            <select name="client_id"  class="form-control" >
            @foreach ($clients as $client)
                <option value="{{ $client->id}}" {{ $salesbill->isf($client->id) }}>{{$client->name}} </option>
            @endforeach
            </select>
            {!! $errors->first('client_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
@endif
<input type="hidden" name="totalamount" value="0" class="form-control">
<input type="hidden" name="employee_id" value="{{ session('person_id') }}" class="form-control">

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
    </div>
</div>
