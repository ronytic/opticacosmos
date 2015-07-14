<?php
include_once("../../login/check.php");
include_once("../../class/producto.php");
include_once("../../class/productotipo.php");
include_once("../../class/inventario.php");
include_once("../../class/optica.php");
$producto=new producto;
$productotipo=new productotipo;
$inventario=new inventario;
$optica=new optica;
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
    
    //$CantidadStock=$reg['CantidadStock'];
    $CantidadStock=$reg['Cantidad'];
    
    
    $o1=$optica->cantidadVenta("CodProducto1=".$p['CodProducto']);
    //print_r($o1);
    $o2=$optica->cantidadVenta("CodProducto2=".$p['CodProducto']);
    //print_r($o2);
    $o3=$optica->cantidadVenta("CodProducto3=".$p['CodProducto']);
    //print_r($o3);
    $o4=$optica->cantidadVenta("CodProducto4=".$p['CodProducto']);
    //print_r($o4);
    $o1=array_shift($o1);
    $o2=array_shift($o2);
    $o3=array_shift($o3);
    $o4=array_shift($o4);
    
    $c1=$o1['Cantidad'];
    $c2=$o2['Cantidad'];
    $c3=$o3['Cantidad'];
    $c4=$o4['Cantidad'];
    $cantidadVendida=$c1+$c2+$c3+$c4;
    
    
    
    
    $CantidadReal=$CantidadStock-$cantidadVendida;
    
    
    if($CantidadReal>0){
        $color="success";    
    }elseif($CantidadReal==0){
        $color="warning";
    }else{
        $color="danger";
    }
    
    if($EnExistencia==1){
        if($CantidadReal<=0){
            continue;    
        }else{
            
        }
    }
    
    //echo $c1;
    
    
	$pt=$productotipo->mostrarRegistro($p['CodProductoTipo']);
	$pt=array_shift($pt);
    
	
    $datos[$i]['CodProducto']=$p['CodProducto'];

	$datos[$i]['Nombre']=$p['Nombre'];
	$datos[$i]['Unidad']=$p['Unidad'];
	$datos[$i]['CantidadAlmacenada']=$CantidadStock;
    $datos[$i]['CantidadVendida']=$cantidadVendida;
    $datos[$i]['CantidadStock']='<span class="badge badge-'.$color.'">'.$CantidadReal.'</span>';
	$datos[$i]['CodProductoTipo']=$pt['Nombre'];
}

$titulo=array(
				"CodProductoTipo"=>$idioma['TipoProducto'],
                "Nombre"=>"Producto",
                "CantidadAlmacenada"=>"Cant. Almacenada",
                "CantidadVendida"=>"Cant. Vendida",
                "CantidadStock"=>"Stock",
				"Unidad"=>$idioma['UnidadMedida'],
				
				
);


$modificar="detalle.php";

listadotabla($titulo,$datos,1,$modificar,"","");
?>