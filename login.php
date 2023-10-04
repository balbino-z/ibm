<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Login - Dev Muscles</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="/ibm/style.css">
</head>
<body>
<div id="stars"></div>
<div id="stars2"></div>
<div id="stars3"></div>
<div class="section">
  <div class="container">
    <div class="row full-height justify-content-center">
      <div class="col-12 text-center align-self-center py-5">
        <div class="section pb-5 pt-5 pt-sm-2 text-center">
          <h6 class="mb-0 pb-3"><span>Faça seu Login aqui</span></h6>
          <div class="card-3d-wrap mx-auto">
            <div class="card-3d-wrapper">
              <div class="card-front">
                <div class="center-wrap">
                  <div class="section text-center">
                    <h4 class="mb-4 pb-3">Login</h4>
                    <form action="processar_login.php" method="POST">
                      <div class="form-group">
                          <input type="text" class="form-style" name="username" placeholder="Nome de Usuário">
                          <i class="input-icon uil uil-user"></i>
                      </div>	
                      <div class="form-group mt-2">
                          <input type="password" class="form-style" name="password" placeholder="Senha">
                          <i class="input-icon uil uil-lock-alt"></i>
                      </div>
                      <button type="submit" class="btn mt-4">Login</button>
                  </form>                  
                    <p class="mb-0 mt-4 text-center"><a href="esqueceu_senha.php" class="link">Esqueceu sua senha?</a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
