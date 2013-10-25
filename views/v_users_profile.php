<img src="/uploads/monkeyface.jpg" height=50 width=50>

<h1><?=$user->first_name?>'s Profile</h1>
<h3>First name: <?=$user->first_name?><h3>
<h3>Last name: <?=$user->first_name?><h3>
<h3>Email: <?=$user->email?><h3>
<!--Convert to reable date-->
<h2>Thank you for being a Monkey Mic user since <?=$user->created?>!<h2>

<!--code inspired by http://davidwalsh.name/basic-file-uploading-php-->
<form action="/users/p_profile" method="post" enctype="multipart/form-data">
	Your Photo: <input type="file" name="photo" size="25" />
	<input type="submit" name="submit" value="Submit" />
</form>
