<?php
	session_start();
    include_once("conn.php");//链接数据库
	header("Content-Type:text/html;charset=utf8"); 
	$username = $_POST["phone"];
	$password = $_POST["password"];
	$code = $_POST["code"];//验证码

	function back() {
		echo <<< EOD
		<script type="text/javascript">
			setTimeout(function() {
				location.href = "../login.html";
			},3000);
		</script>
EOD;
		echo "3s后返回登录界面";
	}

	if(empty($username)) {
		echo "用户名不能为空";
		back();
		exit();
	}else if(empty($password)) {
		echo "密码不能为空";
		back();
		exit();
	}
	if(empty($code) || $code != $_SESSION["check_code_number"]) {
		echo "验证码不能为空或者验证码错误";
		back();
		exit();
	}

	// echo $username;
	// echo $password;
	//连接数据库

	$sql = "select * from user where `name` = '$username' and `pwd` = md5('$password')";
	// echo $sql;
	$result = mysql_query($sql);
	// echo mysql_num_rows($result);
	if(mysql_num_rows($result) > 0) {
		echo "登录成功";
	}else {
		echo "登录失败，用户名或者密码错误 <br>";
		back();
	}
?>

