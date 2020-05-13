@extends('layouts.layout')

@section('content')
<div class="page login-page"  >
   <div class="container " >
     
        <div class="form-outer text-center  align-items-center ">
          <div class="form-inner">
            <div class="logo text-uppercase"><img src="assets/img/logo_login.png" class="img-fluid" style="max-width: 100px;"></div>
            <p class="text-center  mt-3"><b>Tecnek Box Software</b></p>
            <form method="POST" class="text-left form-validate" action="{{ route('login') }}">
              @csrf
              <div class="form-group-material">
                <input id="login-username" type="email" name="email" required data-msg="Por favor ingrese su usuario" class="input-material">
                <label for="login-username" class="label-material">Usuario</label>
              </div>
              <div class="form-group-material">
                <input id="login-password" type="password" name="password" required data-msg="Por favor ingrese su contraseña" class="input-material">
                <label for="login-password" class="label-material">Contraseña</label>
              </div>
             
              <div class="form-group text-center"><button type="submit" class="btn btn-info">Ingresar</button>
                <!-- This should be submit button but I replaced it with <a> for demo purposes-->
              </div>
            </form><a href="#" class="forgot-pass">Forgot Password?</a><small>Do not have an account? </small><a href="register.html" class="signup">Signup</a>
          </div>
          <div class="copyrights text-center">
            <p>Desarrollado por <a href="#" class="external text-info">Tecnek Box</a>                        </p>
          </div>
        </div>
      </div>
   
</div>
@endsection