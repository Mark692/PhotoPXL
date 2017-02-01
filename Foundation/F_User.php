<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

//use \PDO; //Per evitare errori con l'autoloader

class F_User extends \Foundation\F_Database
{


    /*
     * Imposta i parametri base per la connessione a DB come il nome della tabella
     * sulla quale operare ed il nome della chiave primaria.
     */
//    public function __construct()
//    {
//        parent::$tabella = 'users';
//        parent::$chiave_Primaria = 'username';
//    }


    /**
     * Retrives all the users that match the query
     * @param type $value searched with the query
     * @param bool $orderBy to select the preferred order to display results
     * @param string $column the column to search
     */
    public static function get_record($value, $orderBy, $column = "username")
    {
        $query = "SELECT * "
                ."FROM users "
                ."WHERE ".$column." = '".$value."'";
        if (!$orderBy)
        {
            $query = $query."ORDER BY DESC";
        }
        $record = parent::get($query);
        return $record;
    }


    /**
     * Saves the user into the DB
     * @param \Entity\E_User_Basic $user
     */
    public static function set_user(\Entity\E_User_Basic $user)
    {
        $query = "INSERT INTO users SET ";
        parent::set($user, $query);
    }


    //----AGGIUNTE DA E_User_Basic----\\
    //----CONTROLLA BENE OGNI FUNZIONE E IMPLEMENTALE----\\

    /**
     * Creates a new Album. The creation date will be set to the current time()
     * automatically
     *
     * @param string $title The album title
     * @param string $description The album description
     * @param array or string $categories The album categories
     * @return \Entity\E_Album The $album just created
     */
    public function create_Album($title, $description, $categories)
    {
        //$album = new \Entity\E_Album($title, $description, $categories);
        //return $album;
    }


    public function get_Albums()
    {

    }


    public function remove_Album($Album_ID)
    {

    }


    /**
     * Creates a new Photo. With the following parameters:
     * Like number = 0
     * Creation Date = time()
     *
     * @param string $title The photo title
     * @param string $description The photo description
     * @param bool $is_reserved Whether the photo is reserved or public
     * @param array or string $categories The categories for the photo
     * @return \Entity\E_Photo The $photo just created
     */
    public function upload_photo($title, $description, $is_reserved, $categories)
    {

        //passaggio dei parametri a foundation che ritorna l'id della foto appena creata
        // $id from foundation
//        $photo = new \Entity\E_Photo($id, $title, $description, $is_reserved, $categories);
//        return $photo;
    }


    public function remove_Photo($photo_ID)
    {
        //call foundation
    }


    public function move_Photo($photo_ID, $target_Album)
    {
        $photo_ID->set_album($target_Album);
        // call foundation
    }


    /**
     * Adds a like to the photo
     * @param \Entity\E_Photo $photo_id The liked photo
     */
    public function add_like($photo_id)
    {
        // foundation insert like values ($this->id, $photo_id)
    }


    public function remove_like_from($photo_id)
    {
       // foundation delete from like where $this->id, $photo_id
    }

    public function add_comment($photo_id, $text)
    {
        // foundation insert comments values (photoid, text, $this->id)
    }


    public function remove_comment($comment_id)
    {
        // foundation delete from comments where comment_id
    }

}