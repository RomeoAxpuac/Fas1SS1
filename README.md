# FASE 1 SS1
UNIVERSIDAD DE SAN CARLOS DE GUATEMALA

FACULTAD DE INGENIERIA

SEMINARIO DE SISTEMAS 1

BAYRON ROMEO AXPUAC YOC 201314474

WILSON GUERRA 201314571

# ERRORES

Uno de los errores que se encuentro al momento de desarrolar la api de la aplicación, es que el modulo de node para mysql solo soporta una conexion simultanea, por lo que para la primera consulta funciona bien, pero si se quiere hacer otra, entoces lanza una excepcion, para resolverlo se debe abrir la conexion solo una vez, y reutilizarla en toda la api, sin cerrarla en ningun momento.
