
<html>
<head>
<style type= "text/css">
<!--
body{background: url("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRjAkOvNwKjwEf0LvCRhM1XKYrtCuK9Ht_UDMUE86MGvLqtr0fl") no-repeat fix$
        background-attachment: fixed;
        background-size: cover;
}
-->     
 p { 
        color: white; font-family: Verdana;
        margin: 20px auto;
        width: 350px;
  }

  .informacion {
        background: #D3D3D3 center no-repeat;
        background-position: 15px 50%;
        color: black;
        font-family: Arial;
        font-size: 25px;
        text-align: center;
        padding: 28px 20px 25px 45px;
        border-top: 5px double #00529B;
        border-bottom: 5px double #00529B;
        }


        body {
            background-image: url("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRjAkOvNwKjwEf0LvCRhM1XKYrtCuK9Ht_UDMUE86MGvLqtr0fl");
        }
</style>
<title></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script Language="JavaScript">
$(document).ready(function() {
    $.ajax({
        url: "http://ec2-18-191-0-43.us-east-2.compute.amazonaws.com:3000/producto"
}).then(function(data) {
        alert("Hello! I am an alert box!!");
       $('#productos').html(data);
    });
});
</script>
</head>
<body>
<div>
<?php
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "http://ec2-13-59-177-105.us-east-2.compute.amazonaws.com:3000/producto");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res = curl_exec($ch);
$elementos = json_decode($res)
?>
</div>
        <center>
        <img src="http://www.aikidomallorca.es/wp-content/uploads/2017/04/bienvenido.png" width="400" height="341">


        <td>
        <form id="form1" name="form1" action= "http://ec2-13-59-177-105.us-east-2.compute.amazonaws.com:3000/producto" method="POST" ">
        <p><span class="Estilo16">Nombre Producto<br />
        <label>
                <input name="nombre" type="text" id="nombre" />
        </label>
        <br />
        Cantidad<br />
        <input name="cantidad" type="text" id="cantidad" />
        <br />
        Precio<br />
        <input  name="precio" type="text" id="precio" />

        </span><br />
        <label>
        <input type="submit" name="Submit" value="Cargar Productos" />
        </label>
        </p>
        </form>

        </td> 
</center>
<div id="productos"></div>

<?php
if(count($elementos)){
echo '<center><table border="2" ><thead>
<th><p style="color:rgb(FFFF,FFFF,FFFF);">Nombre</P></th>
<th><p style="color:rgb(FFFF,FFFF,FFFF);">Cantidad</P></th>
<th><p style="color:rgb(FFFF,FFFF,FFFF);">Precio</P></th>
<thead>
<tbody>';
foreach($elementos as $key => $e){
        //print_r($e)

        echo '<tr>';
        echo '<td>';

        echo '<font color="white">';    

        echo  $e->nombre ;

        echo '</font>';
        echo '</td>';
        echo '<td>'; 
        echo '<font color="white">';
        echo  $e->cantidad ;

        echo '</font>';
        echo '</td>';
        echo '<td>'; 
	echo '<font color="white">';

        echo  $e->precio;

        echo '</font>';
        echo '</td>';
        echo '</tr>';
}
echo ' </tbody></table></center>';
}
?>
<?php curl_close($ch); ?>



</body>
</html>
