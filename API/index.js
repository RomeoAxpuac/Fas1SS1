const express = require('express');
const app = express();

const mysql = require('mysql');

const con = mysql.createConnection({
        host:'172.17.0.2',
        port:'3306',
        user:'root',
        password:'123456789',
        database:'PROYECTOSEMINARIO1'
});

var bodyParser = require('body-parser');
app.use(bodyParser.json()); // support json encoded bodies
app.use(bodyParser.urlencoded({ extended: true })); // support encoded bodies

con.connect(function(err) {
    if (err) throw err;
        console.log(err);
});

app.get('/producto', function (req, res) {
var productos = [];
//con.connect(function(err) {
        con.query("SELECT * FROM PRODUCTO", function (err, result, fields) {
        for(var i = 0;i< result.length;i++){
                productos.push({'id':result[i].id,'nombre':result[i].nombre,'cantidad':result[i].cantidad,'precio':result[i].precio});
        }
        if (err) throw err;
        res.json(productos);
});
//});

  //res.json("{error:'Hubo un error'}");
})
app.post('/producto', function (req, res) {
        var nombre_producto = req.body.nombre;
	var precio_producto = req.body.precio;
        var cantidad_producto = req.body.cantidad;
        //console.log(nombre_producto + ' - ' + cantidad_producto + ' - ' + precio_producto)
        var sql = "INSERT INTO PRODUCTO(nombre,cantidad,precio) VALUES('"+ nombre_producto+"',"+cantidad_producto+","+precio_producto+")"; 
        con.query(sql, function (err, result) {
    if (err) throw err;
    res.send("1 record inserted");
});

});
app.get('/suma', function (req, res) {
  var total = 5+7
  j = {'valor':total}
  res.json(j)
})

app.listen(3000,()=>{
        console.log('Servidor API iniciado!!!!');

});
