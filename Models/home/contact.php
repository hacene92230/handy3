<?php
namespace home;

class contact
{

    public  $error = null;
    public  $DataCorrect = false;
    public  $post = null;

    private $name = null;
    private $firstname = null;
    private $email = null;
    private $message = null;

    public function __construct($email_contact = null) {
        $this->post = $_POST;
        $this->email = $email_contact;
    }

    public function DataPost()
    {

        if (!empty($this->post['name'])) {

            if (!empty($this->post['email'])) {

                if (!empty($this->post['message'])) {

                    $this->name = $this->post['name'];
                    $this->firstname = $this->post['firstname'];
                    $this->message = $this->post['message'];
                    $this->email = $this->post['email'];

                    unset($this->post['name']);
                    unset($this->post['firstname']);
                    unset($this->post['message']);
                    unset($this->post['email']);;

                    return true;

                } else {
                    $this->error = "Votre message n'a pas été renseigné.";
                    return false;
                }

            } else {
                $this->error = "Votre email n'a pas été renseigné.";
                return false;
            }

        } else {
            $this->error = "Votre nom n'a pas été renseigné.";
            return false;
        }

    }

    public function SendMail() {

        $valid = filter_var($this->email, FILTER_VALIDATE_EMAIL);
        if($valid) {

            try {
                $destinataire = $this->email;
                $expediteur = $this->email_contact;
                $objet = 'Handi3.0 - Contact | ' . $this->name; // Objet du message
                $headers  = 'MIME-Version: 1.0' . "\n"; // Version MIME
                $headers .= 'Content-type: text/html; charset=ISO-8859-1'."\n"; // l'en-tete Content-type pour le format HTML
                $headers .= 'Reply-To: '.$expediteur."\n"; // Mail de reponse
                $headers .= 'From: "Handi3 - Formulaire de contact"<'.$expediteur.'>'."\n"; // Expediteur
                $headers .= 'Delivered-to: '.$destinataire."\n"; // Destinataire     
                $message = 'Handi3.0 - Monsieur/Madame ' . $this->name . ' ' . (empty($this->firstname)) ? 'X' : $this->firstname . ' Souhaite vous contacter pour le sujet suivant : ' . $this->message;

                if (mail($destinataire, $objet, $message, $headers)) { return true; }
                else { $this->error = "Echec de l'envoi de l'email. (Erreur interne)"; return false; }
            }
            catch(Exception $ex) {
                // $this->error = "Echec de l'envoi de l'email --> " . $ex->getMessage();
                $this->error = "Echec de l'envoi de l'email. (Erreur interne)";
                return false;
            }

        } else {
            $this->error = "Votre email semble invalide.";
            return false;
        }

    }

}