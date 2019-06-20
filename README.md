# DESARROLADORES
UNIVERSIDAD DE SAN CARLOS DE GUATEMALA

FACULTAD DE INGENIERIA

SEMINARIO DE SISTEMAS 1

BAYRON ROMEO AXPUAC YOC 201314474

WILSON GUERRA 201314571

# FASE 1
Se establece un sistema de E-Commerce, el sistema esta montado en la nube.  La palabra ecommerce es una abreviatura de comercio electrónico que, básicamente, designa el comercio que se realiza online. Este tipo de negocio ha ganado fuerza en los últimos años, cuando los consumidores se dieron cuenta de que Internet es un entorno seguro para la compra. Nuestro sistema cuenta con un servidor web el cual nos permite visualizar los productos de una empresa y así mismo ingresar nuevos productos al sistema toda esta información es almacenada en una base de datos. Esta aplicación se llevo a cabo gracias a las herramientas de AWS y el uso de contedores en Docker. 

# ENLACE A IMAGENES DOCKER EN DOCKER HUB
https://cloud.docker.com/repository/docker/romeo123axpuac/fase1

# ERRORES

Uno de los errores que se encuentro al momento de desarrolar la api de la aplicación, es que el modulo de node para mysql solo soporta una conexion simultanea, por lo que para la primera consulta funciona bien, pero si se quiere hacer otra, entoces lanza una excepcion, para resolverlo se debe abrir la conexion solo una vez, y reutilizarla en toda la api, sin cerrarla en ningun momento.
