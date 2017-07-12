{!! csrf_field() !!}
<div class="form-group {{ $errors->has('purchasedate') ? 'has-error' : ''}}">
    <label name="purchasedate" class="col-md-4 control-label">Fecha de Compra</label>
    <div class="col-md-6">
        {!! Form::date('purchasedate', null, ['class' => 'form-control']) !!}
        {!! $errors->first('purchasedate', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@if(count($suppliers)>0)
    <div class="form-group {{ $errors->has('suppliers') ? 'has-error' : ''}}">
        <label name="suppliers" class="col-md-4 control-label">Proveedor</label>
        <div class="col-md-6">
            <select name="supplier_id"  class="form-control" >
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id}}" {{ $purchasesbill->isf($supplier->id) }}>{{$supplier->name}} </option>
            @endforeach
            </select>
            {!! $errors->first('supplier_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
@endif
<input type="hidden" name="totalamount" value="0" class="form-control">
<input type="hidden" name="employee_id" value="{{ session('person_id') }}" class="form-control">
<input type="hidden" name="confirmed" value="false" class="form-control">
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
    </div>
</div>
