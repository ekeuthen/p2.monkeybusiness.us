<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function signup($error = null) {

        # Setup view
            $this->template->content = View::instance('v_users_signup');
            $this->template->title   = "Sign Up";

        # Pass data to the view
            $this->template->content->error = $error;

        # Render template
            echo $this->template;

    }

    public function p_signup() {

        # Validate email is not already in the database
        $q = "SELECT email
            FROM users
            WHERE email = '".$_POST['email']."'";

        $newEmail = DB::instance(DB_NAME)->select_field($q);

        if ($newEmail != null) {
            Router::redirect("/users/signup/error");
        }

        #If  email is not in database, create account and log in user
        else {
            # More data we want stored with the user
            $_POST['created']  = Time::now();
            $_POST['modified'] = Time::now();

            # Encrypt the password  
            $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);            

            # Create an encrypted token via their email address and a random string
            $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string()); 
            $token = $_POST['token'];

            # Insert this user into the database 
            $user_id = DB::instance(DB_NAME)->insert("users", $_POST);

            /* 
            Store this token in a cookie using setcookie()
            Important Note: *Nothing* else can echo to the page before setcookie is called
            Not even one single white space.
            param 1 = name of the cookie
            param 2 = the value of the cookie
            param 3 = when to expire
            param 4 = the path of the cooke (a single forward slash sets it for the entire domain)
            */
            setcookie("token", $token, strtotime('+1 year'), '/');

            # Send them to the main page - or whever you want them to go
            Router::redirect("/");
        }

    }

    public function login($error = NULL) {

        # Set up the view
        $this->template->content = View::instance("v_users_login");
        $this->template->title   = "Log In";

        # Pass data to the view
        $this->template->content->error = $error;

        # Render the view
        echo $this->template;

    }

    public function p_login() {

        # Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # Hash submitted password so we can compare it against one in the db
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        # Search the db for this email and password
        # Retrieve the token if it's available
        $q = "SELECT token 
            FROM users 
            WHERE email = '".$_POST['email']."' 
            AND password = '".$_POST['password']."'";

        $token = DB::instance(DB_NAME)->select_field($q);

        # Login failed
        if(!$token) {
            # Note the addition of the parameter "error"
            Router::redirect("/users/login/error");

        # But if we did, login succeeded! 
        } else {

            /* 
            Store this token in a cookie using setcookie()
            Important Note: *Nothing* else can echo to the page before setcookie is called
            Not even one single white space.
            param 1 = name of the cookie
            param 2 = the value of the cookie
            param 3 = when to expire
            param 4 = the path of the cooke (a single forward slash sets it for the entire domain)
            */
            setcookie("token", $token, strtotime('+1 year'), '/');

            # Send them to the home page
            Router::redirect("/");
        }
    }

    public function profile($message = null) {

        # If user is blank, they're not logged in; redirect them to the login page
        if(!$this->user) {
            Router::redirect('/users/login');
        }

        # If they weren't redirected away, continue:

        # Setup view
        $this->template->content = View::instance('v_users_profile');
        $this->template->title   = "Profile of ".$this->user->first_name;

        # Pass data to the view
        $this->template->content->message = $message;

        # Render template
        echo $this->template;

    }

    public function p_profile_delete() {

        # Delete user from database
        $condition = "WHERE user_id = ".$this->user->user_id;
        DB::instance(DB_NAME)->delete('users', $condition);

        # Send them to the home page
        Router::redirect("/users/logout");
    }

    public function p_profile() {
        //Upload photo - code inspired by http://davidwalsh.name/basic-file-uploading-php
        //if they DID upload a file...
        if($_FILES['photo']['name'])
        {
            //if no errors...
            if(!$_FILES['photo']['error'])
            {
                //now is the time to modify the future file name and validate the file
                if($_FILES['photo']['size'] > (1024000)) //can't be larger than 1 MB
                {
                    $valid_file = false;
                    $message = 'too-big';

                    # Send them back to their profile
                    Router::redirect("/users/profile/too-big");
                }
                
                //if the file has passed the test
                else
                {
                    //move it to where we want it to be
                    $currentdir = getcwd();
                    //change name of file to be user_id
                    $_FILES['photo']['name'] = $this->user->user_id.".jpg";
                    $target = $currentdir .'/uploads/avatars/' . basename($_FILES['photo']['name']);
                    move_uploaded_file($_FILES['photo']['tmp_name'], $target);

                    $message = 'success';

                    # Send them back to their profile
                    Router::redirect("/users/profile/success");
                }
            }
            //if there is an error...
            else
            {
                //set that to be the returned message
                $message = 'error';

                # Send them back to their profile
                Router::redirect("/users/profile/error");
            }
        }

        # If nothing was submitted, stay on profile
        $message = 'empty';
        Router::redirect("/users/profile/empty");

    }

    public function logout() {

        # Generate and save a new token for next login
        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array only has one entry
        $data = Array("token" => $new_token);

        # Do the update
        DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

        # Delete their token cookie by setting it to a date in the past - effectively logging them out
        setcookie("token", "", strtotime('-1 year'), '/');

        # Send them back to the main index.
        Router::redirect("/");

    }

} # end of the class
