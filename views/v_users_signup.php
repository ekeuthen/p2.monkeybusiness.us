<form method='POST' action='/users/p_signup'>

    <h3>Hi.  It's nice to meet you.  You'll be on your way to making monkey noises in no time.</h3>

    First Name<br>
    <input type='text' name='first_name' required=''>
    <br><br>

    Last Name<br>
    <input type='text' name='last_name' required=''>
    <br><br>

    Email<br>
    <input type='text' name='email' required=''>
    <br><br>

    Password<br>
    <input type='password' name='password' required=''>
    <br><br>

    <?php if(isset($error)): ?>
        <div class='error'>
            That email already belongs to a monkey in the Monkey Mic family.  Please login or use another email.
        </div>
        <br>
    <?php endif; ?>

    <input type='submit' value='Sign up'>

</form>