<?php
include_once("bd.php");
class paciente extends bd{
	var $tabla="paciente";

	function estadoTabla(){
		return $this->statusTable();
	}
	function listar(){
		$this->campos=array('*');
		return $this->getRecords("Activo=1","Paterno, Materno, Nombres");
	}
	function mostrarPaciente($CodPaciente){
		$this->campos=array('*');
		return $this->getRecords(" CodPaciente=$CodPaciente","Paterno,Materno,Nombres");
	}
	function mostrarTodoDatosPaciente($CodPaciente){
		$this->campos=array('*');
		return $this->getRecords(" CodPaciente=$CodPaciente","Paterno,Materno,Nombres");
	}
	function loginPaciente($Usuario,$Password){
		$this->campos=array("count(*) as Can,CodPaciente as CodUsuario");	
		return $this->getRecords("Usuario='$Usuario' and Password='$Password'");
	}
	function mostrarTodosPaciente(){
		$this->campos=array("*");
			return $this->getRecords("Activo=1","Paterno,Materno,Nombres");
	}
}
?>