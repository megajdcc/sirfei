<?php  

class Conexion extends \PDO{

      private $file,$conec;

      private $driver,$port,$host,$dbname,$usuario,$contrasena;
      private $idconexion;
      private $dsn;
      private $pdo;
      private function cargar_dsn(){

        $this->driver = $this->conec['sirfei']['driver'];
        $this->host = $this->conec['sirfei']['host'];
        (!empty($this->conec['sirfei']['port'])) ? $this->port = $this->conec['sirfei']['port'] : $this->port = '3306';
        $this->dbname = $this->conec['sirfei']['dbname'];
        $caracter = $this->conec['sirfei']['charset'];
        $this->dsn =  $this->driver . ':host='.$this->host.';port='.$this->port.';dbname='.$this->dbname; 
      }
      private function cargar_usuario(){
        $this->usuario = $this->conec['sirfei']['usuario'];
        $this->contrasena = $this->conec['sirfei']['contrasena'];
      }
      /**
       * [Conectar description]
       *  este metodo se utiliza para conectarse a la base de dato... 
       */
      protected function Conectar(){
           try {
         
                parent::__construct($this->dsn,$this->usuario,$this->contrasena);
                parent::setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                
            }catch (PDOException $e) {
                  die("ERROR DE CONEXION " . $e->getMessage());
            }
      }
          
      /**
       * [__construct primera accion a tomar conectarse y seleccion de bd...]
       */
      public function __construct($file = 'config.ini'){
            $this->file = $file;
            // echo "conexion extosa";
            if(!$this->conec = parse_ini_file($file, TRUE)) throw new Exception("No se pudo abrir".$file.'.');
        
            $this->cargar_dsn();
            $this->cargar_usuario();
            $this->Conectar();    

      }
}
?>
