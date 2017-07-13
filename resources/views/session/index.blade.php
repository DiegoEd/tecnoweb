@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-offset-2 col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading">Login</div>
				<div class="panel-body">
					@if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                    @endif
					<form method="POST" action="{{ url('/session') }}" class="form-horizontal">
						{!! csrf_field() !!}
						<div class="form-group">
						    <label name="name" class="col-md-4 control-label">Email</label>
						    <div class="col-md-6">
						        <input type="text" name="email" class="form-control" pattern="^[a-zA-Z0-9@._-]+$">
						    </div>
						</div>
						<div class="form-group">
						     <label name="name" class="col-md-4 control-label">Password</label>
						    <div class="col-md-6">
						        <input type="password" name="password" class="form-control" pattern="^[a-zA-Z0-9]+$">
						    </div>
						</div>
						<div class="form-group">
						    <div class="form-group">
							    <div class="col-md-offset-4 col-md-4">
							        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
							    </div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection