<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

/**
 * Handles basic functions to generate a thumbnail of a photo and checks whether
 * the image is a valid image to be uploaded
 */
class E_Photo_Blob
{
    private $fullsize;
    private $thumbnail;
    private $size;
    private $type;


    /**
     * Instantiates a photo blob object
     *
     * @param string $path The path to the photo uploaded
     * @param int $size The photo size
     * @param string $type The photo type
     */
    public function __construct($path, $size, $type)
    {
        $this->set_Fullsize($path);
        $this->set_Thumbnail($path);
        $this->set_Size($size);
        $this->set_Type($type);
    }


    /**
     * Sets the fullsize image from the path given as parameter
     *
     * @param string $path The path to the photo
     * @throws \Exceptions\photo_details Whether the path to the photo is incorrect
     */
    public function set_Fullsize($path)
    {
        if(realpath($path)===FALSE)
        {
            throw new \Exceptions\photo_details(0, $path);
        }
        $this->fullsize = realpath($path);
    }


    /**
     * Returns the fullsize photo
     *
     * @return image The fullsize photo
     */
    public function get_Fullsize()
    {
        return $this->fullsize;
    }


    /**
     * Creates and sets a thumbnail image
     *
     * @param string $path The path to the photo
     * @throws \Exceptions\photo_details Whether the path is incorrect
     */
    public function set_Thumbnail($path)
    {
        if(realpath($path)===FALSE)
        {
            throw new \Exceptions\photo_details(1, $path);
        }
        $imagick = new \Imagick(realpath($path));
        $width = THUMBNAIL_WIDTH;
        $height = THUMBNAIL_HEIGHT;
        $best_Fit = TRUE;
        $fill = TRUE;
        $imagick->thumbnailImage($width, $height, $best_Fit, $fill);

        $this->thumbnail = $path;
    }


    /**
     * Retrieves the thumbnail created for the photo
     *
     * @return image The thumbnail of the photo
     */
    public function get_Thumbnail()
    {
        return $this->thumbnail;
    }


    /**
     * Sets the size of the photo
     *
     * @param int $size The size of the photo
     * @throws \Exceptions\photo_details Whether the size is over the maximum allowed
     */
    public function set_Size($size)
    {
        if($size>MAX_SIZE)
        {
            throw new \Exceptions\photo_details(2, $size);
        }
        $this->size = $size;
    }


    /**
     * Retrieves the size of the photo
     *
     * @return int The size of the photo
     */
    public function get_Size()
    {
        return $this->size;
    }


    /**
     * Sets the type of the photo
     *
     * @param string $type The type of the photo
     */
    public function set_Type($type)
    {
        $this->type = $type;
    }


    /**
     * Retrieves the type of the photo. To be used to show the correct HTML Header
     *
     * @return string The type of the photo
     */
    public function get_Type()
    {
        return $this->type;
    }
}