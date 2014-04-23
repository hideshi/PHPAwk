<?php
require 'phpawk.php';
class AwkSample01 extends Base {
    public function begin() {
        echo "begin\n";
        $this->var1 = 'var1';
        var_dump($this->S);
    }

    public function action1() {
        echo "action1\n";
        echo $this->var1."\n";
        var_dump($this->S);
    }

    public function action2() {
        echo "action2\n";
        $this->var2 = 'var2';
        var_dump($this->S);
    }

    public function end() {
        echo "end\n";
        echo $this->var2."\n";
        var_dump($this->S);
    }
}
AwkSample01::run($argv);
?>
