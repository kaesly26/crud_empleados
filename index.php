<?php
include ("conexion/conexion.php");
$id=(isset( $_POST['id']))? $_POST['id']:"";
$nombre=(isset( $_POST['nombre']))?$_POST['nombre']:"";
$apellidoPaterno= (isset($_POST['apellido_p']))?$_POST['apellido_p']:"";
$apellidoMaterno= (isset( $_POST['apellido_m']))? $_POST['apellido_m']:"";
$correo= (isset($_POST['correo']))?$_POST['correo']:"";

$accion=(isset($_POST['action']))?$_POST['action']:"";

switch($accion){
    case 'guardar':
       
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $date= new DateTime();
                $foto=(isset($_FILES['foto']['name']))?$_FILES['foto']['name']:"";
                $nombreArchivo= ($foto != "") ? $date->getTimestamp() ."_". $_FILES["foto"]["name"] : "imagen.jpg";
                $tmp_name = $_FILES["foto"]['tmp_name'];
                echo "la ruta".$nombreArchivo;
                if($tmp_name != ""){
                    move_uploaded_file($tmp_name,"./img/". $nombreArchivo);
                }
            }else{
                echo"la imagen no se guardo";
            }
           


            echo "activaste el boton guardar";
            $smtp=$conexion->prepare( "INSERT INTO empleados ( Nombres , Apellido_paterno, Apellido_materno, Correo, Foto, Identificacion) VALUE(?,?,?,?,?,?) ");
            //$smtp->bindParam(5,$imagen, PDO::PARAM_LOB);
            $smtp->execute([$nombre,$apellidoPaterno,$apellidoMaterno,$correo,$nombreArchivo,$id]);
            if($smtp){
                echo "<br>";
                echo "se guardaron";
        
            }else{
                echo"nose guardaron";
            }
           
            /*
            $conexion= "INSERT INTO empleados ( Nombres , Apellido_paterno, Apellido_materno, Correo, Foto, Identificacion) VALUE 
            ('$nombre','$apellidoPaterno','$apellidoMaterno','$correo','$foto','$id')";
            echo "<center>";
          
            echo "</center>";
            $h=  mysqli_query($enlace,$conexion);*/


        } catch (Throwable $e) {
            echo "error " . $e->getMessage();
        }
        
        break;

    case 'modificar':
        try {

            $smtp=$conexion->prepare("UPDATE empleados SET Nombres=?,Apellido_paterno=?,Apellido_materno=?, Correo=?, Foto=? WHERE identificacion= ?");
            $smtp->execute([$nombre,$apellidoPaterno,$apellidoMaterno,$correo,$foto,$id]);
            /*
            $conexion="UPDATE empleados set Nombres='$nombre',Apellido_paterno='$apellidoPaterno',Apellido_materno='$apellidoMaterno', Correo='$correo', Foto='$foto' where identificacion='$id'";
            echo "<center>";
            echo "activaste el boton modificar";
            echo "</center>";
            $h=  mysqli_query($enlace,$conexion);*/
           

        } catch (Throwable $e) {
            echo "error " . $e->getMessage();
        }
        break;   

    case 'eliminar':
        try{
            $smtp=$conexion->prepare("DELETE FROM empleados WHERE identificacion= ?");
            $smtp->execute([$id]);
            /*
            $conexion="DELETE from empleados where identificacion= $id";
            $h=  mysqli_query($enlace,$conexion);
            echo "<center>";
            echo "activaste el boton eliminar";
            echo "</center>";*/
       
        } catch (Throwable $e) {
            echo "error " . $e->getMessage();
        }
        break;

    case 'cancelar':
        echo "<center>";
        echo "activaste el boton cancelar";
        echo "</center>";
        break;  

    default:

      break;   
      

}


$sql=$conexion->prepare("SELECT * FROM empresa.empleados");
$sql->execute();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>conexion bd</title>
</head>
<body>
    <div>
    <center>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <p></p>
            <h1>Registro de Empleados</h1>
            <p>Identificación:</p> <input type="text" name="id" id="id" value= "<?php echo $id ?>" placeholder="" requiere="">
            <p>Nombre:</p> <input type="text" name="nombre" id="nombre" value= "<?php echo $nombre ?>" placeholder="" requiere=""/>
            <p>Apellido paterno: </p><input type="text" name="apellido_p" id="apellido_p" value= "<?php echo $apellidoPaterno ?>" placeholder="" requiere=""/>
            <p>Apellido materno: </p><input type="text" name="apellido_m" id="apellido_m"  value= "<?php echo $apellidoMaterno ?>" placeholder="" requiere=""/>
            <p>Correo: </p><input type="text" name="correo" id="correo"  value= "<?php echo $correo ?>" placeholder="" requiere="" />
            <p>Foto: </p><input type="file" name="foto" id="foto" accept="image/*" value= "<?php echo $foto ?>" multiple/>
            <br><br>
            <button type="submit" name= "action" value="guardar" class="btn btn-info">Guardar</button>
            <button type="submit" name= "action" value="modificar" class="btn btn-info ">Modificar</button>
            <button type="submit" name= "action" value="eliminar" class="btn btn-info ">Eliminar</button>
        </form>
        <br>
        <p><a href="tabla.php">ir a la tabla de contenido</a></p>
    </center>
    </div>
    
    
    

    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>