<?php
class Soci{
    //PROPIETATS
    public $id=0, $nick='', $pass='', $rang=1, $saldo=200;
    
    //METODES
    //recuperar els socis
    public static function get():array{
        $consulta = "SELECT * FROM socis ORDER BY saldo DESC";
        return DB::selectAll($consulta, self::class);
    }
    
    //recuperar un soci concret per id
    public static function getSoci(int $id):?Soci{
        $consulta = "SELECT * FROM socis WHERE id=$id";
        return DB::select($consulta, self::class);
    }
    
    //recupera un soci a partir del nick
    public static function getSocinick(string $nick):?Soci{
        $consulta = "SELECT * FROM socis WHERE nick='$nick'";
        return DB::select($consulta, self::class);
    }

    /*public static function getSocinick(string $nick):?Soci{
        $consulta = "SELECT * FROM socis WHERE nick=?";
        return DB::select($consulta, self::class);
    }*/
    
    
    public function guardar(){
        $consulta = "INSERT INTO socis(nick,pass,rang,saldo)
                    VALUES('$this->nick','$this->pass',$this->rang,$this->saldo)";
        return DB::insert($consulta);
    }
    
    public function borrar(int $id){
        $consulta = "DELETE FROM socis WHERE id=$id";
        return DB::delete($consulta);
    }
    
    public function actualitzar(){
        //prepara consulta
        $consulta="UPDATE socis SET
                        nick='$this->nick',
                        pass='$this->pass',
                        rang=$this->rang,
                        saldo=$this->saldo
                    WHERE id=$this->id";
        return DB::update($consulta);
                        
    }

    public function actualitzarSaldo($nick,$saldo){
        $consulta="UPDATE socis SET
                        saldo=$this->saldo
                    WHERE id=$this->id";
        return DB::update($consulta);
    }
    
    public function __toString():string{
        return "$this->id $this->nick $this->pass $this->rang $this->saldo";
    }
}