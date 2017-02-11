<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove\Scartate;

class ScartataE_Photo
{

    /**
     * Returns the total of likes received
     *
     * @return int The number of likes received
     */
    public function get_Total_Likes()
    {
        return count($this->total_likes);
    }


    /**
     * Adds a like to the current Photo
     *
     * @param string $username The user's username that likes the photo
     */
    public function add_Like($username)
    {
        array_push($this->total_likes, $username);
    }


    /**
     * Removes a like from the current Photo
     *
     * @param string $username The user that wants to remove the like from this photo
     */
    public function remove_Like($username)
    {
        $user_key = array_search($username, $this->total_likes);
            if ($user_key !== FALSE) //Exists in the "likes" array
            {
                unset($this->categories[$user_key]);
            }
        $this->total_likes = array_values($this->total_likes); //Ordinates the array without any gaps in between the keys
    }

}