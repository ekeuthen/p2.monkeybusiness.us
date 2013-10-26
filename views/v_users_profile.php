<h1><img src="/uploads/monkeyface.jpg" height=50 width=50 id='avatar'><?=$user->first_name?>'s Profile</h1>

<table>
	<tr>
		<td>First name:</td>
		<td><?=$user->first_name?></td>
	</tr>
	<tr>
		<td>Last name:</td>
		<td><?=$user->first_name?></td>
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
				<input type="file" name="photo" size="25" />
				<input type="submit" name="submit" value="Submit" /></h3>
			</form>
		</td>
	</tr>
</table>
</br>

<h3>Thank you for being a part of the Monkey <a href='http://www.npwrc.usgs.gov/about/faqs/animals/names.htm'>troop</a> since <?php echo date('F d, Y',$user->created); ?>!</h2>