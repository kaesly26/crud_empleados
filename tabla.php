
<?php 
  include ("conexion/conexion.php");
 $sql=$conexion->prepare("SELECT * FROM empresa2.empleados");
 $sql->execute(); 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>tabla de contenido</title>

</head>
<body>
  <center>
        <h1>Empleados</h1>
        <div class=tabla>
        <table>
        <tr>
        <th>Nombre </th>
        <th>Apellido paterno  </th>
        <th>Apellido materno  </th>
        <th>Correo </th>
        <th>Foto</th>
        <th>identificación </th>
        <th></th>
        <th></th>
        </tr>
       <tbody>
       
        <?php foreach ($sql as $fila){?>
            <div class="tabla">
            <tr>
              <td><?php echo $fila["Nombres"];?></td>
              <td><?php echo $fila["Apellido_paterno"];?></td>
              <td><?php echo $fila["Apellido_materno"];?></td>
              <td><?php echo $fila["Correo"];?></td>
              <td><img height="100px" width="100px" decoding="async" src="img/<?php echo $fila['Foto'];?>"></td>
              <td><?php echo $fila["Identificacion"];?></td>
              <td>
                <form action="index.php" method="post">
                    <input type="hidden" name="nombre" value="<?php echo $fila["Nombres"];?>">
                    <input type="hidden" name="apellido_p" value="<?php echo $fila["Apellido_paterno"];?>">
                    <input type="hidden" name="apellido_m" value="<?php echo $fila["Apellido_materno"];?>">
                    <input type="hidden" name="correo" value="<?php echo $fila["Correo"];?>">
                    <input type="hidden" name="foto" value="<?php echo $fila["Foto"];?>">
                    <input type="hidden" name="id" value="<?php echo $fila["Identificacion"];?>">
                    <button type="submit" name="action" value="eliminar" class="btnd">Eliminar</button>
                    <button type="submit" name="action" class="btn">Seleccionar</button>
                   
                </form>
               
              </td>
            </tr>
            </div>
           
        <?php }?>
        <p><a href="index.php">regresar</a></p>
  </center> 
    <script>
      
    </script>
</body>
</html>