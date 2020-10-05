<?php

//use PDO;

/**
 * Class notifs
 */
class notifs
{

    public $display_flash = array('success' => 'Succès', 'error' => 'Erreur', 'info' => 'Information');

    public $type_flash;
    public $message;

    public $notifications = array();

    public function StoreFlash($type_flash = "info", $message = "Null")
    {
        (!isset($_SESSION['flash'])) ? $_SESSION['flash'] = array() : null;
        array_push($_SESSION['flash'], array('type_flash' => $type_flash, 'message' =>  $message));
    }

    public function FlashExist()
    {

        if (!empty($_SESSION['flash'])) {

            foreach ($_SESSION['flash'] as $f) {
                $this->type_flash = $f['type_flash'];
                $this->message = $f['message'];

                array_push($this->notifications, array('type' => $this->type_flash, 'titre' => $this->display_flash[$this->type_flash], 'message' => $this->message));
                //debug($this->notifications);
            }

            unset($_SESSION['flash']);
            return true;

        } else {
            return false;
        }

    }

}