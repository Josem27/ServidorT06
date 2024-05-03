<!DOCTYPE html>
<html lang="es">
<head>
    @include('header')
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Login</h2>
                <form method="post" action="/login">
                    @csrf
                <div class="form-group">
                        <label for="Nick">Usuario:</label>
                        <input type="text" id="txtusuario" name="txtusuario" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="PASSWORD">Contraseña:</label>
                        <input type="password" id="pass" name="pass" class="form-control" required>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary btn-block">Entrar</button>
                </form>

                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger mt-3" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php } ?>

                <a href="{{ route('registro') }}" class="btn btn-secondary btn-block mt-3">Registrarse</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
