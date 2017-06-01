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
                    $valore = ['visualizzato' => 'Paesaggi', 'riferimento' => \Utilities\Categories::PAESAGGI];
                    break;

                case Categories::RITRATTI:
                    $valore = ['visualizzato' => 'Ritratti', 'riferimento' => \Utilities\Categories::RITRATTI];
                    break;

                case Categories::FAUNA:
                    $valore = ['visualizzato' => 'Fauna', 'riferimento' => \Utilities\Categories::FAUNA];
                    break;

                case Categories::BIANCONERO:
                    $valore = ['visualizzato' => 'Bianco e Nero', 'riferimento' => \Utilities\Categories::BIANCONERO];
                    break;

                case Categories::ASTRONOMIA:
                    $valore = ['visualizzato' => 'Astronomia', 'riferimento' => \Utilities\Categories::ASTRONOMIA];
                    break;

                case Categories::STREET:
                    $valore = ['visualizzato' => 'Street', 'riferimento' => \Utilities\Categories::STREET];
                    break;

                case Categories::NATURAMORTA:
                    $valore = ['visualizzato' => 'Natura Morta', 'riferimento' => \Utilities\Categories::NATURAMORTA];
                    break;

                case Categories::SPORT:
                    $valore = ['visualizzato' => 'Sport', 'riferimento' => \Utilities\Categories::SPORT];
                    break;
            }
            array_push($cost, $valore);
        }
        return $cost;
    }


    /**
     * Divides the thumbnails into chunks to enable a multi-row view
     *
     * @param array $array_photo An array with thumbnails to display
     * @return array
     */
    //devo vede se questa funziona
    public function thumbnail($thumb)
    {
        $array_foto = [];
        foreach($thumb as $value)
        {
            if(isset($value["thumbnail"]))
            {
                $mime = image_type_to_mime_type($value["type"]);
                $pic = $value["thumbnail"];
                $foto = '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
                array_push($array_foto, $foto);
            }
        }
        return array_chunk($array_foto, PHOTOS_PER_ROW);
    }


    public function photo_details($photo)
    {
        $uploader = $photo["uploader"];
        $title = $photo["photo"]->get_Title();
        $description = $photo['photo']->get_Description();
        $is_reserved = $photo['photo']->get_Reserved();
        $categories = $this->imposta_categoria($photo["photo"]->get_Categories());
        $Upload_Date = $photo['photo']->get_Upload_Date();
        $tot_like = $photo['photo']->get_NLikes();
        $id = $photo['photo']->get_ID();
        return $photo_details = ['uploader'    => $uploader, 'id'          => $id, "title"       => $title, "description" => $description, "categories"  => $categories, "is_reserved" => $is_reserved,
            "Upload_Date" => $Upload_Date, "tot_like"    => $tot_like];
    }


    public function album_details($album)
    {
        $title = $album["album"]->get_Title();
        $description = $album["album"]->get_Description();
        $categories = $this->imposta_categoria($album["album"]->get_Categories());
        $creation_date = $album["album"]->get_Creation_Date();
        return $album_details = ["title" => $title, "description" => $description, "categories" => $categories, "creation_date" => $creation_date];
    }


    public function showimage($photo)
    {
        $mime = image_type_to_mime_type($photo["type"]);
        $pic = $photo["fullsize"];
        $foto = '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
        $this->assign('foto', $foto);
    }


    public function show_profile_pic($photo)
    {
        if(isset($photo["photo"]))
        {
            $mime = image_type_to_mime_type($photo["type"]);
            $pic = $photo["photo"];
            $foto = '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
            $this->assign('pic_profile', $foto);
        }
        else
        {
            $photo= \Entity\E_Photo::get_By_ID($id='2', $username='AllUser', $role= \Utilities\Roles::ADMIN);
            $mime = image_type_to_mime_type($photo["type"]);
            $pic = $photo["fullsize"];
            $foto = '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
            $this->assign('pic_profile', $foto);
        }
    }

}