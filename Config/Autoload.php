<?php

class Autoload
{
    private static $_instance = null;

    //Singleton __construct method
    public static function load()
    {
        if(null !== self::$_instance) {
            throw new RuntimeException(sprintf('%s is already started', __CLASS__));
        }

        self::$_instance = new self();

        if(!spl_autoload_register(array(self::$_instance, '_autoload'), false)) {
            throw RuntimeException(sprintf('%s : Could not start the autoload', __CLASS__));
        }
    }

    //Shutdown autoload method
    public static function shutDown()
    {
        if(null !== self::$_instance) {

            if(!spl_autoload_unregister(array(self::$_instance, '_autoload'))) {
                throw new RuntimeException('Could not stop the autoload');
            }

            self::$_instance = null;
        }
    }

    //Autoload files method
    private static function _autoload($class)
    {
        global $rep;
        $filename = $class.'.php';
        $dir =array('Model/','./','Config/','Controller/','DAL/');

        foreach ($dir as $d){
            $file=$rep.$d.$filename;
            if (file_exists($file))
                include $file;
        }
    }
}


?>
