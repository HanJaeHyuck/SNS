<?php
use src\App\Route;

// index page
Route::GET("/", "MainController@index");

Route::POST("/", "MainController@loginProcess");

//회원가입 페이지 이동
Route::GET("/register", "MainController@register");

//회원가입 하기
Route::POST("/register", "MainController@registerProcess");

//아이디 비밀번호 찾기 이동
Route::GET("/find", "MainController@find");

//에러 페이지 이동
Route::GET("/error", "MainController@error");

//로그 아웃
Route::GET("/user/logout", "MainController@logout");

//뷰 페이지 이동
Route::GET("/view", "MainController@view");

//글쓰기 페이지 이동
Route::GET("/write", "MainController@write");

//글쓰기 
Route::POST("/write", "MainController@writeProcess");

//댓글쓰기
Route::POST("/comment", "MainController@commentProcess");


Route::init();
?>

