<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Entity;

//include SmartImage.class.php;

class E_Photo_Blob
{
//----------------------------------------------------------------------------\\
//----------------------------------------------------------------------------\\
//----------------------------------------------------------------------------\\
//----------------------------------------------------------------------------\\
//----------------------------------------------------------------------------\\
//----------------------------------------------------------------------------\\

    function generate_Thumbnail($source_Path, $dest_Path, $THUMB_width, $THUMB_height, $crop = 0)
    {
        //The return value is the same value that getimagesize() returns in index 2 but exif_imagetype() is much faster
        $type = exif_imagetype($source_Path);
        if($type !== FALSE)
        {
            switch($type)
            {
                case IMAGETYPE_JPEG:
                    $img = imagecreatefromjpeg($source_Path);
                    break;

                case IMAGETYPE_PNG:
                    $img = imagecreatefrompng($source_Path);
                    break;

                default:
                    return FALSE;
            }
        }

        list($SOURCE_Width, $SOURCE_Height) = getimagesize($source_Path);



        // resize
        if($crop)
        {
            $ratio = floor(FULL_WIDTH / $width);
            $width_new = $ratio * $width;
            $height_new = $ratio * $THUMB_height;











            if($SOURCE_Width < $THUMB_width or $SOURCE_Height < $THUMB_height)
            {
                return "Picture is too small!";
            }
            $ratio = max($THUMB_width / $SOURCE_Width, $THUMB_height / $SOURCE_Height);
            $SOURCE_Height = $THUMB_height / $ratio;
            $x = ($SOURCE_Width - $THUMB_width / $ratio) / 2;
            $SOURCE_Width = $THUMB_width / $ratio;
        }
        else
        {
            if($SOURCE_Width < $THUMB_width and $SOURCE_Height < $THUMB_height)
            {
                return "Picture is too small!";
            }
            $ratio = min($THUMB_width / $SOURCE_Width, $THUMB_height / $SOURCE_Height);
            $THUMB_width = $SOURCE_Width * $ratio;
            $THUMB_height = $SOURCE_Height * $ratio;
            $x = 0;
        }

        $new = imagecreatetruecolor($THUMB_width, $THUMB_height);

        // preserve transparency
        if($type === IMAGETYPE_PNG)
        {
            imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
            imagealphablending($new, false);
            imagesavealpha($new, true);
        }

        imagecopyresampled($new, $img, 0, 0, 0, 0, $THUMB_width, $THUMB_height, $SOURCE_Width, $SOURCE_Height);

        switch($type)
        {
            case 'bmp': imagewbmp($new, $dest_Path);
                break;
            case 'gif': imagegif($new, $dest_Path);
                break;
            case 'jpg': imagejpeg($new, $dest_Path);
                break;
            case 'png': imagepng($new, $dest_Path);
                break;
        }
        return true;
    }


//----------------------------------------------------------------------------\\
//----------------------------------------------------------------------------\\
//----------------------------------------------------------------------------\\
//----------------------------------------------------------------------------\\
//----------------------------------------------------------------------------\\
//----------------------------------------------------------------------------\\















    public function generateThumbnail($path)
    {
        $img = new \SmartImage($path);
        // Ridimensionamento e salvataggio su file
        // il valore true dice di tagliare l'immagine
        $img->resize(400, 220, true);
        $img->saveImage("Dio è porco.jpg", 85);
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