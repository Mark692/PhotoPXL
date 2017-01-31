<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

/**
 * This class defines the basic functions of each user
 */
class E_User_Basic extends E_User
{

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
        $album = new \Entity\E_Album($title, $description, $categories);
        return $album;
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
        $photo = new \Entity\E_Photo($title, $description, $is_reserved, $categories);
        return $photo;
    }


    public function remove_Photo($photo_ID)
    {

    }


    public function move_Photo($photo_ID, $target_Album)
    {
        $photo_ID->set_album($target_Album);
    }


    /**
     * Adds a like to the photo
     * @param \Entity\E_Photo $photo The liked photo
     */
    public function add_like($photo)
    {
        $photo->add_like();
    }


    public function remove_like_from($photo)
    {
        $photo->remove_like();
    }

    public function add_comment($photo, $text)
    {
        $photo->add_comment($text);
    }


    public function remove_comment_from($photo)
    {

    }

}