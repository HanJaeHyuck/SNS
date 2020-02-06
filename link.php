<?php
use src\App\Route;

// index page
Route::GET("/", "MainController@index");

Route::POST("/", "MainController@loginProcess");

//회원가입 페이지 이동
Route::GET("/register", "MainController@register");

//회원가입 하기
Route::POST("/register", "MainController@registerProcess");

Route::GET("/mypage", "MainController@mypage");

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

//좋아요 누르기
Route::POST('/like', "MainController@likeProcess");

//게시물 삭제
Route::GET('/delete', "MainController@deleteProcess");

//수정페이지 이동
Route::GET('/modify' , "MainController@modify");

//게시물 수정
Route::POST('/modify' , "MainController@modifyProcess");


Route::init();
?>

