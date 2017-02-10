<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove;
//
//class TF_Album extends \Foundation\F_Database
class TF_Album extends TFun
{

    public function T_set_get_Cat()
    {
        $separate = nl2br("\r\n")."----------------------------------------------".nl2br("\r\n").nl2br("\r\n");

        echo(nl2br("\r\n")."Query set: ".self::set_Categories(parent::rnd_array(), 1));
        echo($separate);
        echo(nl2br("\r\n")."Query remove: ".self::remove_Categories(parent::rnd_array(), 1));
        echo($separate);
    }


    public function Test_GetByCats()
    {
        $separate = nl2br("\r\n")."----------------------------------------------".nl2br("\r\n").nl2br("\r\n");

        echo(nl2br("\r\n").self::get_By_Categories(parent::rnd_array(), 1));
        echo($separate);
    }


    public function Test_update()
    {
//        $new = array(2, 4, 6, 7, 8);
//        $old = array(2, 4, 6, 7, 8);

        $new = [];
        $old = [];
        return self::update_Categories($new, $old, 1);
    }


    /**
     * Rethrives all the album with the selected categories
     *
     * @param enum or array $cats The category/ies to search
     */
    public function get_By_Categories($cats)
    {
        echo(nl2br("\r\n").nl2br("\r\n")."TEST get_By_Categories".nl2br("\r\n").nl2br("\r\n")); //||\\
        echo("Categorie scelte: "); //||\\
        print_r($cats); //||\\

        $where = '';
        foreach ((array) $cats as $v)
        {
            $where .= '(`category`=?) OR ';

            echo(nl2br("\r\n").'Valore dell\'array $cats attuale: '.$v); //||\\
        }
        $where = substr($where, 0, -4); //Removes the " OR " at the end of the string

        $query = "SELECT * "
                ."FROM `album` "
                ."WHERE `id` in ("
                    ."SELECT `album` "
                    ."FROM `cat_album` "
                    .'WHERE '.$where
                    .")";

        echo(nl2br("\r\n")."La query completa è: ".$query); //||\\

//        $pdo = parent::connettiti();
//        $pdo_stmt = $pdo->prepare($query);
//        $pdo_stmt = parent::bind_params($pdo_stmt, $cats);
//        $pdo_stmt->execute();
//
//        $pdo = NULL; //Closes DB connection
//        return $pdo_stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Updates the categories of an album. This function both add new categories
     * and remove old categories (if selected) from the album
     *
     * @param enum or array $new_cats The new category/ies chosen for the album
     * @param enum or array $old_cats The category/ies to remove from the album
     * @param int $album_ID The album's ID to whom set/remove the categories
     * @throws \Exceptions\InvalidAlbumInfo In case there are no categories to add neither to remove
     */
    public function update_Categories($new_cats, $old_cats, $album_ID)
    {
        echo(nl2br("\r\n")."TEST UPDATE: "); //||\\


        $to_add    = array_diff((array) $new_cats, (array) $old_cats);
        $to_remove = array_diff((array) $old_cats, (array) $new_cats);


        echo(nl2br("\r\n")."NUOVE categorie: "); //||\\
        print_r($new_cats); //||\\
        echo(nl2br("\r\n")."VECCHIE categorie: "); //||\\
        print_r($old_cats); //||\\
        echo(nl2br("\r\n")."TO ADD: "); //||\\
        print_r($to_add); //||\\
        echo(nl2br("\r\n")."TO REMOVE: "); //||\\
        print_r($to_remove); //||\\
        echo(nl2br("\r\n")."Count di TO_ADD    = ".count($to_add)); //||\\
        echo(nl2br("\r\n")."Count di TO_REMOVE = ".count($to_remove)); //||\\


        if(count($to_add)>=1 && count($to_remove)>=1)
        {
            $query_ADD = self::set_Categories($to_add, $album_ID);
            $query_DEL = self::remove_Categories($to_remove, $album_ID);
            $query = $query_ADD."; ".$query_DEL;
            $toBind = array_merge($to_add, $to_remove);


            echo(nl2br("\r\n")."Primo if: entrambi i count sono >= 1"); //||\\
            echo(nl2br("\r\n")."Query ADD: ".$query_ADD); //||\\
            echo(nl2br("\r\n")."Query DEL: ".$query_DEL); //||\\
            echo(nl2br("\r\n")."Query Completa: ".$query); //||\\
            echo(nl2br("\r\n")."Array toBind: "); //||\\
            print_r($toBind); //||\\

        }
        elseif(count($to_add)>=1 && count($to_remove)<1)
        {
            $query = self::set_Categories($to_add, $album_ID); // =$query_ADD;
            $toBind = $to_add;


            echo(nl2br("\r\n")."Secondo if: ADD>=1, REMOVE<1"); //||\\
            echo(nl2br("\r\n")."Query Completa: ".$query); //||\\
            echo(nl2br("\r\n")."Array toBind: "); //||\\
            print_r($toBind); //||\\

        }
        elseif(count($to_add)<1 && count($to_remove)>=1)
        {
            $query = self::remove_Categories($to_remove, $album_ID); // =$query_DEL
            $toBind = $to_remove;


            echo(nl2br("\r\n")."Terzo if: ADD<1, REMOVE>=1"); //||\\
            echo(nl2br("\r\n")."Query Completa: ".$query); //||\\
            echo(nl2br("\r\n")."Array toBind: "); //||\\
            print_r($toBind); //||\\

        }
        else
        {
//            throw new \Exceptions\InvalidAlbumInfo(0, array_merge($new_cats, $old_cats));
            echo(nl2br("\r\n")."TUTTO HA FALLITO. VIENE LANCIATA L'ECCEZIONE!!"); //||\\
        }
//        parent::execute_query($query, $toBind);
    }


    /**
     * Sets the album categories. To be used on album creation
     *
     * @param string/array $cat The category/ies chosen for the album
     * @param int $album_ID The album's ID to whom set the categories
     * @return string The query used to add categories to the album
     */
//    private static function set_Categories($cat, $album_ID)

    PUBLIC function set_Categories($cat, $album_ID) //||\\
    {
        $query = "INSERT INTO `cat_album` (`album`, `category`) VALUES ";

        foreach ((array) $cat as $value)
        {
            $query .= "('$album_ID', ?),";
        }

        return $query = substr($query, 0, -1); //Trims the last ","
    }


    /**
     * Removes the selected categories from the album
     *
     * @param enum or array $cats The category/ies to remove from the album selected
     * @param int $album_ID The album to modify and remove categories from
     * @return string The query used to remove categories from the album
     */
    //private static function remove_Categories($cats, $album_ID)

    PUBLIC function remove_Categories($cats, $album_ID) //||\\
    {
        $query = "DELETE FROM `cat_album` "
                ."WHERE (`album`=$album_ID) "
                ."AND (";

        foreach ((array) $cats as $value)
        {
            $query .= "(`category`=?) OR ";
        }

        return substr($query, 0, -4).")"; //Trims the last " OR " and closes the paranthesys
    }
}