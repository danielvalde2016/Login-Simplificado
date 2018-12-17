<?php
class Conexion
{
    private static $instancia;
    private $dbh;
 
    private function __construct()
    {
        try {
 
            $this->dbh = new PDO('mysql:host=localhost;dbname=market_online', 'usuario', 'usuario');
            $this->dbh->exec("SET CHARACTER SET utf8");
 
        } catch (PDOException $e) {
 
            print "Error!: " . $e->getMessage();
 
            die();
        }
    }
 
    public function prepare($sql)
    {
 
        return $this->dbh->prepare($sql);
 
    }
 
    public static function singleton_conexion()
    {
 
        if (!isset(self::$instancia)) {
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
 
        }
 
        return self::$instancia;
        
    }
 
 
     // Evita que el objeto se pueda clonar
    public function __clone()
    {
 
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
 
    }
}
 
require_once 'conexion/conexion.class.php';
session_start();
class Login
{
 
    private static $instancia;
    private $dbh;
 
    private function __construct()
    {
 
        $this->dbh = Conexion::singleton_conexion();
 
    }
 
    public static function singleton_login()
    {
 
        if (!isset(self::$instancia)) {
 
            $miclase = __CLASS__;
            self::$instancia = new $miclase;
 
        }
 
        return self::$instancia;
 
    }
 
 public function login_users($nick,$password)
 {
 
 try {
 
 $sql = "SELECT * from usuarios WHERE usuario = ? AND clave = ?";
 $query = $this->dbh->prepare($sql);
 $query->bindParam(1,$nick);
 $query->bindParam(2,$password);
 $query->execute();
 $this->dbh = null;
 
 //si existe el usuario
 if($query->rowCount() == 1)
 {
 
 $fila  = $query->fetch();
 $_SESSION['idusuario'] = $fila['idusuario'];
 $_SESSION['nombre'] = $fila['nombre'];
 $_SESSION['apellido'] = $fila['apellido'];
 $_SESSION['email'] = $fila['email'];
 $_SESSION['direccion'] = $fila['direccion'];
 $_SESSION['administrador'] = $fila['administrador'];
 $_SESSION['usuario'] = $fila['usuario'];
 $_SESSION['clave'] = $fila['clave']; 
 return TRUE;
 
 }
 
 }catch(PDOException $e){
 
 print "Error!: " . $e->getMessage();
 
 } 
 
 }
    
 
     // Evita que el objeto se pueda clonar
    public function __clone()
    {
 
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
 
    }
 
}
?>