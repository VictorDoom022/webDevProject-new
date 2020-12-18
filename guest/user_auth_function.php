<?php
function reset_password($username)
{
    // set password for username to a randow value
    // return the new password or false on failure
    // get a random word 13 chars in length
    $new_password = get_random_word(13);
    
    if($new_password == false) {
        throw new Exception('Could not generate new password.');
    }

    $conn = mysqli_connect('localhost','root','');
    $query = "UPDATE users SET password = md5('$new_password') WHERE username = '$username'";
    $result = $conn->query($query);
    
    if(!$result) {
        throw new Exception('Could not change password.');
    } else {
        return $new_password;
    }
}


function notify_password($username, $password)
{
    $conn = mysqli_connect('localhost','root','');
    $query = "SELECT email FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if(!$result) {
        throw new Exception('Could not find email address.');
    } else if($result->num_rows == 0) {
        // username not in db
        throw new Exception('Could not find email address.');
    } else {
        $row = $result->fetch_object();
        $email = $row->email;
        $from = "From: Apple Website\r\n";
        $message = "Your Apple password has been changed to ". $password ."\r\n"
                    ."Please change it next time you log in.\r\n";
        
        if(mail($email, 'Apple login information', $message, $from)) {
            return true;
        } else {
            throw new Exception('Could not send email.');
        }
    }
}

function get_random_word($max_length)
{
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $random_string = '';
    for($i = 0;$i < $max_length; $i++) {
        $index = rand(0, strlen($permitted_chars) - 1);
        $random_string .= $permitted_chars[$index];
    }
    return $random_string;
}
?>