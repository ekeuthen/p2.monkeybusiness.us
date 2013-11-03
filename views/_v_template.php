<!DOCTYPE html>
<html>
<head>
	<title>
        <?php if(isset($title)) echo $title; ?>
    </title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	

	<!-- for mozilla/firefox -->
    <link rel="icon" href="/uploads/favicon.ico" type="image/png"/>
    <!-- for IE -->
    <link rel="shortcut icon" href="/uploads/favicon.ico" type="image/vnd.microsoft.icon"/>

    <!-- Common CSS/JSS -->
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>  

    <div id='menu'>
        <div id = 'left'>
            <a href='/'><h2>MONKEY MIC</h2></a>
        </div>

        <!-- Menu for users who are logged in -->
        <div id='right'><h3>
            <?php if($user): ?>

                <a href='/users/profile'>PROFILE</a>
                <a href='/posts/users'>USERS</a>
                <a href= '/posts/add'>TALK</a>
                <a href= '/posts'>LISTEN</a>
                <a href='/users/logout'>LOGOUT</a>

            <!-- Menu options for users who are not logged in -->
            <?php else: ?>

                <a href='/users/signup'>SIGN UP</a>
                <a href='/users/login'>LOG IN</a>

            <?php endif; ?>
        </h3></div>
        <hr>

    </div>

    <br>

    <?php if(isset($content)) echo $content; ?>

</body>
</html>