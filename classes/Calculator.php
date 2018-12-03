<?php

class Calculator{

    //properties
    public $hello = "Hello World";
    private $password = "123456";
    public $title = "Calculator";
    //methods
    public function __construct(){
        echo "Hello World";
    }

    public function calculate($num1, $num2, $operator){
        if($operator == "+"){
            return $num1 + $num2 . "<br>" . $this->helloworld();
        }
        elseif($operator == "-"){
            return $num1 - $num2;
        }
        elseif($operator == "*"){
            return $num1 * $num2;
        }
        elseif($operator == "/"){
            return $num1 / $num2;
        }
    }

    public function thisIsMyHelloWorldCode(){
        return "Hello World";
    }
}