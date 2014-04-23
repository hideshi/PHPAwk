<?php
class Base {
    protected $FS = ',';
    protected $S = array();
    public static function run($argv) {
        $clazz = new ReflectionClass(get_called_class());
        $object = $clazz->newInstanceWithoutConstructor();
        $methods = $clazz->getMethods();
        $count = count($methods);
        for($i = 0; $i < $count; $i++) {
            if(preg_match("/begin/", $methods[$i])) {
                $methods[$i]->invoke($object);
            }
        }
        $file_handle = fopen($argv[1], "r");
        if(!$file_handle) die("Can't open file.\n");
        while (!feof($file_handle)) {
            $line = fgets($file_handle);
            if($line) {
                $object->S = explode($object->FS, $line);
                array_unshift($object->S, $line);
                for($i = 0; $i < $count; $i++) {
                    if(preg_match("/act/", $methods[$i])) {
                        $methods[$i]->invoke($object);
                    }
                }
            }
        }
        fclose($file_handle);
        $object->S = array();
        for($i = 0; $i < $count; $i++) {
            if(preg_match("/end/", $methods[$i])) {
                $methods[$i]->invoke($object);
            }
        }
    }
}
?>
