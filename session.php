<?php
session_start();
    $_SESSION['name'] = 'Devin';
echo $name;

/* Sessions are stored on the server
Cookies are stored client side
Sessions are related to cookies
A cookie is used to create a session
Session is established on the server -- cookie seat back to 'user with a 'references to the session.
Cookies can only store 4,000 characters

Sessions are more secure because actual data values are stored on the server.
Sessions expire when the browser is cleared