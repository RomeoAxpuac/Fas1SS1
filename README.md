# DESARROLLADORES
UNIVERSIDAD DE SAN CARLOS DE GUATEMALA

FACULTAD DE INGENIERIA

SEMINARIO DE SISTEMAS 1

BAYRON ROMEO AXPUAC YOC 201314474

WILSON GUERRA 201314571

# FASE 1
Se establece un sistema de E-Commerce, el sistema esta montado en la nube.  La palabra ecommerce es una abreviatura de comercio electrónico que, básicamente, designa el comercio que se realiza online. Este tipo de negocio ha ganado fuerza en los últimos años, cuando los consumidores se dieron cuenta de que Internet es un entorno seguro para la compra. Nuestro sistema cuenta con un servidor web el cual nos permite visualizar los productos de una empresa y así mismo ingresar nuevos productos al sistema toda esta información es almacenada en una base de datos. Esta aplicación se llevo a cabo gracias a las herramientas de AWS y el uso de contedores en Docker. 

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
