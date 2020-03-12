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
Bash::write( Bash::getColoredString( 'C3PO', 'white' ) ." ftp - v. 0.1\n" );  
Bash::write( '********************************************************************************' . PHP_EOL, 0);  
Bash::write( Bash::getColoredString( "En caso de no existir cambios, presionar CTRL + C para salir del proceso. \n", 'dark_gray' )  ); 

$ftp_server     = 'ftp.usalafuerza.com';

$ftp_user_name  = 'c3po-developer@usalafuerza.com';

$ftp_user_pass  = 'usalafuerza2020_';

// establecer una conexión básica
$conn_id = ftp_connect($ftp_server);

// iniciar sesión con nombre de usuario y contraseña
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

ftp_putAll($conn_id, dirname( __FILE__ ), '/wp-content/themes/c3po-theme-child');

// cerrar la conexión ftp
ftp_close($conn_id); 

function ftp_putAll($conn_id, $src_dir, $dst_dir) {

    $d = dir($src_dir);

    while($file = $d->read()) { 
        
        if ($file != "." && $file != "..") {  
               
            $directory_name = $src_dir . "/" . $file;
         
                if ( is_dir( $src_dir . "/" . $file ) ) {  
                    
                    if (!@ftp_chdir($conn_id, $dst_dir."/".$file)) {
                     
                        ftp_mkdir($conn_id, $dst_dir."/".$file); 

                        echo "Dir: " . $directory_name  . "\n";
    
                        ftp_putAll($conn_id, $src_dir."/".$file, $dst_dir."/".$file);  
                        
                    }
                    
                } else {

                    if( strpos( $file, 'grunt' ) === false ) {

                        $upload = ftp_put($conn_id, $dst_dir."/".$file, $src_dir."/".$file, FTP_BINARY);  

                        echo "File: " . $dst_dir."/".$file . "\n";

                    }

                }
 
            
        }

    }

    $d->close();

}
 
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

// EOF
