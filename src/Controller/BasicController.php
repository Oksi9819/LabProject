<?php

class BasicController
{
    public function execute()
    {
        navi();
        echo 'It is page with contacts here';
    }
    
    public function send()
    {
        navi();
        echo 'There is contact-form here';
        echo '<form method="post"><input type="text" name="test"><input type="submit" value="send"></form>';
    }

    public function show()
    {
        navi();
        echo 'The form has been sent:<br>';
        print_r($_POST);
    }

}