<?php

class RegistrationAuthorizationController
{
    public function save()
    {
        navi();
        echo 'There is registration form here';
        echo '<form method="post"><input type="text" name="test"><input type="submit" value="send"></form>';
    }

    public function show()
    {
        navi();
        echo 'You are already registered:<br>';
        print_r($_POST);
    }
}