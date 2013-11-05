<table id = 'posts'>
    <?php foreach($users as $user): ?>

        <tr>

            <td>
                <?php
                    $displayed_file = '/uploads/avatars/monkeyface.jpg';
                    $user_file = "uploads/avatars/'".$user['user_id']."'.jpg"; 
                    if (file_exists($user_file)) {
                        $displayed_file = "/".$user_file;
                    } 
                ?>
                <img src= <?=$displayed_file?> height=60 width=60 class='avatar' alt='user photo'>
            </td>

            <td>
                <!-- Print this user's name -->
                <?=$user['first_name']?> <?=$user['last_name']?>
            </td>

            <td>
                <!-- If there exists a connection with this user, show a unfollow link -->
                <?php if(isset($connections[$user['user_id']])): ?>
                    <a href='/posts/unfollow/<?=$user['user_id']?>' class='following'>Unfollow</a>

                <!-- Otherwise, show the follow link -->
                <?php else: ?>
                    <a href='/posts/follow/<?=$user['user_id']?>' class='following'>Follow</a>
                <?php endif; ?>
            </td>

        </tr>

    <?php endforeach; ?>
</table>