{!! csrf_field() !!}
<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label name="price" class="col-md-4 control-label">Precio</label>
    <div class="col-md-6">
        <input type="number" name="price" id="price" value="{{ $salebilldetail->price }}"  step="any" class="form-control" pattern="^[0-9.]+$" readonly="readonly">
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    <label name="amount" class="col-md-4 control-label">Cantidad</label>
    <div class="col-md-6">
        <input type="number" name="amount" value="{{ $salebilldetail->amount }}" class="form-control" pattern="^[0-9]+$">
        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@if(count($products)>0)
    <div class="form-group {{ $errors->has('products') ? 'has-error' : ''}}">
        <label name="products" class="col-md-4 control-label">Productos</label>
        <div class="col-md-6">
            <select name="product_id"  class="form-control" id="select" onclick="myFunction()">
            @foreach ($products as $product)
              <option value="{{ $product->id}}" {{ $salebilldetail->isf($product->id) }}>{{ $product->name }} </option>
              <option value="{{ $product->price }}" hidden>{{ $product->price }}</option>
            @endforeach
            </select>
            {!! $errors->first('stock', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
@endif
<input type="hidden" name="sales_bill_id" value="{{ $salebilldetail->sales_bill_id }}">

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
    </div>
</div>