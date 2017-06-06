<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

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


    /**
     * restiruisce un array con i dettagli delle foto 
     * @param type $photo objet
     * @return type array
     */
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


    /**
     * restiruisce un array con i dettagli dell'album
     * @param type $album objet
     * @return type array
     */
    public function album_details($album)
    {
        $title = $album["album"]->get_Title();
        $description = $album["album"]->get_Description();
        $categories = $this->imposta_categoria($album["album"]->get_Categories());
        $creation_date = $album["album"]->get_Creation_Date();
        return $album_details = ["title" => $title, "description" => $description, "categories" => $categories, "creation_date" => $creation_date];
    }


    /**
     * restiruisce un array con i dettagli dell'utente
     * @param type $user_details objet
     * @return type array
     */
    public function user_details($user_details)
    {
        $username = $user_details->get_Username();
        $password = $user_details->get_Password();
        $email = $user_details->get_Email();
        $role = $this->imposta_ruolo($user_details->get_Role());
        return $album_details = ["username" => $username, "email" => $email, "password" => $password, "role" => $role];
    }


    /**
     * assegna a smarty una foto con codifica base64 
     * @param type $photo
     */
    public function showimage($photo)
    {
        $mime = image_type_to_mime_type($photo["type"]);
        $pic = $photo["fullsize"];
        $foto = '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
        $this->assign('foto', $foto);
    }


    /**
     * assegna a smarty una foto con codifica base64 
     * @param type $photo
     */
    public function show_profile_pic($photo)
    {
        $mime = image_type_to_mime_type($photo["type"]);
        $pic = $photo["photo"];
        $foto = '<img src="data:'.$mime.'; base64, '.base64_encode($pic).'"/>';
        $this->assign('pic_profile', $foto);
    }


}