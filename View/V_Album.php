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
     * @param int $E_album The album object to rethrive the details from
     * @param array $array_photos
     *               How to access the array:
     *               - "id" => the photo's ID
     *               - "thumbnail" => its thumbnail
     *               - "type" => the user uploader
     *               - "tot_photo" => the number of photos
     * @param string $user_Watching The user who's trying to view the album
     */
    public static function album($E_album, $array_photos, $user_Watching) //QUESTA FUNZIONE NON VA BENE.
    {
        $home=new V_Home();
        $home->assign('user_datails',$user_Watching); //Assegna un NOME UTENTE (string), va bene???

        $album_details=$home->album_details($E_album);
        $home->assign('album_details', $album_details);

        $thumbnail=$home->thumbnail($array_photos);
        $home->assign('thumbnail', $thumbnail);

        $role= \Entity\E_User::get_DB_Role($user_Watching);

        $home->set_Cont_menu_user($home->imposta_ruolo($role));
        $home->set_Contenuto_Home($tpl = 'Album');
        $home->display('home_default.tpl');
        //$array_photo=$home->thumbnail($array_photo);
        //$v->assign('array_photo',$array_photo);
    }



    //METODI BASE - NON STATICI!!!\\


    /**
     * Grazie a questa funzione all'interno della variabile $dati_reg vengono
     * registrati tutti i dati inviati tramite POST dal modulo di registrazione
     *
     * @return array
     */
    public function get_Dati()
    {
        $keys = array ('title', 'description', 'categories');
        return parent::get_Dati($keys);
    }


    /**
     * Questa funzione, restituisce l'id della foto inviato all'interno del vettore
     * superglobale $_REQUEST
     */
    public function get_ID_Album()
    {
        if(isset($_REQUEST['id_album']))
        {
            return $_REQUEST['id_album'];
        }
    }


    /*
     * restituisce il contento del tpl in base all'utente
     * nn lo so che fa questa
     */
    public function set_album_tpl($album, $thumbnail,$array_user)
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
        $v->assign('user_details',$array_user);
        $role=$array_user['role'];
        $role=$this->imposta_ruolo($role);
        $this->home($role, $tpl='album');
    }


}
