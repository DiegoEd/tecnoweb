{!! csrf_field() !!}

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label name="name" class="col-md-4 control-label">Nombre</label>
    <div class="col-md-6">
        <input type="text" name="name" value="{{ $product->name }}" class="form-control" pattern="^[a-zA-Záéíóú ]+$">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label name="price" class="col-md-4 control-label">Precio</label>
    <div class="col-md-6">
        <input type="number"  name="price" value="{{ $product->price }}" step="any" class="form-control" pattern="^[0-9.]+$"/>
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('stock') ? 'has-error' : ''}}">
    <label name="price" class="col-md-4 control-label">Stock</label>
    <div class="col-md-6">
        <input type="number"  name="stock" value="{{ $product->stock }}" class="form-control" pattern="^[0-9]+$"/>
        {!! $errors->first('stock', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@if(count($productcategories)>0)
    <div class="form-group {{ $errors->has('categories') ? 'has-error' : ''}}">
        <label name="categories" class="col-md-4 control-label">Categorias</label>
        <div class="col-md-6">
            <select name="productcategory_id"  class="form-control" >
            @foreach ($productcategories as $productcategory)
              <option value="{{ $productcategory->id}}" {{ $product->isf($productcategory->id) }}>{{$productcategory->name}} </option>
            @endforeach
            </select>
            {!! $errors->first('stock', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
@endif

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
    </div>
</div>