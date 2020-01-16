<?php

namespace src\Controller;

use src\App\DB;

class UserController {
    
    public function register() {
        return view("register");
    }

    public function registerProcess() 
    {
        $userid = $_POST['userid'];
        $password = $_POST['password'];
        $passwordc = $_POST['passwordc'];
        $username = $_POST['username'];
        $year = $_POST['year'];
        $month = $_POST['month'];
        $day = $_POST['day'];
        $gender = $_POST['gender'];

        if($userid == "" || $password == "" || $passwordc == "" || $username == "" || $year == "" || $month == "" || $day == "" || $gender == "") {
            back("필수값은 공백이 될 수 없습니다.");
        }

        if($password != $passwordc) {
            back("비밀번와 비밀번호 재확인이 다릅니다.");
        }

        // if( 0 < (int)$year < 2020  ||  1 <(int)$day < 32) {
        //     back("생년월일을 똑바로 입력 해주시기 바랍니다.");
        // }

        $sql = "INSERT INTO sns_users (`id`, `password`, `name`, `level`) VALUES (?, PASSWORD(?), ?, ?)";
        $reslut = DB::execute($sql, [$userid, $password, $username, 1]);

        if($reslut != 1) {
            back("DB에 값이 올바르게 들어가지 않았습니다.");
        }

        return move("/", "회원가입 완료!!");

    }

    public function loginProcess()
    {
        $userid = $_POST['userid'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM sns_users WHERE id = ? AND password = PASSWORD(?)";
        $user = DB::fetch($sql, [$userid, $password]);
        if($user == null) {
            back("일치하는 회원이 없습니다.");
        }

        $_SESSION['user'] = $user;
        return move("/", "로그인 완료!!");
    }

    public function find() {
        return view("find");
    }
}