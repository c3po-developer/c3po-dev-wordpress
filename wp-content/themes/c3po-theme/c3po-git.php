#!/usr/bin/php -q
<?php 
 
/**
 * C3PO WordPress git
 *   
 * c3po@web-server:/var/www/html$ : php c3po-git.php
 * 
 */

/**
 * Elimina todos los errores de php si viene acompañado del argumento -d --debug despues del nombre del fichero
 */
$error_level = 0;
 
if( isset( $argv[1] ) ) { 

    if ( $argv[1] === '-d' || $argv[1] === '--debug' ){

        $error_level = 1;

    }

}

error_reporting( $error_level );

ini_set('display_errors', $error_level );
 
/**
 * Mensaje de inicio
 */
Bash::write( '********************************************************************************' . PHP_EOL, 0); 
Bash::write( Bash::getColoredString( 'C3PO', 'white' ) ." git - v. 1.0\n" );  
Bash::write( '********************************************************************************' . PHP_EOL, 0);  
Bash::write( Bash::getColoredString( "En caso de no existir cambios, presionar CTRL + C para salir del proceso. \n", 'dark_gray' )  ); 

$credentials = get_credentials_wp_config();

Bash::write( "\nDescargando base de datos..." ); 

dump( $credentials['db_name'],  $credentials['db_name'] . '_git.sql', $credentials );

Bash::write( Bash::getColoredString( " [success]\n", 'green' ) ); 
 
Bash::write( "\nCambios del repositorio... \n" ); 
 
$proc = popen('git status -s', 'r');
 
while (!feof($proc))
{
    echo fread($proc, 4096);
    @ flush();
}
 
$baseDirName    = basename( dirname( __FILE__ ) );
 
$commit         = Bash::read( " \nCommit: ");   
 
if( $commit == '' ) die( "El mensaje de commit no puede estar vacío.\n" );

exec ( 'git add --all' );
 
exec ( "git commit -m '" . $commit . "'" );
   
exec ( "git push origin master" );
   
/**
 * Clase statica para uso del bash en terminal
 */
Class Bash {
  
    public static function write( $line, $delay = 0 )
    {

        echo $line;
  
    }

    public static function read(  $prompt = '' )
    {
        
        echo $prompt;

        return rtrim( fgets( STDIN ), "\n" );

    }

    static $foreground_colors = array(
        'black'        => '0;30', 'dark_gray'    => '1;30',
        'blue'         => '0;34', 'light_blue'   => '1;34',
        'green'        => '0;32', 'light_green'  => '1;32',
        'cyan'         => '0;36', 'light_cyan'   => '1;36',
        'red'          => '0;31', 'light_red'    => '1;31',
        'purple'       => '0;35', 'light_purple' => '1;35',
        'brown'        => '0;33', 'yellow'	     => '1;33',
        'light_gray'   => '0;37', 'white'        => '1;37',
    );

    static $background_colors = array(
            'black'        => '40', 'red'          => '41',
            'green'        => '42', 'yellow'       => '43',
            'blue'         => '44', 'magenta'      => '45',
            'cyan'         => '46', 'light_gray'   => '47',
    );

    // Returns colored string
    public static function getColoredString($string, $foreground_color = null, $background_color = null) {
        $colored_string = "";

        // Check if given foreground color found
        if ( isset(self::$foreground_colors[$foreground_color]) ) {
                $colored_string .= "\033[" . self::$foreground_colors[$foreground_color] . "m";
        }
        // Check if given background color found
        if ( isset(self::$background_colors[$background_color]) ) {
                $colored_string .= "\033[" . self::$background_colors[$background_color] . "m";
        }

        // Add string and end coloring
        $colored_string .=  $string . "\033[0m";

        return $colored_string;
        
    }

    // Returns all foreground color names
    public static function getForegroundColors() {
            return array_keys(self::$foreground_colors);
    }

    // Returns all background color names
    public static function getBackgroundColors() {
            return array_keys(self::$background_colors);
    }

}

/**
 * Clase estatica para conexiones con bases de datos mySql 
 */
