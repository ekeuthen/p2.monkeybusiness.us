<h3>Here's the latest monkey chatter.  If you want to hear more noise, navigate to USERS and select monkeys to follow.</h3><br />
<table id="postsList">
	<?php foreach($posts as $post): ?>

		<tr>

			<td class="postData">
				<?=$post['first_name']?> <?=$post['last_name']?> <br /><br />
				<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
		        	<?=Time::display($post['created'])?>
		    	</time>
			</td>

		    <td class="postContent">
				<?=$post['content']?>
			</td>

		</tr>

	<?php endforeach; ?>
</table>