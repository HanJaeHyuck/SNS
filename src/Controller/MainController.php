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

	public function view() 
	{
		$list = [];
        $cnt = 0;
        $prev = false;
        $next = false;
        $page = 0;
        if(isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            $page = isset($_GET['p']) && is_numeric($_GET['p']) ? $_GET['p'] : 1;
            $start = ($page - 1) * 5; 
            $sql = "SELECT * FROM sns_boards"; //LIMIT 기본 정렬은 asc 오름차순인데 0개서 부터 5개 가져온다.
            $list = DB::fetchAll($sql, [$_SESSION['user']->id]);

            $sql = "SELECT count(*) AS cnt FROM sns_boards WHERE writer = ? AND date >= NOW()";

            $cnt = DB::fetch($sql, [$user->id]);
            $cnt = $cnt->cnt;

            if(ceil($cnt / 5) > $page) {
                $next = true;
            }
            if($page != 1) {
                $prev = true;
            }
        }

		return view("view", ['list' => $list, 'cnt' => $cnt, 'prev' => $prev, 'next' => $next, 'p' => $page]);
	}
	
	function write() 
    {
        return view("write");
	}
	
	public function register() {
		
        return view("register");
    }

    public function registerProcess() 
    {
        $userid = $_POST['userid'];
        $password = $_POST['password'];
        $passwordc = $_POST['passwordc'];
        $username = $_POST['username'];
        $date = $_POST['date'];
        $gender = $_POST['gender']; 
        
        $condition = " A-Za-z0-9!#$%^&*()ㄱ-ㅎㅏ-ㅣ가-힣";

        if($userid == "" || $password == "" || $passwordc == "" || $username == ""  || $gender == "" || $date == "" || $gender == "") {
            back("필수값은 공백이 될 수 없습니다.");
        }

        if(!preg_match("/^[$condition]([\-.\w]*[$condition])*@([0-9a-zA-Z][\-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9}$/", $userid)){
            back("아이디의 규정을 지켜주세용");            
        }
        if($password != $passwordc) {
            back("비밀번와 비밀번호 재확인이 다릅니다.");
        }

        if(!preg_match("/^(19[0-9][0-9]|20\d{2})(0[0-9]|1[0-2])(0[1-9]|[1-2][0-9]|3[0-1])$/", $date)) {
            back("올바른 생년월일을 입력 해주세요.");
        }

        $sql = "INSERT INTO sns_users (`id`, `password`, `name`, `date of birth`, `gender`, `level`) VALUES (?, PASSWORD(?), ?, ?, ?, ?)";
        $reslut = DB::execute($sql, [$userid, $password, $username, $date, $gender, 1]);
        if(!$reslut) {
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
        return move("/view", "로그인 완료!!");
    }

    public function find() 
    {
        return view("find");
    }

    public function logout()
    {
        unset($_SESSION['user']);
        back("로그아웃 완료");
	}

	public function writeProcess()
	{
		$title = $_POST['title'];
		$content = $_POST['content'];

		if($title == "" || $content == "") {
			back("제목과 내용은 공백이 될 수 없습니다.");
		}

		$user = $_SESSION['user'];

		$sql = "INSERT INTO sns_boards (`title`, `content`, `writer`, `date`) VALUES(?, ?, ?, now())";
		$reslut = DB::execute($sql, [$title, $content, $user->name]);

		if(!$reslut) {
			back("데이터베이스 입력중 오류 발생");
			
		} else {
			move("/view", "성공적으로 글 작성");
		}
	}

	

}
?>