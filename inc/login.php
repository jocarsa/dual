<?php
// LOGIN
if (!isset($_SESSION['user'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['usuario'], $_POST['contrasena'])) {
         // Hardcoded credentials: usuario: admin, contrasena: admin
         if($_POST['usuario'] == 'admin' && $_POST['contrasena'] == 'admin') {
             $_SESSION['user'] = 'admin';
             header("Location: " . $_SERVER['PHP_SELF']);
             exit;
         } else {
             $error = "Credenciales inválidas";
         }
    }
    // Display login form (using the provided login template)
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Login</title>
        <style>
        @import url('https://static.jocarsa.com/fuentes/ubuntu-font-family-0.83/ubuntu.css');

            body,html{
                padding:0;
                margin:0;
                font-family: Ubuntu,sans-serif;
                height:100%;
            }
            body{
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                background: rgb(240,240,240);
            }
            form{
                width:200px;
                height:400px;
                border:1px solid lightgrey;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                border-radius:5px;
                box-shadow:0px 4px 8px rgba(0,0,0,0.3);
                background: white;
                padding:30px;
                font-size:11px;
            }
            form img{
                width:80%;
            }
            form input[type=text],
            form input[type=password],
            form input[type=submit]{
                box-sizing: border-box;
                padding:10px;
                border:1px solid lightgrey;
                border-radius:5px;
                width:100%;
                margin:10px;
            }
            form label{
                text-align:left;
            }
            form input[type=text],
            form input[type=password]{
                box-shadow:0px 4px 8px rgba(0,0,0,0.3) inset;
            }
            form input[type=submit]{
                background:#2980b9;
                box-shadow:
                0 1px #2980b9,
                0 2px #2471a3,
                0 3px #1f618d,
                0 4px #1a5276,
                0 5px #154360,
                0 8px 10px rgba(0,0,0,0.6);
            }
            form div{
                display: flex;
                justify-content: center;
                align-items: center;
            }
        </style>
    </head>
    <body>
        <form method="post" action="">
            <img src="https://static.jocarsa.com/logos/grey.png" alt="Logo">
            <label>Usuario:</label>
            <input type="text" name="usuario" required>
            <label>Contraseña:</label>
            <input type="password" name="contrasena" required>
            <div>
                <input type="checkbox" name="recuerdame">Recuérdame
            </div>
            <input type="submit" value="Login">
            <?php if(isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
        </form>
    </body>
    </html>
    <?php
    exit;
}
?>
