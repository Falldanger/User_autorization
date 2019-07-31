<?php
    session_start();
    $error = false;
    if (isset($_POST['auth'])) {
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['password'] = md5($_POST['password']);
        $error = true;
    }
    if (isset($_GET['f']) && $_GET['f'] == 'logout') {
        unset($_SESSION['login']);
        unset($_SESSION['password']);
    }
    $login = ['admin','moderator'];
    $password = ['202cb962ac59075b964b07152d234b70','caf1a3dfb505ffed0d024130f58c5cfa'];
    $auth = false;
    $iss = isset($_SESSION['login']) && isset($_SESSION['password']);
    for ($i=0; $i < sizeof($login); $i++) { 
    if ($iss && $_SESSION['login'] === $login[$i] && $_SESSION['password'] === $password[$i]) {
        $auth = true;
        $error = false;
    }
	}
?>
<?php if ($error) { ?><p>Incorrect Login and/or password!</p><?php } ?>
<?php if ($auth) { ?>
    <p>Welcome, <?=$_POST['login']?>!</p>
    <a href='index.php?f=logout'>Log out</a>
<?php } else { ?>
<form name="auth" method="post" action="index.php">
    <p>
        Login: <input type="text" name="login" />
    </p>
    <p>
        Password: <input type="password" name="password" />
    </p>
    <p>
        <input type="submit" name="auth" value="Sing in" />
    </p>
</form>
<?php } ?>