<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

use Smarty;
use Utilities\Categories;
use Utilities\Roles;

require_once '.'.DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR.'Smarty.class.php';

class V_Basic extends \Smarty
{
    /**
     * Costruttore della classe
     */
    public function __construct()
    {
        global $config;
        parent::__construct();
        $this->setTemplateDir($config['smarty']['template_dir']);
        $this->setCompileDir($config['smarty']['compile_dir']);
        $this->setCacheDir($config['smarty']['config_dir']);
        $this->setConfigDir($config['smarty']['cache_dir']);
    }


    /**
     * Grazie a questa funzione all'interno della variabile $dati_reg vengono
     * registrati tutti i dati inviati tramite POST dal modulo di registrazione
     * @param string or array $keys Description chiavi usate per cercare
     * @return array
     */
    public function get_Dati($keys)
    {
        $total = array_merge($_REQUEST, $_FILES);
        foreach($keys as $dato)
        {
            $dettagli[$dato] = $total[$dato];
        }
        return $dettagli;
    }


    /**
     * Questa funzione, restituisce il task inviato all'interno del vettore
     * superglobale $_REQUEST
     */
    public function getTask()
    {
        if(isset($_REQUEST['task']))
        {
            return $_REQUEST['task'];
        }
    }


    /**
     * @return mixed
     */
    public function getController()
    {
        if(isset($_REQUEST['controller']))
        {
            return $_REQUEST['controller'];
        }
//        return FALSE;
    }


    /**
     * Ritorna il contenuto del template che si vuole visualizzare
     * Questa funzione va sovrascritta nelle classi figlie impostando $nome_template
     *
     * @return tpl content
     */
    public function fetch_Template($nome_template)
    {
        $contenuto = $this->fetch($nome_template.'.tpl');
        return $contenuto;
    }


    public function set_variable($var_tpl, $variabile)
    {
        $this->assign($var_tpl, $variabile);
    }


    /**
     * Assegna a smarty i dati della registrazione passati come parametro
     *
     * @param array $dati
     * @param int $data
     */
    public function set_Dati($dati)
    {
        $this->assign('username', $dati['username']);
        $this->assign('email', $dati['email']);
    }


    /**
     * dal valore numerico mi ritorna un array con stringhe
     * @param type $role
     * @return array
     */
    public function imposta_ruolo($role)
    {
        switch ($role)
        {
            case Roles::BANNED:
                $role = "banned";
                break;

            case Roles::STANDARD:
                $role = "standard";
                break;

            case Roles::PRO:
                $role = "pro";
                break;

            case Roles::MOD:
                $role = "mod";
                break;

            case Roles::ADMIN:
                $role = "admin";
                break;
            default :
                $role = "ospite";
        }
        return $role;
    }


    /**
     * trasforma le stringe in numeri per i ruoli
     * @param array $role
     * @return array
     */
    public function reimposta_ruolo($role)
    {
        $cost = [];
        foreach($role as $valore)
        {
            array_push($cost, constant(strtoupper(trim($valore))));
        }
        return $cost;
    }


    /**
     * dal valore numerico mi ritorna un array con scritte
     * @param array $categories
     * @return array
     */
    public function imposta_categoria($categories = [1, 2, 3, 4, 5, 6, 7, 8])
    {
        $cost = [];
        foreach($categories as $valore)
        {

            switch ($valore)
            {
                case Categories::PAESAGGI:
                    $valore = "Paesaggi";
                    break;

                case Categories::RITRATTI:
                    $valore = "Ritratti";
                    break;

                case Categories::FAUNA:
                    $valore = "Fauna";
                    break;

                case Categories::BIANCONERO:
                    $valore = "Bianco e Nero";
                    break;

                case Categories::ASTRONOMIA:
                    $valore = "Astronomia";
                    break;

                case Categories::STREET:
                    $valore = "Street";
                    break;

                case Categories::NATURAMORTA:
                    $valore = "Natura Morta";
                    break;

                case Categories::SPORT:
                    $valore = "Sport";
                    break;
            }
            array_push($cost, $valore);
        }
        return $cost;
    }


    /**
     * trasforma le stringe in numeri per le categorie
     */
    public function reimposta_categorie($categories)
    {
        $cost = [];
        foreach($categories as $valore)
        {
            array_push($cost, constant(strtoupper(trim($valore))));
        }
        return $cost;
    }


    /**
     * imposta i dati nel template identificati da una chiave ed il relativo valore
     * @param type $key
     * @param type $valore
     */
    public function impostaDati($key, $valore)
    {
        $smarty = new Smarty();
        $smarty->assign($key, $valore);
    }


    /**
     * Divides the thumbnails into chunks to enable a multi-row view
     *
     * @param array $array_photo An array with thumbnails to display
     * @return array
     */
    public function thumbnail($array_photo)
    {
        $array_foto = [];
        foreach($array_photo as $value)
        {
            array_push($array_foto, $value);
        }
        return array_chunk($array_photo, PHOTOS_PER_ROW);
    }


    public function photo_details($photo)
    {
        $title = $photo["photo"]->get_Title();
        $description = $photo["photo"]->get_Description();
        $is_reserved = $photo['photo']->get_Reserved();
        $categories = $this->imposta_categoria($photo["photo"]->get_Categories());
        $Upload_Date = $photo["photo"]->get_Upload_Date();
        $tot_like = $photo['photo']->get_NLikes();
        return $photo_details = ["title"       => $title, "description" => $description, "is_reserved" => $is_reserved,
            "Upload_Date" => $Upload_Date, "tot_like"    => $tot_like];
    }


    public function album_details($album)
    {

        $title = $album->get_Title();
        $description = $album->get_Description();
        $creation_date = $album->get_Creation_Date();
        return $album_details = ["title"=> $title, "description" => $description,"creation_date" => $creation_date];
    }


}
