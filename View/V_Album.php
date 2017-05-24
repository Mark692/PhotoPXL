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

    //A BENEDETTA SERVE LA FUNZIONE STATICA ::album() PER DARE LA SCHERMATA QUANDO SI ENTRA NELL'ALBUM
    /*
     * funzione per restituire la vista di un album
     */
    public static function album($album,$thumbnail,$user_datails) //QUESTA FUNZIONE NON VA BENE.
    //BENEDETTA PASSA 2 PARAMETRI:
    //1 - L'ID DELL'ALBUM
    //2 - UN ARRAY. OVVERO IL RISULTATO DELLA FUNZIONE E_Photo::get_By_Album($album_ID, $user_Watching, $user_Role, $page_toView=1, $order_DESC=FALSE)
            //CHE RESTITUISCE UN ARRAY CON I SEGUENTI PARAMETRI:
            /*    * @return array An array with photo IDs and thumbnails.
     *               How to access the array:
     *               - "id" => the photo's ID
     *               - "thumbnail" => its thumbnail
     *               - "type" => the user uploader
     *               - "tot_photo" => the number of photos
             * */
            //IN BASE A QUELLO CHE TI PASSA BENEDETTA DOVRESTI SCRIVERE
            //public static function album($album_ID, $array_di_Miniature_delle_foto_nell_album)
    {
        //dubbio esistenziale...l'oggetto $album contiene le thumbanil
        $home=new V_Home();
        $home->assign('username',$user_datails['username']);
        $home->assign('album', $album);
        $home->assign('thumbnail', $thumbnail);
        $home->set_Cont_menu_user($home->imposta_ruolo($user_datails['role']));
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
