<?php
class Autoloader {
    static public function loader($className) {
        $filename = dirname(__FILE__) . "/" . strtolower(str_replace('\\', '/', $className)) . ".class.php";
        if (file_exists($filename)) {
            include($filename);
            if (class_exists($className)) {
                return TRUE;
            }
        }
        $filename = dirname(__FILE__) . "/" . str_replace('\\', '/', $className) . ".php";
        if (file_exists($filename)) {
            include($filename);
            if (class_exists($className)) {
                return TRUE;
            }
        }
        return FALSE;
    }
}
spl_autoload_register('Autoloader::loader');

?>
