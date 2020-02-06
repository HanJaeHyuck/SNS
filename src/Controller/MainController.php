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

            // $user = $_SESSION['user'];
            $page = isset($_GET['p']) && is_numeric($_GET['p']) ? $_GET['p'] : 1;
            $start = ($page - 1) * 5; 
            $sql = "SELECT * FROM sns_boards"; //LIMIT 기본 정렬은 asc 오름차순인데 0개서 부터 5개 가져온다.
            $list = DB::fetchAll($sql);
            
            foreach($list as $item) {
                $sql = "SELECT * FROM sns_comments WHERE bidx = ?";
                $item->comments = DB::fetchAll($sql, [$item->board_idx]);
            }

            
            // $sql = "SELECT count(*) AS cnt FROM sns_boards WHERE writer = ? AND date >= NOW()";

            // $cnt = DB::fetch($sql);
            // $cnt = $cnt->cnt;

            // if(ceil($cnt / 5) > $page) {
            //     $next = true;
            // }
            // if($page != 1) {
            //     $prev = true;
            // }
        

		return view("view", ['list' => $list, 'cnt' => $cnt, 'prev' => $prev, 'next' => $next, 'p' => $page]);
	}
	
	function write() 
    {
        if(!isset($_SESSION['user'])){
            move("/","로그인을 먼저 해주세요.");
        } else {
            view("write");
        }
	}
	
    public function register() 
    {
		
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

        if(DB::fetch("SELECT * FROM sns_users WHERE id  = ? ", [$userid])) {
            back("이미 사용중인 아이디 입니다.");
        }

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
        $result = DB::execute($sql, [$userid, $password, $username, $date, $gender, 1]);
        if(!$result) {
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

    public function mypage()
    {
        return view("mypage");
    }

    public function find() 
    {
        return view("find");
    }

    public function logout()
    {
        unset($_SESSION['user']);
        move("/", "로그아웃 완료");
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
		$result = DB::execute($sql, [$title, $content, $user->name]);

		if(!$result) {
			back("데이터베이스 입력중 오류 발생");
			
		} else {
			move("/view", "성공적으로 글 작성");
        }
    }
    
    public function commentProcess()
    {
        $user = $_SESSION['user'];
        $user_idx = $user->idx;
        $board_idx = $_POST['board_id'];
        $content = $_POST['comment'];
        $writer = $user->name;   

        if(!isset($_SESSION['user'])) {
            move("/", "로그인을 하고 이용해 주세요.");
        }
        if($content == "") {
            back("댓글의 내용은 공백이 될 수 없습니다.");
        }


        $sql = "INSERT INTO sns_comments (`uidx`, `bidx`, `content`,`writer`, `date`) VALUES(?, ?, ?, ?,now())";
        $result = DB::execute($sql, [$user_idx, $board_idx, $content, $writer]);

        if(!$result) {
            back("데이터베이스 입력중 오류 발생");
        }
    }

    public function likeProcess()
    {
        $user = $_SESSION['user'];
        $user_idx = $user->idx;
        $board_idx = $_POST['board_id'];

        if(!isset($user)) {
            return;
        }

        // move("/", "123213213");

        if(DB::fetch("SELECT * FROM sns_likes WHERE uidx = ? and bidx = ?", [$user_idx, $board_idx])) {
            back("이미 좋아요를 누르셧습니다");
            return;
        }
    
        $sql = "INSERT INTO sns_likes(`uidx`, `bidx`) VALUES(?, ?)";
        $result = DB::execute($sql, [$user_idx, $board_idx]);
        if(!$result) {
            back("데이터베이스 입력중 오류 발생");
        }
        $sql = "UPDATE sns_boards SET likes = likes + 1 WHERE board_idx = ?";
        $result = DB::execute($sql, [$board_idx]);

        if(!$result) {
            back("데이터베이스 입력중 오류 발생");
        }
    }

    public function deleteProcess()
    {
        $user = $_SESSION['user'];
        $name = $user->name;
        $id = $_GET['id'];

        $board_sql ="DELETE FROM sns_boards WHERE writer = ? and board_idx = ?";
        $comment_sql ="DELETE FROM sns_comments WHERE bidx = ?";
        $like_sql = "DELETE FROM sns_likes WHERE bidx = ?";

        $result1 = DB::execute($board_sql, [$name, $id]);
        $result2 = DB::execute($comment_sql [$id]);
        $result3 = DB::execute($like_sql, [$id]);

        if(!$result1 || !$result2 || !$result3) {
            back("데이터베이스 입력중 오류 발생");
        } else {
            move("/view", "성공적으로 글 삭제 완료");
        }

        
        // $result = DB
    }

    public function modify()
    {
        $id = $_GET['id'];

        $sql = "SELECT * FROM sns_boards WHERE board_idx = ?";
        $result = DB::fetch($sql, [$id]);

        view("/modify",  ['list' => $result]);
    }

    public function modifyProcess()
    {
        $idx = $_POST['idx'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        $sql = "UPDATE sns_boards SET title = ? , content = ? WHERE board_idx = ?";
        $result = DB::execute($sql, [$title, $content, $idx]);

        if(!$result) {
            back("데이터베이서 입력중 오류 발생");
        } else {
            move("/view", "성공적으로 글 수정 완료");
        }
    }
}
?>