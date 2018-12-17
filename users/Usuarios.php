<?php
	/**
	* tipos
	*/
	class Usuarios
	{
		protected $idusuario;
		protected $nombre;
		protected $apellidos;
		protected $email;
		protected $direccion;
		protected $usuario;
		protected $clave;
		public static function comparar($tipo, $idusuario, $nombre, $apellidos, $email, $direccion, $usuario, $clave)
		{
			switch ($tipo) {
				case "1":
					return new Administrador($idusuario, $nombre, $apellidos, $email, $direccion, $usuario, $clave);
				case "0":
					return new Cliente($idusuario, $nombre, $apellidos, $email, $direccion, $usuario, $clave);
			}
		}
		public function getType()
		{
			return get_class($this);
		}
	}
	/**
	* administrador
	*/
	class Administrador extends Usuarios
	{
		
		function __construct($idusuario, $nombre, $apellidos, $email, $direccion, $usuario, $clave)
		{
			$this->idusuario = $idusuario;
			$this->nombre = $nombre;
			$this->apellidos = $apellidos;
			$this->email = $email;
			$this->direccion = $direccion;
			$this->usuario = $usuario;
			$this->clave = $clave;
		}
		public function __toString()
		{
			return "La id del usuario es ".$this->idusuario." el nombre de usuario es ".$this->usuario." y es ". $this->getType()."<br>";
		}
	}
	class Cliente extends Usuarios
	{
		
		function __construct($idusuario, $nombre, $apellidos, $email, $direccion, $usuario, $clave)
		{
			$this->idusuario = $idusuario;
			$this->nombre = $nombre;
			$this->apellidos = $apellidos;
			$this->email = $email;
			$this->direccion = $direccion;
			$this->usuario = $usuario;
			$this->clave = $clave;
		}
		public function __toString()
		{
			return "La id del usuario es ".$this->idusuario." el nombre de usuario es ".$this->usuario." y es ". $this->getType()."<br>";
		}
	}


	class Comprobar
	{
	public function comprobarUsuario($usuario, $password)
	{
		if ($usuario == $_SESSION['usuario']) {
			$usuario1 = Usuarios::comparar($_SESSION['administrador'], $_SESSION['idusuario'], $_SESSION['nombre'], $_SESSION['apellido'], $_SESSION['email'], $_SESSION['direccion'], $_SESSION['usuario'], $_SESSION['clave']);
			echo $usuario1;
		} else {
			echo "<p>No se ha podido iniciar sesion.</p>";
		}
	}
}
?>