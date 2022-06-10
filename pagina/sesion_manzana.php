<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <script type="text/javascript" src="../js/funciones.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <LINK REL=StyleSheet HREF="../CSS/estilos.css">
</head>
<body>
<div class="input">
    <form name="formulario_iniciar_sesion" action="menu_manzana.php" method='post'>
        <h1>Ingresar datos</h1>
        <input type="text" name="u" required placeholder="Usuario"/>
        <input type="password" name="p" required placeholder="Contraseña"/>
        <br><br>
        <input type="submit" class="btn btn-primary btn-block btn-large" value="Iniciar Sesión" id="enviar">
    </form>
</div>
</body>
</html>