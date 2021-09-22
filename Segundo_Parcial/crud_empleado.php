<?php
     
     if( !empty($_POST) ){
   
       $txt_id = utf8_decode($_POST["txt_id"]);
        $txt_producto = utf8_decode($_POST["txt_producto"]);
        $txt_descripcion = utf8_decode($_POST["txt_descripcion"]);
        $txt_precio_costo = utf8_decode($_POST["txt_precio_costo"]);
        $txt_precio_venta = utf8_decode($_POST["txt_precio_venta"]);
        $txt_existencias = utf8_decode($_POST["txt_existencias"]);
        $drop_marca = utf8_decode($_POST["drop_marca"]);
        
      include("datos_conexion.php");
        $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
        $sql ="";
        if(isset($_POST['btn_agregar'])  ){
          $sql = "INSERT INTO productos(producto,descripcion,precio_costo,precio_venta,existencia,idmarca) VALUES ('". $txt_producto ."','". $txt_descripcion ."',". $txt_precio_costo .",". $txt_precio_venta .",". $txt_existencias .",". $drop_marca .");";
        }
        if( isset($_POST['btn_modificar'])  ){
          $sql = "update productos set producto='". $txt_producto ."',descripcion='". $txt_descripcion ."',precio_costo='". $txt_precio_costo ."',precio_venta='". $txt_precio_venta ."',existencia='". $txt_existencias ."',idmarca=". $drop_marca ." where idProductos = ". $txt_id.";";
        }
        if( isset($_POST['btn_eliminar'])  ){
          $sql = "delete from productos  where idProductos = ". $txt_id.";";
        }
         
          if ($db_conexion->query($sql)===true){
            $db_conexion->close();
           
            header('Location: /Segundo_Parcial');
           
          }else{
            $db_conexion->close();
          
          }

      }
     
    
      
      ?>