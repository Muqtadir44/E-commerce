@extends('layouts.app')
@section('page-title')
	Admin-Login
@endsection
@section('content')
	<body class="hold-transition login-page">
		<div class="login-box">
			<!-- /.login-logo -->
			@include('admin.message')
			<div class="card card-outline card-primary">
			  	<div class="card-header text-center">
					<a href="#" class="h3">Login</a>
			  	</div>
			  	<div class="card-body">
					<p class="login-box-msg">Admin Login Panel</p>
					<form action="{{route('admin.authenticate')}}" method="post">
                        @csrf
				  		<div class="input-group mb-3">
							<input type="email" name="email"  id="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" placeholder="Email">
							<div class="input-group-append">
					  			<div class="input-group-text text-primary">
									<span class="fas fa-envelope"></span>
					  			</div>
							</div>
				  		</div>
				  		<div class="input-group mb-3">
							<input type="password" name="password" id="password" class="form-control @error('email') is-invalid @enderror" placeholder="Password">
							<div class="input-group-append">
					  			<div class="input-group-text">
									<span class="fas fa-lock text-primary"></span>
					  			</div>
							</div>
				  		</div>
				  		<div class="row">
							<!-- <div class="col-8">
					  			<div class="icheck-primary">
									<input type="checkbox" id="remember">
									<label for="remember">
						  				Remember Me
									</label>
					  			</div>
							</div> -->
							<!-- /.col -->
							<div class="col">
					  			<button type="submit" class="btn btn-primary btn-block">Login</button>
							</div>
							<!-- /.col -->
				  		</div>
					</form>
		  			<p class="mb-1 mt-3">
				  		<a href="forgot-password.html">forgot password ?</a>
					</p>					
			  	</div>
			  	<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
		<!-- ./wrapper -->
		<!-- jQuery -->
        <script src="{{asset('admin-assets/plugins/jquery/jquery.min.js')}}"></script>
		{{-- <script src="plugins/jquery/jquery.min.js"></script> --}}
		<!-- Bootstrap 4 -->
        <script src="{{asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
		{{-- <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
		<!-- AdminLTE App -->
        <script src="{{asset('admin-assets/js/adminlte.min.js')}}"></script>
		{{-- <script src="js/adminlte.min.js"></script> --}}
		<!-- AdminLTE for demo purposes -->
        <script src="{{asset('admin-assets/js/demo.js')}}"></script>
		{{-- <script src="js/demo.js"></script> --}}
	</body>
@endsection