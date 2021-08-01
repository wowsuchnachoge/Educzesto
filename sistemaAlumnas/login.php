<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <link href="css/login.css" rel="stylesheet" type="text/css">
  
  <title>Educzesto</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>
<body>

  <nav class="navbar navbar-warning bg-warning navbar-expand-md">
    <a class="navbar-brand" href="index.php"></a>
  </nav>

  <div class="container">
    <br>
    <div class="row vc">
      <div class="col-md-3"></div>
      <div class="col-md-6 card">
        <div class="text-center">          
          <a href="index.php"> <img class="img-fluid" src="css/img/logo.png" alt="">
          </a>
        </div>
        <h1 class="text-center">Login</h1>
    
        <br>
        
        <form action="" method="POST" id="loginForm">
          <div class="form-group">
            <label for="emailInput">Email</label>
            <input id="emailInput" class="form-control" type="text" name="email" placeholder="Email">
          </div>
          <div class="form-group">
            <label for="passwordInput">Password</label>
            <input id="passwordInput" class="form-control" type="password" name="password" placeholder="Password">
          </div>

          <input type="hidden" name="login">

          <p class="text-right"><small class="text-muted text-right">New user? <a href="#" onClick="showRegistration()">Create an account</a></small></p>
          <input class="btn btn-primary btn-block" type="submit" value="Login">
        </form>

        <form id="registrationForm" action="" class="needs-validation" method="POST" hidden novalidate>
          <div class="form-group">
            <label for="nombre">First name</label>
            <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Name" required>
            <div class="invalid-feedback">Field required</div>
          </div>
          <div class="form-group">
            <label for="ap_paterno">Last name</label>
            <input class="form-control" type="text" name="ap_paterno" placeholder="Last name" required>
            <div class="invalid-feedback">Field required</div>
          </div>
          <div class="form-group">
            <label for="ap_materno">Middle name</label>
            <input class="form-control" type="text" name="ap_materno" placeholder="Middle name" required>
            <div class="invalid-feedback">Field required</div>
          </div>
          <div class="form-group">
            <label for="">Address</label>
            <input class="form-control" type="text" name="direccion" placeholder="Address" required>
            <div class="invalid-feedback">Field required</div>
          </div>
          <div class="form-group">
            <label for="">Cellphone</label>
            <input class="form-control" type="text" id="cellphone" name="telefono" placeholder="Cellphone" required>
            <small id="cellphoneIndicator" class="form-text"></small>
            <div class="invalid-feedback">Field required</div>
          </div>
          <div class="form-group">
            <label for="">Sex</label>
            <!-- TODO: automatizar con php -->
            <select id="" class="form-control" name="genero">
              <option value="u">Unspecified</option>
              <option value="f">Female</option>
              <option value="m">Male</option>
            </select>
          </div>
          <div class="form-group">
            <label for="">Email</label>
            <input class="form-control" type="email" id="reg_email" name="email" placeholder="Email" required>
            <small id="emailIndicator" class="form-text"></small>
            <div class="invalid-feedback">Field required</div>
          </div>
          <div class="form-group">
            <label for="">Password</label>
            <input class="form-control" id="reg_pass1" type="password" name="password1" placeholder="Password" required>
            <div class="invalid-feedback">Field required</div>
          </div>
          <div class="form-group">
            <label for="">Repeat password</label>
            <input class="form-control" id="reg_pass2" type="password" name="password2" placeholder="Repeat password" required>
            <small id="passwordIndicator" class="form-text"></small>
            <div class="invalid-feedback">Field required</div>
          </div>

          <input type="hidden" name="register">

          <p class="text-right"><small class="text-muted">Already have an account? <a href="#" onClick="showLogin()">Login</a></small></p>
          <input class="btn btn-primary btn-block" id="register_btn" type="submit" value="Register">
        </form>

      </div>
      <div class="col-md-3"></div>
    </div>
  </div>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="js/login.js"></script>
</body>
</html>