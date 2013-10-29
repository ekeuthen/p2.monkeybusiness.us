<table>
	<?php foreach($posts as $post): ?>

		<tr>

			<td>
				<?=$post['first_name']?> <?=$post['last_name']?> <br />
				<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
		        	<?=Time::display($post['created'])?>
		    	</time>
			</td>

		    <td>
				<?=$post['content']?>
			</td>

		</tr>

	<?php endforeach; ?>
</table>