<?php

/**
 * @access public
 * @package View
 */

namespace View;

class V_Registration extends V_Home
{
    // METODI STATICI \\
    /**
     * visualizza una banner di errore
     * @param type $messaggio
     */
    //da verificare perchè esiste una simile anche in v-home
    public static function error()
    {
        $v = new V_Basic();
        $home = new V_Home();
        $banner = $home->fetch_banner($tpl = 'banner_error');
        $v->assign('banner', $banner);
        \View\V_Home::standardHome();
    }


    // METODI NON STATICI \\
    /**
     * Grazie a questa funzione all'interno della variabile $dati_reg vengono
     * registrati tutti i dati inviati tramite POST dal modulo di registrazione
     *
     * @return array

      public function get_Dati()
      {
      $keys = array ('username', 'password', 'email');
      return parent::get_Dati($keys);
      }
     */
}