<?php
namespace src\Controller;

use src\App\DB;

class MainController {
	public function index() {
		return view("index");
	}

	public function error()
	{
		return view("error");
	}
}
?>