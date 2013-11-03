<h1>
	<img src="/uploads/avatars/monkeyface.jpg" height=50 width=50 id='avatar' alt="user photo">
	<?php
		$file = '\uploads\avatars\monkeyface.jpg'; 
		if (file_exists($file)) {
		    //echo "The file $file exists";
		} else {
		    //echo "The file $file does not exist";
		}
	?>
	<?=$user->first_name?>'s Profile
</h1>

<table>
	<tr>
		<td>First name:</td>
		<td><?=$user->first_name?></td>
	</tr>
	<tr>
		<td>Last name:</td>
		<td><?=$user->last_name?></td>
	</tr>
	<tr>
		<td>Email:</td>
		<td><?=$user->email?></td>
	</tr>
	<!--<tr>
		<td>Change Photo:</td>
		<td>-->
			<!--code inspired by http://davidwalsh.name/basic-file-uploading-php-->
			<!--<form action="/users/p_profile" method="post" enctype="multipart/form-data">
				<input type="file" name="photo" size="25" />
				<input type="submit" name="submit" value="Submit" />
			</form>
		</td>
	</tr>-->
	<!--Alllow users to delete their accounts.  Log them out and then delete records in database. -->
</table>

<form method='POST' action='/users/p_profile'>
	<tr>
		<td>Had enough Monkey business?</td>
		<td><a href='/users/logout'><input type='submit' value='Delete account'></a></td>
	</tr>
</form>

<?php if(isset($message)): ?>
    <div class='error'>
        <?=$message;?>
    </div>
    <br>
<?php endif; ?>
</br>

<h3>Thank you for being a part of the Monkey <a href='http://www.npwrc.usgs.gov/about/faqs/animals/names.htm'>troop</a> since <?php echo date('F d, Y',$user->created); ?>!</h2>