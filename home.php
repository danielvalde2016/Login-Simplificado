<?php session_start() ?>
<?php if(isset($_SESSION['usuario']))
{
?>
 <h1>Bienvenido de nuevo <?php echo $_SESSION['usuario'] ?>.</h1>
 <?php
include 'users/Usuarios.php';
Comprobar::comprobarUsuario($_SESSION['usuario'], $_SESSION['clave']);

}else{
 header("Location: index.php");
}