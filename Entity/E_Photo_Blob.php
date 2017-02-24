<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

class E_Photo_Blob
{

    /**
     * Generates a Thumbnail image in order to be stored in the DB
     *
     * @param string $source_Path The path to the image to resize
     * @param string $dest_Path The destination path of the thumbnail
     */
    public function generate_Thumbnail($source_Path, $dest_Path)
    {
        $max_width = THUMB_WIDTH;
        $max_height = THUMB_HEIGHT;
        $this->resize($source_Path, $dest_Path, $max_width, $max_height);
    }


    /**
     * Resizes an image. Used to generate Thumbnails and standardized Full Size images
     *
     * @param string $source_Path The source patht to get the image from
     * @param string $dest_Path The destination path where to output the resized image
     * @param int $MAX_WIDTH The desired resize width
     * @param int $MAX_HEIGHT The desired resize height
     * @return image The resized image
     */
    function resize($source_Path, $dest_Path, $MAX_WIDTH, $MAX_HEIGHT)
    {
        list($w, $h) = getImageSize($source_Path);
        list($new_W, $new_H) = $this->adapt_Dimensions($w, $h, $MAX_WIDTH, $MAX_HEIGHT);
        $outputImage = imageCreateTrueColor($new_W, $new_H);

        //Note about exif_imagetype:
        //"The return value is the same value that getimagesize() returns in index 2 but exif_imagetype() is much faster"
        $type = exif_ImageType($source_Path);
        switch($type)
        {
            case IMAGETYPE_JPEG:
                $img = imageCreateFromJPEG($source_Path);
                imageCopyResampled($outputImage, $img, 0, 0, 0, 0, $new_W, $new_H, $w, $h);
                imageJPEG($outputImage, $dest_Path);
                break;

            case IMAGETYPE_PNG:
                $img = imageCreateFromPNG($source_Path);
                imageCopyResampled($outputImage, $img, 0, 0, 0, 0, $new_W, $new_H, $w, $h);
                $this->preserve_PNG_Transparency($outputImage);
                imagePNG($outputImage, $dest_Path);
                break;
        }
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
    private function adapt_Dimensions($width, $height, $MAX_WIDTH, $MAX_HEIGHT)
    {
        //Image is bigger than the MAX
        if($height > $MAX_HEIGHT && $width > $MAX_WIDTH)
        {
            $ratio = $width / $height;
            if($ratio > 1) //Image is horizontal
            {
                $new_W = $MAX_WIDTH;
                $new_H = floor($new_W / $ratio);
            }
            else //Image is vertical or squared
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
    }


    /**
     * Checks whether the uploaded image is JPG, JPEG, PNG and less than MAX_SIZE_FULL
     *
     * @param string $source_Path The path where the image is actually stored
     * @return bool Whether the uploaded image is of right type and size
     */
    public function check_UploadedFile($source_Path)
    {
        $type = exif_ImageType($source_Path);
        switch($type)
        {
            case IMAGETYPE_JPEG:
            case IMAGETYPE_PNG:
                $type_Ok = TRUE;

            default:
                $type_Ok = FALSE;
        }

        $size = filesize($source_Path);
        if($size<MAX_SIZE_FULL)
        {
            $size_Ok = TRUE;
        }
        $size_Ok = FALSE;

        return ($type_Ok && $size_Ok);
    }

    




//
//use \Imagick;
//
///**
// * Handles basic functions to generate a thumbnail of a photo and checks whether
// * the image is a valid image to be uploaded
// */
//class E_Photo_Blob
//{
//    private $fullsize;
//    private $thumbnail;
//    private $size;
//    private $type;
//
//
//    /**
//     * Generates a photo blob object
//     *
//     * @param string $path The path to the photo uploaded
//     * @param int $size The photo size
//     * @param string $type The photo type
//     */
//    public function generate($path, $size, $type)
//    {
//        if(realpath($path) === FALSE)
//        {
//            throw new \Exceptions\photo_details(0, $path);
//        }
//        $this->set_Fullsize($path);
//        $this->set_Thumbnail($path);
//
//        if($size > MAX_SIZE)
//        {
//            throw new \Exceptions\photo_details(1, $size);
//        }
//        $this->set_Size($size);
//        $this->set_Type($type);
//    }
//
//
//    /**
//     * Sets the fullsize image from the path given as parameter
//     *
//     * @param string $path The path to the photo
//     * @throws \Exceptions\photo_details Whether the path to the photo is incorrect
//     */
//    public function set_Fullsize($path)
//    {
//        $this->fullsize = realpath($path);
//    }
//
//
//    /**
//     * Returns the fullsize photo
//     *
//     * @return image The fullsize photo
//     */
//    public function get_Fullsize()
//    {
//        return $this->fullsize;
//    }
//
//
//    /**
//     * Creates and sets a thumbnail image
//     *
//     * @param string $path The path to the photo
//     */
//    public function set_Thumbnail($path)
//    {
//        echo("Sono la set_Thumbnail".nl2br("\r\n"));
//        $imagick = new \Imagick(realpath($path));
//        echo("Ho instanziato l'oggetto Imagick".nl2br("\r\n"));
//        $width = THUMBNAIL_WIDTH;
//        $height = THUMBNAIL_HEIGHT;
//        $best_Fit = TRUE;
//        $fill = TRUE;
//        $imagick->thumbnailImage($width, $height, $best_Fit, $fill);
//        echo("Ho fatto la thumbnailImage".nl2br("\r\n"));
//
//        $this->thumbnail = $path;
//        echo("L'ho assegnata a \$this->thumbnail".nl2br("\r\n"));
//    }
//
//
//    /**
//     * Retrieves the thumbnail created for the photo
//     *
//     * @return image The thumbnail of the photo
//     */
//    public function get_Thumbnail()
//    {
//        return $this->thumbnail;
//    }
//
//
//    /**
//     * Sets the size of the photo
//     *
//     * @param int $size The size of the photo
//     */
//    public function set_Size($size)
//    {
//        $this->size = $size;
//    }
//
//
//    /**
//     * Retrieves the size of the photo
//     *
//     * @return int The size of the photo
//     */
//    public function get_Size()
//    {
//        return $this->size;
//    }
//
//
//    /**
//     * Sets the type of the photo
//     *
//     * @param string $type The type of the photo
//     */
//    public function set_Type($type)
//    {
//        $this->type = $type;
//    }
//
//
//    /**
//     * Retrieves the type of the photo. To be used to show the correct HTML Header
//     *
//     * @return string The type of the photo
//     */
//    public function get_Type()
//    {
//        return $this->type;
//    }
//
}