<?php
namespace src\Controller;

use src\App\DB;

class TodoController {
    
    function write() 
    {
        return view("/write");
    }
}