<!doctype html>
<html lang="en">
  <head>
    <title>Productos</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo.css">
  </head>
  <body>
      <h1 class = "titulo">Segundo Parcial</h1>
      <table>
      <div class = "container">
      <form class = "d-flex" action = "crud_empleado.php" method = "post">
        <div class = "col">
        <div class="mb-3">
            <label for="lbl_id" class="form-label"><b>ID</b></label>
            <input type="text" name="txt_id" id="txt_id" class="form-control" value = "0" readonly>
        </div>

      <div class="mb-3">
            <label for="lbl_codigo" class="form-label"><b>Producto</b></label>
            <input type="text" name="txt_producto" id="txt_producto" class="form-control" placeholder="Producto: Tenis" required>
        </div>
        <div class="mb-3">
            <label for="lbl_nombres" class="form-label"><b>Descripcion</b></label>
            <input type="text" name="txt_descripcion" id="txt_descripcion" class="form-control" placeholder="Descripcion: Blanco" required>
        </div>
        <div class="mb-3">
            <label for="lbl_apellidos" class="form-label"><b>Precio Costo</b></label>
            <input type="text" name="txt_precio_costo" id="txt_precio_costo" class="form-control" placeholder="Precio Costo: 12.00" required>
        </div>
        <div class="mb-3">
            <label for="lbl_direccion" class="form-label"><b>Precio Venta</b></label>
            <input type="text" name="txt_precio_venta" id="txt_precio_venta" class="form-control" placeholder="Precio Venta: 9.99" required>
        </div>
        <div class="mb-3">
            <label for="lbl_telefono" class="form-label"><b>Existencias</b></label>
            <input type="number" name="txt_existencias" id="txt_existencias" class="form-control" placeholder="Existencias: 99" required>
        </div>
        <div class="mb-3">
          <label for="lbl_puesto" class="form-label"><b>Marca</b></label>
          <select class="form-select" name="drop_marca" id="drop_marca">
            <option value= 0>---- Marca ----</option>
            <?php
            include("datos_conexion.php");
            $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_nombre);
            $db_conexion ->real_query("Select idmarca as id,marca from segundo_parcial.marcas;");
            $resultado = $db_conexion->use_result();
            while($fila = $resultado->fetch_assoc()){
              echo"<option value=".$fila['id'] .">".$fila['marca']."</option>";

            }
            $db_conexion ->close();

            ?>

          </select>
        </div>
        
        <div class="mb-3">
            <input type="submit" name="btn_agregar" id="btn_agregar" value ="Agregar" class="btn btn-primary">
            <input type="submit" name="btn_modificar" id="btn_modificar" value ="Modificar" class="btn btn-secondary">
            <input type="submit" name="btn_eliminar" id="btn_eliminar" value = "Eliminar" class="btn btn-danger">
        </div>
        </div>
        
</form>
          </div>
          <br>
          <br>

          <div class="tbl_formato">

<table id="tabla1" class="table table-stripe table-inverse table-responsive">
  <thead class="thead-inverse|thead-default">
    <tr>
      <th>Producto</th>
      <th>Descripcion</th>
      <th>Precio Costo</th>
      <th>Precio Venta</th>
      <th>Existencias</th>
      <th>Marca</th>
    </tr>
    </thead>
    <tbody id = "tbl_empleados">
          <?php
            include("datos_conexion.php");
            $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_nombre);
            $db_conexion ->real_query("select e.idProductos as id, e.producto, e.descripcion, e.precio_costo, e.precio_venta, e.existencia, p.marca, e.idmarca from productos as e inner join marcas as p  on e.idmarca=p.idmarca;");
            $resultado = $db_conexion->use_result();
            while($fila = $resultado->fetch_assoc()){

              echo"<tr data-id=".$fila['id']." data-idp=".$fila['idmarca'].">";
              echo"<td>". $fila['producto'] ."</td>";
              echo"<td>". $fila['descripcion'] ."</td>";
              echo"<td>". $fila['precio_costo'] ."</td>";
              echo"<td>". $fila['precio_venta'] ."</td>";
              echo"<td>". $fila['existencia'] ."</td>";
              echo"<td>". $fila['marca'] ."</td>";
              echo"</tr>";

            }

            $db_conexion ->close();

            ?>
    </tbody>
</table>
<button onclick="ocultarTabla()">Mostrar/Ocular Tabla</button>
          </div>


        <?php

        if(isset($_POST["btn_agregar"])){
          include("datos_conexion.php");
          $db_conexion = mysqli_connect($db_host, $db_usr, $db_pass, $db_nombre);
          $txt_producto = utf8_decode($_POST["txt_producto"]);
          $txt_descripcion = utf8_decode($_POST["txt_descripcion"]);
          $txt_precio_costo = utf8_decode($_POST["txt_precio_costo"]);
          $txt_precio_venta = utf8_decode($_POST["txt_precio_venta"]);
          $txt_existencias = utf8_decode($_POST["txt_existencias"]);
          $drop_marca = utf8_decode($_POST["drop_marca"]);
          $txt_fn = utf8_decode($_POST["txt_fn"]);
          $sql = "INSERT INTO productos (producto,descripcion,precio_costo, precio_venta, existencia,idmarca) VALUES('".$txt_producto."','".$txt_descripcion."',".$txt_precio_costo.",".$txt_precio_venta.",".$txt_existencias.", ".$drop_marca.");";

          if($db_conexion->query($sql)===true){
            $db_conexion->close();
            echo"exito";
            header("refresh:0");
          }else{
            echo"error" .$sql."<br>".$db_conexion->close();
          }

        }

        ?>


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  
      <script>
        $("#tbl_empleados").on('click','tr td',function (e){
          var target, id, idp,codigo,nombres,apellidos,direccion,telefono,nacimiento;
          target = $(event.target);
          id = target.parent().data('id');
          idp = target.parent().data('idp');
          codigo = target.parent('tr').find("td").eq(0).html();
          nombres = target.parent('tr').find("td").eq(1).html();
          apellidos = target.parent('tr').find("td").eq(2).html();
          direccion = target.parent('tr').find("td").eq(3).html();
          telefono = target.parent('tr').find("td").eq(4).html();
          nacimiento = target.parent('tr').find("td").eq(6).html();
          $("#txt_id").val(id);
          $("#txt_producto").val(codigo);
          $("#txt_descripcion").val(nombres);
          $("#txt_precio_costo").val(apellidos);
          $("#txt_precio_venta").val(direccion);
          $("#txt_existencias").val(telefono);
          $("#txt_fn").val(nacimiento);
          $("#drop_marca").val(idp);




        });
  
      </script>

      <script>
        function ocultarTabla() {
  var x = document.getElementById("tabla1");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else { 
    x.style.display = "none";
  }
}
        </script>


  
  </body>
</html>