class Database
{
  /**
   * Objeto con la conexión PDO
   *
   * @var     array $__obj_connection 
   */
  static private $__obj_connection = null; 
  /**
   * Instanciá Singleton de la clase
   *
   * @var     PDO $__obj_instance
   */
  static private $__obj_instance = null;
  /**
   * Constructor
   */
  final private function __contruct()
  { 
  } 
  /**
   * Evita la clonación de un objeto de esta clase. 
   */
  final public function __clone()
  { 
    trigger_error( "You can not clone an instance of ". get_class($this) ." class.", E_USER_ERROR ); 
  }
  /**
   * Evita dormir/despertar de un objeto de esta clase. 
   */
  final public function __wakeup()  
  { 
    trigger_error( "You can not deserialize an instance of ". get_class($this) ." class.", E_USER_ERROR ); 
  }
  /**
   * Establece las credenciales de conexión a un objeto
   * estatico de la propia instancia de la clase.
   *
   * @param   array $__obj_connection: Arreglo asociativo 
   *  con los registros necesarios para establecer una 
   *  conexión mysql.
   * 
   *  $__obj_connection = array (
   *   'host'      => 'localhost',
   *   'port'      => '3306',
   *   'user'      => 'web',
   *   'password'  => 'usalafuerza',
   *   'db_name'   => 'soleil_cms',
   *   'charset'   => 'UTF-8',
   *  ); 
   */
  final public static function connect( $__obj_connection )
  {
    if( is_array ( $__obj_connection ) ){ 
      self::$__obj_connection = $__obj_connection;
      return true;
    }
    return false;
  }
  /**
   * Realiza una consulta SQL a la base de datos.
   * 
   * La consulta puede ser lanzada como una sentencia simple 
   * o utilizar el segundo parametro como colección asociativa 
   * de parametro => valor en el uso más estricto de PDO.
   * 
   * @param   string $__str_sql: Sentencia a consultar por la base de datos.
   * @param   array $_obj_values: Arreglo o colección con los parametros y valores para la consulta.
   * @return  array Arreglo o colección con los resultados de la consulta.
   */
  final public static function query( $__str_sql, $_obj_values = array () )
  {  
      $__obj_db   = self::getPDOInstance();
      $__obj_stmt = $__obj_db->prepare( $__str_sql );
      $__obj_stmt->execute( $_obj_values );
      return array (
          'result'    => $__obj_stmt->fetchAll( PDO::FETCH_ASSOC ),
          'row'       => $__obj_stmt->rowCount(),
          'last_id'   => $__obj_db->lastInsertId()
      );
      
  } 
  /**
   * Devuelve las credenciales de conexión.
   * 
   * @return  array self::$__obj_connection: Arreglo con las credenciales de conexión.
   */
  final public static function getConnection()
  {
    return self::$__obj_connection;
  }      
 
  /**
   * Implementa una instancia privada de la clase 
   * 
   * Comprueba si ya existe o no la instancia de la clase. 
   * En caso de no existir crea la misma, estableciendo los parametros 
   * necesarios para una nueva conexión con la base de datos. 
   * En caso contrario devuelve el objeto estatico ya en uso. 
   */
  final private static function getPDOInstance()  
  { 
    
		if( empty ( self::$__obj_instance ) ) { 
			try {  
				self::$__obj_instance = new PDO(
          "mysql:host=".self::$__obj_connection['host'].
          ';port='.self::$__obj_connection['port'].
          ';dbname='.self::$__obj_connection['db_name'], 
          self::$__obj_connection['user'], 
          self::$__obj_connection['password']
        ); 
        self::$__obj_instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);    
        self::$__obj_instance->query('SET NAMES utf8');        
        self::$__obj_instance->query('SET CHARACTER SET utf8');       
			} catch( exception $e ) {
        print_r($e);     
      }      
    }
    
    return self::$__obj_instance;
    
  }
}

/**
 * Examina el fichero wp-config.php en busqueda de las credenciales de la base de datos
 */
