<div class="form-group {{ $errors->has('purchasedate') ? 'has-error' : ''}}">
    {!! Form::label('purchasedate', 'Purchasedate', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date('purchasedate', null, ['class' => 'form-control']) !!}
        {!! $errors->first('purchasedate', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('totalamount') ? 'has-error' : ''}}">
    {!! Form::label('totalamount', 'Totalamount', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('totalamount', null, ['class' => 'form-control']) !!}
        {!! $errors->first('totalamount', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
