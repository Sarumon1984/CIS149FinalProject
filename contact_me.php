
<?php
$name = $_POST['name'];
$email = $_POST['email'];
$contact_reason = $_POST['contact_reason'];
$comments = $_POST['comments'];
$submit = $_POST['mySubmit'];

// Preferred Contact Function (Sticky)

// Select List Drop down Function (Sticky)
function is_selected($selected,$contact_reason){
    if ($selected === $contact_reason){
        return 'selected';
    }
}
// Final: Confirmation Email - Finished
if (isset($submit)){
    $email_data = '';
    $email_data .= 'Name: ' . $name . "\r\n\n";
    $email_data .= 'E-mail address: ' . $email . "\r\n\n";
    $email_data .= 'You inquired about: ' . ucwords(str_replace('_', ' ', $contact_reason)) . "\r\n\n";
    $email_data .= 'Your Comment: ' . wordwrap(comments, 60) . "\r\n\n";
}

$errors = [];                                      // Create $errors array
if ( !isset($first_name) || $first_name === ""){
    $errors['first_name'] = "First name can't be blank";
}
if ( !isset($last_name) || $last_name === ""){
    $errors['last_name'] = "First name is required";
}
if ( !isset($user_email) || $user_email === ""){
    $errors['user_email'] = "An email address is required.";
}
if ( !isset($user_phone) || $user_phone === ""){
    $errors['user_phone'] = "A phone number is required.";
}
if ( !isset($user_contact)){
    $errors['user_contact'] = "Please select a preferred contact type";
}


function form_errors($errors=array(),$name, $email, $email_data){
    $output = "";
    if (!empty($errors) ) {
        $output =  "<p class='error'>";
        $output.= "Please fix the following errors";
        $output.= "</p>";
        $output.=  "<ul class='error'>";
        foreach ($errors as $key => $error){        // Check individual fields display error for
            $output.= "<li>$error</li>";            // fields not entered
        }
        $output.= "</ul>";
    } else {
        $output = '<p class="success">';                            // Text to display if form is properly filled out
        $output .= 'Thank you ' . $name;
        $output .= '. We have successfully received your information and sent a confirmation email using the address you provided.';
        $output .= '</p>';
        mail($email, 'Auto Reply from devindelp.com', $email_data);
    }
    return $output;
}
// Run function to check information entered and display appropriate result.
if (isset($submit)){
    echo form_errors($errors, $name, $email, $email_data);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Devin Delp</title>
    <meta charset="UTF-8"/>
    <!--    <link rel="stylesheet" href="css/jquery-ui.min.css" />-->
    <!--    <link rel="stylesheet" href="css/jquery-ui.structure.min.css" />-->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.min.css" />
<!--    <link rel="stylesheet" href="css/main.css" />-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!--    <script type="text/javascript" src="js/jquery-ui.min.js"></script>-->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">

    <p class="success">Fields marked with * are required</p>
    <form role="form" method="POST" action="contact_me.php">
        <fieldset>
            <legend>Contact Me</legend>
            <div class="form-group">
                <label for="name">Your Name: </label><br />
                <input class="form-control" type="text" name="name" id="name" placeholder="Name" /><br />
                <label for="email">Your Name: </label><br />
                <input class="form-control" type="text" name="email" id="email" placeholder="Email" /><br />
                <label for="contact_reason">Reason for contact: </label><br />
                <select name="contact_reason" id="contact_reason" size="1">
                    <option value="" disabled="disabled">I want information about</option>
                    <option value="Android Development" <?php print is_selected('Android Development',$contact_reason) ?>>Android Development</option>
                    <option value="Personal" <?php print is_selected('Personal',$contact_reason) ?>>Personal</option>
                </select><br /><br />
                <label for="message">Message</label>
                <textarea class="form-control" name="message" id="message" rows="10" cols="50"></textarea><br />


                <!--                        <button type="button" id="mySubmit" class="btn btn-primary pull-right">Send Email</button><br />-->
                <input class="btn btn-primary pull-right" name="mySubmit" type="submit" id="mySubmit"  value="Send Mail" />
            </div>
        </fieldset>
    </form>
</div>
<footer>
    <p class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        Devin Delp 2014<br />All images and trademarks are property of their respective owner
    </p>
</footer>
</body>
</html>

<?php
if ($submit){

}
?>