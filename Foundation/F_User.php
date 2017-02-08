<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Foundation;

//use \PDO; //Per evitare errori con l'autoloader

/**
 * This class contains basic functions to be inherited and overridden by
 * child classes
 */
class F_User extends \Foundation\F_Database
{

    /**
     * Inserts the user into "users" DB table
     *
     * @param \Entity\E_User_* $e_user The user to insert into the DB
     */
    public static function insert($e_user)
    {
        //PRO, MOD, Admin user setup
        $query = 'INSERT INTO `users` SET '
                .'`username`=?, '
                .'`password`=?, '
                .'`email`=?, '
                .'`role`=?';

        $role = $e_user->get_Role();
        $toBind = array( //Array to pass at the parent::set() function to Bind the correct parameters
            $e_user->get_Username(),
            $e_user->get_Password(),
            $e_user->get_Email(),
            $role);

        //STANDARD user setup
        if($role === \Utilities\Roles::STANDARD)
        {
            $query .= ', '
                .'`last_Upload`=?, '
                .'`up_Count`=?';

        array_push($toBind, $e_user->get_Last_Upload());
        array_push($toBind, $e_user->get_up_Count());
        }

        parent::insert($query, $toBind);
    }


    /**
     * Retrives all the users that match the query
     *
     * @param array $arr_values The values to search with the query
     * @param bool $fetchAll Whether to get 1 (FALSE) or all (TRUE) the records that match the query
     * @param string $orderBy The table column chosen to order the results
     * @param string $orderStyle The ASCendent or DESCendent style to return the results. Allowed values: ASC or DESC
     */
    public static function get($arr_values, $fetchAll=FALSE, $orderBy='', $orderStyle="ASC")
    {
        $DB_table = "users";
        return parent::get($arr_values, $DB_table, $fetchAll, $orderBy, $orderStyle);
    }


    /**
     * Updates a record from the "users" table
     *
     * @param array $new_user The ARRAY containing the new user details got from "View"
     * @param array $old_user The ARRAY containing the old user details. The array "old user" is the DB record got from the get_by()
     * @param string $where_column The column to refer to make changes in the table
     */
    public static function update($new_user, $old_user, $where_column="username")
    {
        $DB_table = "users";
        parent::update($new_user, $old_user, $DB_table, $where_column);
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