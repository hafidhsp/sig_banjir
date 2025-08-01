<!doctype html>
<html lang="en">
  <head>
  	<title>Login 08</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="{{asset ('css2/style.css')}}">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Login</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
				<br>
						<form action="/auth-login" method="POST" class="login-form">
							@csrf
		      		<div class="form-group">
		      			<input id="email" type="email" class="form-control rounded-left" placeholder="Email" name="email" value="{{ old('email')}}" required>
		      		</div>
	            <div class="form-group d-flex">
	              <input id="password" type="password" class="form-control rounded-left" placeholder="Password" name="password" required>
	            </div>
	            <div class="form-group d-md-flex">
								<div class="w-100 text-md-left">
									<a href="/">Kembali</a>
								</div>
								<div class="w-100 text-md-right">
									<a href="/register">Daftar Akun</a>
								</div>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="btn btn-primary rounded submit p-3 px-5">Masuk</button>
	            </div>
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

  <script src="{{asset ('assets/js/jquery.min.js')}}"></script>
  <script src="{{asset ('assets/js/popper.js')}}"></script>
  <script src="{{asset ('assets/js/bootstrap.min.js')}}"></script>
  <script src="{{asset ('assets/js/main.js')}}"></script>
	</body>
</html>
