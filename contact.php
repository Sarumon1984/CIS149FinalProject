<?php
    $title = 'Contact';
    require 'includes/head.php';
?>

<?php
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$user_email = $_POST['user_email'];
$user_phone = $_POST['user_phone'];
$user_contact = $_POST['user_contact'];
$contact_phone = $_POST['contact_phone'];
$contact_email = $_POST['contact_email'];
$contact_reason = $_POST['contact_reason'];
$user_comments = $_POST['user_comments'];
$subscribe = $_POST['subscribe'];
$notify = $_POST['notify'];
$submit = $_POST['mySubmit'];

if (isset($subscribe)){
    $subscribe_checked = 'checked';
}

if (isset($notify)){
    $notify_checked = 'checked';
}
                                                    // Preferred Contact Function (Sticky)
function contact_method($preferred,$user_contact){
    if ($user_contact === $preferred){
        return 'checked';
    }
}
                                                    // Checkbox Function (Sticky)
function is_checked($checked){
    if (isset($checked)){
        return 'checked';
    }
}
                                                    // Select List Drop down Function (Sticky)
function is_selected($selected,$contact_reason){
    if ($selected === $contact_reason){
        return 'selected';
    }
}
                                                    // Final: Confirmation Email - Finished
if (isset($submit)){
    $email_data = '';
    $email_data .= 'Name: ' . $first_name . ' ' . $last_name . "\r\n\n";
    $email_data .= 'E-mail address: ' . $user_email . "\r\n\n";
    $email_data .= 'Phone number: ' . $user_phone . "\r\n\n";
    $email_data .= 'Preferred contact method: ' . ucwords($user_contact) . "\r\n\n";
    $email_data .= 'You inquired about: ' . ucwords(str_replace('_', ' ', $contact_reason)) . "\r\n\n";
    $email_data .= 'Your Comment: ' . wordwrap($user_comments, 60) . "\r\n\n";
    $email_data .= 'Subscribe to newsletter: ';
    $email_data .= isset($subscribe) ? 'Yes' : 'No' . "\r\n\n";
    $email_data .= 'New product notification: ';
    $email_data .= isset($notify) ? 'Yes' : 'No' . "\r\n";
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


function form_errors($errors=array(),$first_name,$last_name, $user_email, $email_data){
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
        $output .= 'Thank you ' . $first_name . ' ' . $last_name;
        $output .= '. We have successfully received your information and sent a confirmation email using the address you provided.';
        $output .= '</p>';
        mail($user_email, 'Auto Reply from devindelp.com', $email_data);
    }
    return $output;
}
                                                    // Run function to check information entered and display appropriate result.
if (isset($submit)){
    echo form_errors($errors, $first_name, $last_name, $user_email, $email_data);
}

?>
<div class="container">
    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
            <p class="success">Fields marked with * are required</p>
            <form id="contact" method="POST" action="contact.php">
                <fieldset><legend>Contact Information</legend>
                    <label for="first_name">First Name: </label><br />
                    <input type="text" class="form-control" name="first_name" id="first_name" value="<?php print $first_name ?>" maxlength="25" />&nbsp;&nbsp;*<br />
                    <label for="last_name">Last Name: </label><br />
                    <input type="text" name="last_name" id="last_name" value="<?php print $last_name ?>" maxlength="25" />&nbsp;&nbsp;*<br />
                    <label for="user_email">Email Address: </label><br />
                    <input type="text" name="user_email" id="user_email" value="<?php print $user_email ?>" />&nbsp;&nbsp;*<br />
                    <label for="user_phone">Phone Number: </label><br />
                    <input type="text" name="user_phone" id="user_phone" value="<?php print $user_phone ?>" />&nbsp;&nbsp;*<br /><br />
                    I prefer to be contacted by: <br />
                    <input type="radio" name="user_contact" id="contact_phone" value="phone" <?php print contact_method('phone',$user_contact) ?> />
                    <label for="contact_phone">Phone</label>
                    <input type="radio" name="user_contact" id="contact_email" value="email" <?php print contact_method('email',$user_contact) ?> />
                    <label for="contact_email">Email</label>&nbsp;&nbsp;*<br /><br />
                    I would like information about:<br />
                    <select name="contact_reason" id="contact_reason" size="1">
                        <option value="" disabled="disabled">I want information about</option>
                        <option value="ten_pound_dumbbells" <?php print is_selected('ten_pound_dumbbells',$contact_reason) ?>>10 lb. Dumbbells</option>
                        <option value="fifteen_pound_dumbbells" <?php print is_selected('fifteen_pound_dumbbells',$contact_reason) ?>>15 lb. Dumbbells</option>
                        <option value="twenty_pound_dumbbells" <?php print is_selected('twenty_pound_dumbbells',$contact_reason) ?>>20 lb. Dumbbells</option>
                    </select><br />
                    <label for="user_comments">Comments: </label><br />
                    <textarea name="user_comments" id="user_comments" cols="35" rows="8"><?php print $user_comments ?></textarea><br />
                    <input type="checkbox" name="subscribe" id="subscribe" value="" <?php print is_checked($subscribe) ?> />
                    <label for="subscribe">Subscribe me</label><br />
                    <input type="checkbox" name="notify" id="notify" value="" <?php print is_checked($notify) ?> />
                    <label for="notify">Notify me of new products</label>
                </fieldset>
                <input name="mySubmit" type="submit" id="mySubmit"  value="Submit" />
            </form>
    </div>
</div>


<?php
if ($submit){

}
?>
<?php require 'includes/footer.php' ?>