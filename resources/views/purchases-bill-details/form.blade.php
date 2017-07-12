{!! csrf_field() !!}
<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label name="price" class="col-md-4 control-label">Precio</label>
    <div class="col-md-6">
        <input type="number" name="price" id="price" value="{{ $purchasesbilldetail->price }}" class="form-control">
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    <label name="amount" class="col-md-4 control-label">Cantidad</label>
    <div class="col-md-6">
        <input type="number" name="amount" value="{{ $purchasesbilldetail->amount }}" class="form-control">
        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@if(count($products)>0)
    <div class="form-group {{ $errors->has('products') ? 'has-error' : ''}}">
        <label name="products" class="col-md-4 control-label">Productos</label>
        <div class="col-md-6">
            <select name="product_id"  class="form-control" id="select" onclick="myFunction()">
            @foreach ($products as $product)
              <option value="{{ $product->id}}" {{ $purchasesbilldetail->isf($product->id) }}>{{ $product->name }} </option>
              <option value="{{ $product->price }}" hidden>{{ $product->price }}</option>
            @endforeach
            </select>
            {!! $errors->first('stock', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
@endif
<input type="hidden" name="purchases_bill_id" value="{{ $purchasesbilldetail->purchases_bill_id }}">

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
    </div>
</div>
