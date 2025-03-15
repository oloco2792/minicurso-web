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
    //str_ireplace reemplaza el texto mediante una bisqueda (?) pero esta version es insensible a mayusculas (chequear documentacion)
    //Sintaxix: str_ireplace("paraCambiar", "porLoQueSeCambiara", "enDondeSeBuscara") [ojala y se entienda]
    //Con esto eliminamos cualquier input de codigo que pueda inteferir con el programa de forma no deseada
    $cadena = str_ireplace("<script>", "", $cadena);
    $cadena = str_ireplace("</script>", "", $cadena);
    $cadena = str_ireplace("</script>", "", $cadena);
    $cadena = str_ireplace("<script src", "", $cadena);
    $cadena = str_ireplace("<script type=", "", $cadena);
    $cadena = str_ireplace("SELECT * FROM", "", $cadena);
    $cadena = str_ireplace("DELETE FROM", "", $cadena);
    $cadena = str_ireplace("INSERT INTO", "", $cadena);
    $cadena = str_ireplace("DROP TABLE", "", $cadena);
    $cadena = str_ireplace("DROP DATABASE", "", $cadena);
    $cadena = str_ireplace("TRUNCATE TABLE", "", $cadena);
    $cadena = str_ireplace("SHOW TABLES;", "", $cadena);
    $cadena = str_ireplace("SHOW DATABASE;", "", $cadena);
    $cadena = str_ireplace("SHOW DATABASE;", "", $cadena);
    $cadena = str_ireplace("<?php", "", $cadena);
    $cadena = str_ireplace("?>", "", $cadena);
    $cadena = str_ireplace("--", "", $cadena);
    $cadena = str_ireplace("^", "", $cadena);
    $cadena = str_ireplace("<", "", $cadena);
    $cadena = trim($cadena);
    $cadena = stripslashes($cadena);

    return $cadena;
}

//FUNCION PARA RENOMBRAR FOTOS
//Elimina cualquier separador que pueda usarse cuando el usuario suba una foto. 
//Ademas coloca al final un numero aleatorio para evitar conflicto en caso de subir mas veces la misma foto
function renombrar_fotos($nombre){
    $nombre = str_ireplace(" ", "_", $nombre);
    $nombre = str_ireplace("/", "_", $nombre);
    $nombre = str_ireplace("#", "_", $nombre);
    $nombre = str_ireplace("-", "_", $nombre);
    $nombre = str_ireplace("$", "_", $nombre);
    $nombre = str_ireplace(".", "_", $nombre);
    $nombre = str_ireplace(",", "_", $nombre);
    $nombre = $nombre."_".rand(0,100);

    return $nombre;
}

//FUNCION PARA UN PAGINADOR DE TABLAS

function paginador_tablas($pagina, $Npaginas, $url, $botones){
    $tabla='<nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">';

        if($pagina<=1){
            $tabla.='
            <a class="pagination-previous id-disabled" disabled>Anterior</a>
            <ul class="pagination-list">
            ';
        }else{
            $tabla.='
            <a class="pagination-previous" href="'.$url.($pagina-1).
            '">Anterior</a>
            <ul class="pagination-list">
                <li><a class="pagination-link" href="'.$url.'1">1</a></li>
                <li><span class="pagination-ellipsis">&hellip;</span></li>
            ';
        }

        $ci=0;

        for($i=$pagina; $i<=$Npaginas; $i++){
            if($ci>=$botones){
                break;
            }
            if($pagina==$i){
                $tabla.='
                    <li><a class="pagination-link is-current" href="'.$url.$i.'">'.$i.'</a></li>
                    ';
            }else{
                $tabla.='
                    <li><a class="pagination-link" href="'.$url.$i.'">'.$i.'</a></li>
                    ';
            }

            $ci++;
        }

        if($pagina==$Npaginas){
            $tabla.='

            </ul>
            <a class="pagination-next is-disabled" disabled >Siguiente</a>
            ';
        }else{
            $tabla.='
                <li><span class="pagination-ellipsis">&hellip;</span></li>
                <li><a class="pagination-link" href="'.$url.$Npaginas.'">'.$Npaginas
                '</a></li>
            </ul>
            <a class="pagination-next" href="'.$url.($pagina+1).
            '">Siguiente</a>
            ';
        }

    $tabla='</nav>'

    return $tabla;
}
?>