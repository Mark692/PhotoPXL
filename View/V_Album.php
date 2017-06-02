<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

class V_Album extends V_Home
{
    //METODI STATICI \\
    /**
     * Funzione per restituire la vista di un album
     * @param array $DB_album The album object to rethrive the details from
     * @param array $array_photo
     *               How to access the array:
     *               - "id" => the photo's ID
     *               - "thumbnail" => its thumbnail
     *               - "type" => the user uploader
     *               - "tot_photo" => the number of photos
     * @param string $username The user who's trying to view the album
     */
    public static function album($DB_album, $array_photo, $username)
    {
        $home = new \View\V_Home();
        //i dettagli di photo come titolo etc è un oggetto
        $home->assign('username', $username);
        $album_details = $home->album_details($DB_album);
        $home->assign('album_details', $album_details);
        $user_album=$DB_album['username'];
        $home->assign('user_album',$user_album);
        $cat = $home->imposta_categoria($album_details['categories']);
        $home->assign('categories', $cat);
        $home->assign('array_photo', $home->thumbnail($array_photo));
        $home->set_Cont_menu_user($home->imposta_ruolo(\Entity\E_User::get_DB_Role($username)));
        $home->set_Contenuto_Home($tpl = 'Album');
        $home->display('home_default.tpl');
    }


    //METODI BASE - NON STATICI!!!\\

/*
     * restituisce il contento del tpl in base all'utente
     * nn lo so che fa questa
     */
    public function set_album_tpl($album, $thumbnail, $array_user)
    {
        $v = new \V_Basic();
        $page_tot = ceil($thumbnail['tot_photo'] / PHOTOS_PER_PAGE);
        $v->assign('id', $thumbnail['id']);
        $v->assign('thumbnail', $thumbnail['thumbnail']);
        $v->assign('page_tot', $page_tot);
        $v->assign('title', $album['title']);
        $v->assign('description', $album['description']);
        $categorie = $this->imposta_categoria($album['categories']); //dal numero alla stringa
        $v->assign('categories', $categorie);
        $v->assign('user_details', $array_user);
        $role = $array_user['role'];
        $role = $this->imposta_ruolo($role);
        $this->home($role, $tpl = 'album');
    }


}