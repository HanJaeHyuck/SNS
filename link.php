<?php
use src\App\Route;

// index page
Route::GET("/", "MainController@index");

Route::POST("/", "UserController@loginProcess");

//회원가입 페이지 이동
Route::GET("/register", "UserController@register");

//회원가입 하기
Route::POST("/register", "UserController@registerProcess");

//아이디 비밀번호 찾기 이동
Route::GET("/find", "UserController@find");

Route::init();
?>

