<?php
    function conectar(){
        #Conecxion a la Base de datos en el servidor local
/*
        $db_host="localhost";           //Nombre del Servidor
        $db_nombre_bd="osiris_manzana"; //Nombre de la base de datos
        $db_usuario="root";             //Usuario
        $db_contrasenia="";             //Clave*/

        #Conecxion a la Base de datos de mercados la manzana

        $db_host="localhost";           //Nombre del Servidor
        $db_nombre_bd="merca230_osiris_manzana"; //Nombre de la base de datos
        $db_usuario="merca230_admin";             //Usuario
        $db_contrasenia="GL03WBF8ETVU";             //Clave*/

        #Conecxion a la Base de datos de distribuidora tropial - carepa
/*
        $db_host="localhost";           //Nombre del Servidor
        $db_nombre_bd="merca230_osiris_manzana"; //Nombre de la base de datos
        $db_usuario="merca230_admin";             //Usuario
        $db_contrasenia="GL03WBF8ETVU";             //Clave*/

        $conexion = mysqli_connect($db_host, $db_usuario, $db_contrasenia) or die("Error en la conexión");

        //Error en el nombre del Servidor
        if(mysqli_connect_errno()){
            echo "Fallo al conectar con la BBDD";
            exit();
        }
        //Error en el nombre de la base de datos
        mysqli_select_db($conexion, $db_nombre_bd) or die("No se encontró la base de datos en el servidor");
        
        //incluya caracteres latinos
        //mysqli_set_charset($conexion,"uft8");   
        
        //Recordar cerrar la conexion al finalizar cada consulta
        //mysqli_close($conexion);
        return $conexion;
    }
?>