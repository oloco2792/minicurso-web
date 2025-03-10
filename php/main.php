<!--
Aqui van cosas esenciales como la conexion a la base de datos
Envios de fomularios,
formas de evitar inyeccionSQL, etc
-->
<?php
//SINTAXIS PDO PARA LA CONEXION CON LA BASE DE DATOS
function conexion(){
    $pdo = new PDO('mysql:host=localhost;
                dbname=basededatos','root','root1234');
    return $pdo;
}

//Podemos usar esta variable para realizar para cualquier peticion a la base de datos

//$pdo->query("INSERT INTO categoria(categoria_nombre, categoria_ubicacion) VALUES('prueba', 'texto ubicacion')");
//Con Eso puedes añadir una nueva fila

//SINTAXIS PARA VERIFICAR DATOS

//preg_match es una funcion para expresiones regulares que permite buscar coincidencias dentro de un array.
//preg_mat(patron, input).
//patron es la expresion regular que usaremos como referencia para buscar las coincidencias
//input es el string donde bsucaremos dicha coincidencia
//Si se haya una coincidencia, retornara 1. Sino, retornara 0

//¿Por que primero el false y despues el true?
//Si retorna false indica que no hay error en la verificacion{
//Si retorna true, signifca que si hay error en la verificacion
function verificar_datos($filtro, $cadena){
    if(preg_match("/*".$filtro."$/", $cadena)){
        return false;
    }else{
        return true;
    }
}

//ejemplo del PREG_MATCH()

/*$nombre="Carlos";

if(verificar_datos("[a-zA-Z]{6,10},",$nombre)){
    echo "Los datos no coinciden";
}*/

//SINTAXIS PARA EVITAR LA INYECCION SQL
function limpiar_cadena($cadena){
    $cadena = trim($cadena);//trim quita los espacios al inicio y final de la cadena
    $cadena = stripslashes($cadena);//stripslashes quita las barras del string con comillas escapadas
    $cadena = str_ireplace($cadena);
}





?>