function get_credentials_wp_config(){

    // Busca las credenciales en el fichero wp-config.php
    $pattern = '/\\bdefine\\(\\s*("(?:[^"\\\\]+|\\\\(?:\\\\\\\\)*.)*"|\'(?:[^\'\\\\]+|\\\\(?:\\\\\\\\)*.)*\')\\s*,\\s*("(?:[^"\\\\]+|\\\\(?:\\\\\\\\)*.)*"|\'(?:[^\'\\\\]+|\\\\(?:\\\\\\\\)*.)*\')\\s*\\);/is';
                    
    $str = file_get_contents('wp-config.php');
    
    preg_match_all( $pattern, $str, $matches, PREG_SET_ORDER );

    $dbName = '';

    $dbUser = '';

    $dbPassword = '';

    $dbHost = '';

    foreach( $matches as $i => $match ){
        
        if ( $matches[$i][1] == "'DB_NAME'" ) $dbName = str_replace('\'', '', $matches[$i][2] );
    
        if ( $matches[$i][1] == "'DB_USER'" ) $dbUser = str_replace('\'', '', $matches[$i][2] );
    
        if ( $matches[$i][1] == "'DB_PASSWORD'" ) $dbPassword = str_replace('\'', '', $matches[$i][2] );
    
        if ( $matches[$i][1] == "'DB_HOST'" ) $dbHost = str_replace('\'', '', $matches[$i][2] );

    }  

    return array ( 
        'db_name'       => $dbName,
        'db_user'       => $dbUser,
        'db_password'   => $dbPassword,
        'db_host'       => $dbHost,
    );

}

function dump( $db, $db_dump_name, $credentials = '')
{
    //ENTER THE RELEVANT INFO BELOW
    $mysqlUserName      = $credentials['db_user'];
    $mysqlPassword      = $credentials['db_password'];
    $mysqlHostName      = $credentials['db_host'];
    $DbName             = $db;
    $backup_name        = $db_dump_name; 

    file_put_contents(  $backup_name, 
                        Export_Database( 
                            $mysqlHostName,
                            $mysqlUserName,
                            $mysqlPassword,
                            $DbName,  
                            $tables=false, 
                            $backup_name=false
                        )
    );

}

function Export_Database( $host,$user,$pass,$name,  $tables=false, $backup_name=false )
{
    $mysqli = new mysqli($host,$user,$pass,$name); 
    $mysqli->select_db($name); 
    $mysqli->query("SET NAMES 'utf8'");

    $queryTables    = $mysqli->query('SHOW TABLES'); 
    while($row = $queryTables->fetch_row()) 
    { 
        $target_tables[] = $row[0]; 
    }   
    if($tables !== false) 
    { 
        $target_tables = array_intersect( $target_tables, $tables); 
    }
    foreach($target_tables as $table)
    {
        $result         =   $mysqli->query('SELECT * FROM '.$table);  
        $fields_amount  =   $result->field_count;  
        $rows_num       =   $mysqli->affected_rows;     
        $res            =   $mysqli->query('SHOW CREATE TABLE '.$table); 
        $TableMLine     =   $res->fetch_row();
        $content        = (!isset($content) ?  '' : $content) . "\n\n".$TableMLine[1].";\n\n";

        for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) 
        {
            while($row = $result->fetch_row())  
            { //when started (and every after 100 command cycle):
                if ($st_counter%100 == 0 || $st_counter == 0 )  
                {
                        $content .= "\nINSERT INTO ".$table." VALUES";
                }
                $content .= "\n(";
                for($j=0; $j<$fields_amount; $j++)  
                { 
                    $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) ); 
                    if (isset($row[$j]))
                    {
                        $content .= '"'.$row[$j].'"' ; 
                    }
                    else 
                    {   
                        $content .= '""';
                    }     
                    if ($j<($fields_amount-1))
                    {
                            $content.= ',';
                    }      
                }
                $content .=")";
                
                if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) 
                {   
                    $content .= ";";
                } 
                else 
                {
                    $content .= ",";
                } 
                $st_counter=$st_counter+1;
            }
        } $content .="\n\n\n";
    }
    
 
    return $content; 
    exit;
}