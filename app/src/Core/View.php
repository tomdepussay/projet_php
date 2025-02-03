<?php

namespace App\Core;

use App\Core\Auth;

class View
{
    private string $v;
    private string $t;
    private array $data=[];

    public function __construct(string $v, string $t = "templates/front"){
        $this->v = __DIR__ . "/../Views/" . $v . ".php";
        $this->t = __DIR__ . "/../Views/" . $t . ".php";
    }

    public function addData(string $key, $value):void
    {
        $this->data[$key]=$value;
    }

    public function __destruct(){
        extract($this->data);
        $auth = new Auth();
        include $this->t;
    }
}