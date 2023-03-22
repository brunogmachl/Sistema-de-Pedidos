<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lenny Doces & Salgados</title>
    <link href='css/style.css' rel='stylesheet'>
    <link href='css/bootstrap.min.css' rel='stylesheet'>
</head>
<body style="background-color: #FFE4E1;">
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5" >
                    <img src="/lenny/imagem/logo.png" class="img-fluid" alt="Sample image" width="100%" height="100%" style="border-radius: 290px;">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="POST" action="autenticacao.php">
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                            <p class="lead fw-normal mb-0 me-3"></p>
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="form3Example3" class="form-control form-control-lg" placeholder="Digite seu email" name="email"/>
                            <label class="form-label" for="form3Example3">Email</label>
                        </div>
                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input type="password" id="form3Example4" class="form-control form-control-lg" placeholder="Digite sua senha" name="senha" />
                            <label class="form-label" for="form3Example4">Senha</label>
                        </div>
                        <div class="text-center text-lg-start mt-0 pt-2">
                            <button type="submit" class="btn btn-secondary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class=" flex-column flex-md-row   py-4 px-4 px-xl-5 bg-secondary">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0 text-center">
                Copyright © 2022. All rights reserved.
            </div>
        </div>
    </section>
</body>

</html>