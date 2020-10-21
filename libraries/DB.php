<?php
class DB{
    //PROPIEDADES
    private static $conexion=null; //contendra la conexion con BDD
    
    //METODOS
    //Metodo que conecta/recupera la conexion con la BDD
    public static function get():mysqli{
        if(!self::$conexion){ //si no estabamos conectados...
            //conecta a la bdd
            self::$conexion=@new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
            
            if(self::$conexion->connect_errno) //si se produce un error
                throw new Exception('Error al conectar con la BDD');
            
            self::$conexion->set_charset(DB_CHARSET); //charset
        }
        return self::$conexion; //retorna la conexion
    }
    
    //metodo para realizar consultas SELECT de una fila
    public static function select(string $consulta, string $class='stdClass'){
        $resultado = self::get()->query($consulta);
        $objeto = $resultado->fetch_object($class);
        $resultado->free();
        return $objeto;
    }

    /*public static function select(string $consulta, string $class='stdClass'){
        $expresion = self::get()->stmt_init();
        $expresion -> prepare($consulta);
        $expresion->bind_param("s",$nick);
        $resultado = $expresion->get_result();
        $objeto = $resultado->fetch_object($class);
        $resultado->free();
        return $objeto;
    }*/
    
    //metodo para realizar consultas SELECT de múltiples filas
    public static function selectAll(string $consulta, string $class='stdClass'):array{
        $resultados = self::get()->query($consulta);
        $objetos = [];
        
        while($r=$resultados->fetch_object($class))
            $objetos[]=$r;
        
        $resultados->free();
        return $objetos;
    }
    
    //Metodo para realizar consultas INSERT
    //retorna el valor del ID autonumerico o false en caso de error
    public static function insert($consulta){
        return self::get()->query($consulta)? self::get()->insert_id : false;
    }
    //Metodo para realizar consultas de UPDATE
    //retorna el numero de filas afectadas o false en caso de error
    public static function update($consulta){
        return self::get()->query($consulta)? self::get()->affected_rows : false;
    }
    //Metodo para realizar consultas de DELETE
    //retorna el numero de filas afectadas o false en caso de error
    public static function delete($consulta){
        return self::get()->query($consulta)? self::get()->affected_rows : false;
    }
}
