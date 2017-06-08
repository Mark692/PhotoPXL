<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

use Exceptions\uploads;
use const MAX_SIZE_FULL;
use const THUMB_HEIGHT;
use const THUMB_WIDTH;

/**
 * This class enables to process uploaded data
 */
class E_Photo_Blob
{
    private $fullsize;
    private $thumbnail;
    private $size;
    private $type;


    /**
     * Checks the image, throws exceptions in case the type is not allowed or the
     * size is too big, finally sets the attributes the the E_Photo_Blob object
     *
     * @param string $source_Path The path to the image to save
     * @throws uploads Whether size and/or type are not allowed
     */
    public function on_Upload($source_Path)
    {
        $type = $this->check_Type($source_Path);
        if($type === FALSE)
        {
            throw new uploads(0);
        }
        $this->set_Type($type);

        $size = $this->check_Size($source_Path);
        if($size === FALSE)
        {
            throw new uploads(1);
        }
        $this->set_Size($size);
        $this->set_Fullsize($source_Path);
        $thumbnail = $this->generate_Thumbnail($source_Path);
        $this->set_Thumbnail($thumbnail);
    }


    /**
     * Sets the fullsize image from the path given as parameter
     *
     * @param string $path The path to the photo
     */
    private function set_Fullsize($path)
    {
        $this->fullsize = file_get_contents(realpath($path));
    }


    /**
     * Returns the fullsize photo
     *
     * @return resource The fullsize photo
     */
    public function get_Fullsize()
    {
        return $this->fullsize;
    }


    /**
     * Sets a thumbnail image
     *
     * @param resource $thumb_Image The thumbnail image
     */
    private function set_Thumbnail($thumb_Image)
    {
        $this->thumbnail = $thumb_Image;
    }


    /**
     * Retrieves the thumbnail created for the photo
     *
     * @return resource The thumbnail of the photo
     */
    public function get_Thumbnail()
    {
        return $this->thumbnail;
    }


    /**
     * Sets the size of the photo
     *
     * @param int $size The size of the photo
     */
    private function set_Size($size)
    {
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
    private function set_Type($type)
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


    /**
     * Generates a Thumbnail image in order to be stored in the DB
     *
     * @param string $source_Path The path to the image to resize
     * @return resource The resized image
     */
    private function generate_Thumbnail($source_Path)
    {
        $max_width = THUMB_WIDTH;
        $max_height = THUMB_HEIGHT;
        return $this->resize($source_Path, $max_width, $max_height);
    }


    /**
     * Resizes an image. Used to generate Thumbnails and standardized Full Size images
     *
     * @param string $source_Path The source patht to get the image from
     * @param int $MAX_WIDTH The desired resize width
     * @param int $MAX_HEIGHT The desired resize height
     * @return resource The resized image
     */
    private function resize($source_Path, $MAX_WIDTH, $MAX_HEIGHT)
    {
        list($w, $h, $type) = getimagesize($source_Path);
        list($new_W, $new_H) = $this->adapt_Dimensions($w, $h, $MAX_WIDTH, $MAX_HEIGHT);

        switch($type)
        {
            case IMAGETYPE_JPEG:
                $src = imagecreatefromjpeg($source_Path);
                break;

            case IMAGETYPE_PNG:
                $src = imagecreatefrompng($source_Path);
                break;

            default:
                return '';
        }

        $tmp = imagecreatetruecolor($new_W, $new_H);

        /* Check if this image is PNG, then set if Transparent */
        if($type == IMAGETYPE_PNG)
        {
            $this->preserve_PNG_Transparency($tmp);
        }

        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $new_W, $new_H, $w, $h);

        ob_start();
        switch($type)
        {
            case IMAGETYPE_JPEG:
                imagejpeg($tmp, NULL); //Default quality: 75%
                break;

            case IMAGETYPE_PNG:
                imagepng($tmp, NULL); //Default compression
                break;

            default: echo '';
                break;
        }
        $final_image = ob_get_contents();
        ob_end_clean();

        return $final_image;
    }


    /**
     * Adapts the given dimensions to fit the MAX values given
     *
     * @param int $width The original image width
     * @param int $height The original image height
     * @param int $MAX_WIDTH The max output width
     * @param int $MAX_HEIGHT The max output height
     * @return array An array with the new Width and Height
     */
    public function adapt_Dimensions($width, $height, $MAX_WIDTH, $MAX_HEIGHT)
    {
        //Image is bigger than the MAX
        if($height > $MAX_HEIGHT || $width > $MAX_WIDTH)
        {
            $ratio = $width / $height;
            $w_rat = $width / $MAX_WIDTH;
            $h_rat = $height / $MAX_HEIGHT;
                if($w_rat >= $h_rat)
                {
                    $new_W = $MAX_WIDTH;
                    $new_H = floor($new_W / $ratio);
                }
                else
                {
                    $new_H = $MAX_HEIGHT;
                    $new_W = floor($new_H * $ratio);
                }
        }
        else //Image is smaller than the MAX
        {
            $new_W = $width;
            $new_H = $height;
        }
        return array($new_W, $new_H);
    }


    /**
     * Preserves the PNG images transparency
     *
     * @param resource $image The image to keep the transparency
     */
    private function preserve_PNG_Transparency($image)
    {
        $red = 0;
        $green = 0;
        $blue = 0;
        $fullyTransparent = 127;
        imageColorTransparent($image, imageColorAllocateAlpha($image, $red, $green, $blue, $fullyTransparent));
        imageAlphaBlending($image, FALSE);
        imageSaveAlpha($image, TRUE);

    //----ALTERNATIVELY----\\

//        imagealphablending($tmp, false);
//        imagesavealpha($tmp, true);
//        $transparent = imagecolorallocatealpha($image, 255, 255, 255, 127);
//        imagefilledrectangle($image, 0, 0, $new_W, $new_H, $transparent);

    //----ALTERNATIVELY----\\
    }


    /**
     * Checks whether the uploaded image has an allowed extention
     *
     * @param string $source_Path The path to the uploaded image
     * @return mixed The int type of the image or FALSE in case it's not supported/allowed
     */
    private function check_Type($source_Path)
    {
        $type = exif_ImageType($source_Path);
        if($type === IMAGETYPE_JPEG || $type === IMAGETYPE_PNG)
        {
            return $type;
        }
        return FALSE;
    }


    /**
     * Checks whether the uploaded image is smaller than the max allowed size
     *
     * @param string $source_Path The path to the uploaded image
     * @return mixed The size of the image or FALSE in case it's too big
     */
    private function check_Size($source_Path)
    {
        $size = filesize($source_Path);
        if($size < MAX_SIZE_FULL)
        {
            return $size;
        }
        return FALSE;
    }
}