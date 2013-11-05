<h2 id="profileHeader">
	<?php
		$displayed_file = '/uploads/avatars/monkeyface.jpg';
		$user_file = "uploads/avatars/".$user->user_id.".jpg"; 
		if (file_exists($user_file)) {
		    $displayed_file = "/".$user_file;
		} 
	?>
	<img src= <?=$displayed_file?> height=60 width=60 id='avatar' alt='user photo'>

	<?=$user->first_name?>'s Profile
</h2>

<table id="profileInfo">
	<tr>
		<td >First name:</td>
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
	<tr>
		<td>Change Photo:</td>
		<td>
			<!--code inspired by http://davidwalsh.name/basic-file-uploading-php-->
			<form action="/users/p_profile" method="post" enctype="multipart/form-data">
				<input type="file" name="photo" />
				<input type="submit" name="submit" value="Submit" />
			</form>
		</td>
	</tr>
	
</table><br>

<?php if(isset($message )&& $message == 'too-big'): ?>
    <div class='error'>
    	Size of attachment must be less than 1 MB.  
    </div>
    <br>
<?php endif; ?>

<?php if(isset($message )&& $message == 'success'): ?>
    <div class='error'>
    	Photo has been successfully uploaded!  
    </div>
    <br>
<?php endif; ?>

<?php if(isset($message )&& $message == 'error'): ?>
    <div class='error'>
    	Photo can not be uploaded.  Please try again.    
    </div>
    <br>
<?php endif; ?>

<?php if(isset($message )&& $message == 'empty'): ?>
    <div class='error'>
    	Please select a photo to upload.      
    </div>
    <br>
<?php endif; ?>

<!--Alllow users to delete their accounts.  Log them out and then delete records in database. -->
<form method='POST' action='/users/p_profile_delete'>
	<table>
		<tr>
			<td>Had enough Monkey business?  </td>
			<td><input type='submit' value='Delete account'></td>
		</tr>
	</table>
</form>

<h3>Thank you for being a part of the Monkey <a href='http://www.npwrc.usgs.gov/about/faqs/animals/names.htm'>troop</a> since <?php echo date('F d, Y',$user->created); ?>!</h3>