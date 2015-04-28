<?php
include_once("../../login/check.php");
include_once("../../class/producto.php");
include_once("../../class/productotipo.php");
include_once("../../class/inventario.php");
$producto=new producto;
$productotipo=new productotipo;
$inventario=new inventario;
extract($_POST);

/*$Nombre=$Nombre!=""?"Nombre LIKE '$Nombre%'":"Nombre LIKE '%'";
$Unidad=$Unidad!=""?"Unidad LIKE '$Unidad%'":"Unidad LIKE '%'";*/
$CodProductoTipo=$CodProductoTipo!=""?"CodProductoTipo LIKE '$CodProductoTipo%'":"CodProductoTipo LIKE '%'";
$CodProducto=$CodProducto!=""?"CodProducto LIKE '$CodProducto%'":"CodProducto LIKE '%'";
$condicion="$CodProducto and $CodProductoTipo";
$pro=$producto->mostrarTodoRegistro($condicion,1,"Nombre");
foreach($pro as $p){$i++;

    $reg=$inventario->cantidadStock($p['CodProducto']);
    $reg=array_shift($reg);
    $CantidadStock=$reg['CantidadStock'];
    if($EnExistencia==1){
        if($CantidadStock<=0){
            continue;    
        }else{
            
        }
    }
    
	$pt=$productotipo->mostrarRegistro($p['CodProductoTipo']);
	$pt=array_shift($pt);
    
	
    $datos[$i]['CodProducto']=$p['CodProducto'];

	$datos[$i]['Nombre']=$p['Nombre'];
	$datos[$i]['Unidad']=$p['Unidad'];
	$datos[$i]['CantidadStock']=$CantidadStock;
	$datos[$i]['CodProductoTipo']=$pt['Nombre'];
}

$titulo=array(
				"CodProductoTipo"=>$idioma['TipoProducto'],
                "Nombre"=>"Producto",
                "CantidadStock"=>"Stock",
				"Unidad"=>$idioma['UnidadMedida'],
				
				
);


$modificar="detalle.php";

listadotabla($titulo,$datos,1,$modificar,"","");
?>