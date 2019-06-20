# DESARROLLADORES
UNIVERSIDAD DE SAN CARLOS DE GUATEMALA

FACULTAD DE INGENIERIA

SEMINARIO DE SISTEMAS 1

BAYRON ROMEO AXPUAC YOC 201314474

WILSON GUERRA 201314571

# FASE 1
Se establece un sistema de E-Commerce, el sistema esta montado en la nube.  La palabra ecommerce es una abreviatura de comercio electrónico que, básicamente, designa el comercio que se realiza online. Este tipo de negocio ha ganado fuerza en los últimos años, cuando los consumidores se dieron cuenta de que Internet es un entorno seguro para la compra. Nuestro sistema cuenta con un servidor web el cual nos permite visualizar los productos de una empresa y así mismo ingresar nuevos productos al sistema toda esta información es almacenada en una base de datos. Esta aplicación se llevo a cabo gracias a las herramientas de AWS y el uso de contedores en Docker. 

# Tecnologia Utilizada No.1 API
Las API son un conjunto de comandos, funciones y protocolos informáticos que permiten a los desarrolladores crear programas específicos para ciertos sistemas operativos. Las API simplifican en gran medida el trabajo de un creador de programas, ya que no tiene que «escribir» códigos desde cero. Estas permiten al informático usar funciones predefinidas para interactuar con el sistema operativo o con otro programa. A continuación se muestra el codigo utilizado para la realización de las apis de nuestro sistema:

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


# Tecnologia Utilizada No.2 BD en MySQL

Una base de datos es un conjunto de datos pertenecientes a un mismo contexto y almacenados sistemáticamente para su posterior uso. En este sentido; una biblioteca puede considerarse una base de datos compuesta en su mayoría por documentos y textos impresos en papel e indexados para su consulta. MySQL es un sistema de gestión de bases de datos relacional desarrollado bajo licencia dual: Licencia pública general/Licencia comercial por Oracle Corporation y está considerada como la base datos de código abierto más popular del mundo. Para nuestro sistema se utilizó unicamente una tabla para el almacenamiento de los productos a continuación el codigo SQL utlizado.


            CREATE TABLE PRODUCTO(
                 id MEDIUMINT NOT NULL AUTO_INCREMENT,
                 nombre CHAR(30) NOT NULL,
                 precio INT NOT NULL,
                 cantidad INT NOT NULL,
                 PRIMARY KEY (id)
            );

# Tecnologia Utilizada No.3 APACHE Y PHP
Apache es un software de servidor web gratuito y de código abierto con el cual se ejecutan el 46% de los sitios web de todo el mundo. El nombre oficial es Apache HTTP Server, y es mantenido y desarrollado por la Apache Software Foundation. Le permite a los propietarios de sitios web servir contenido en la web, de ahí el nombre de “servidor web”. Es uno de los servidores web más antiguos y confiables, con la primera versión lanzada hace más de 20 años, en 1995. Cuando alguien quiere visitar un sitio web, ingresa un nombre de dominio en la barra de direcciones de su navegador. Luego, el servidor web envía los archivos solicitados actuando como un repartidor virtual.PHP, acrónimo recursivo en inglés de PHP: Hypertext Preprocessor (preprocesador de hipertexto), es un lenguaje de programación de propósito general de código del lado del servidor originalmente diseñado para el desarrollo web de contenido dinámico.


# DOCKER FILES
Un Dockerfile es un archivo de texto plano que contiene las instrucciones necesarias para automatizar la creación de una imagen que será utilizada posteriormente para la ejecución de instancias específicas. Para la realización de nuestro proyecto realizamos tres docker files a continuación la estrucutra de los mismos.

1) DockerFile para la creación de una imagen para la elaboración de una Base de Datos.

            # Derived from official mysql image (our base image)
            FROM mysql:5.7
            # Add a database
            ENV MYSQL_DATABASE PROYECTOSEMINARIO1
            # Add the content of the sql-scripts/ directory to your image
            # All scripts in docker-entrypoint-initdb.d/ are automatically
            # executed during container startup
            COPY ~/BasesDeDatos/sql-scripts /docker-entrypoint-initdb.d/


2) DockerFile para la creación de una imagen para la elaboración de una api con Node.
                 
            
            FROM node
            WORKDIR /api_Fase1
            ADD . /api_Fase1
            RUN npm install
            CMD ["npm","start"]
            
            
3) DockerFile para la creación de una imagen para la elaboración de un servidor web. 


            FROM ubuntu
            MAINTAINER cloudingtutos <soporte@clouding.io>
            ENV HOME /root
            RUN apt-get update
            RUN apt-get install -y apache2 wget
            EXPOSE 80
            CMD service apache2 start

# CREACIÓN DE IMAGENES EN DOCKER

Las imágenes de Docker son esencialmente una instantánea de un contenedor. Las imágenes se crean con el comando build, que crean un contenedor cuando se inicia con run. Una vez creada una imagen, se pueden almacenar en el Hub Docker. Para subir una imagen a un repositorio en Docker Hub, Primero se debe tener una cuenta en esta plataforma y de igual manera tener un repositorio creado.En nuestra terminal debe ingresar el siguiente comando:

    docker login --username [nombre]
 
Al correr el comando anterior se debe ingresar la contraseña con la cual ingresamos al sistema, por consiguiente se debe agregar un tag a la imagen que se desea subir y se realiza con el siguiente comando. 
 
    docker tag [nombre del repolocak]:[id] [Repositorio En Docker Hub]:[Nombre de la Imagen en el Repositorio]
 
 Para terminar subiremos la imagen a nuestro repositorio con el comando:
  
    docker push [Repositorio En Docker Hub]:[Nombre de la Imagen en el Repositorio]
 
 En esta oportunidad se crearon tres imagenes distintas en una de ellas se creo una base de datos con el Gestor MySQL, una servidor web Apache y uno con la herramienta node para poder realizar apis que permitiran darle un buen rendimiento al sistema.

# ENLACE A IMAGENES DOCKER EN DOCKER HUB
https://cloud.docker.com/repository/docker/romeo123axpuac/fase1

# ERRORES

Uno de los errores que se encuentro al momento de desarrolar la api de la aplicación, es que el modulo de node para mysql solo soporta una conexion simultanea, por lo que para la primera consulta funciona bien, pero si se quiere hacer otra, entoces lanza una excepcion, para resolverlo se debe abrir la conexion solo una vez, y reutilizarla en toda la api, sin cerrarla en ningun momento.
