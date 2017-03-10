<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

use Smarty;
use Utilities\Roles;

require('libs/Smarty.class.php');

class V_Basic extends Smarty
{
    /**
     * Costruttore della classe
     */
    public function __construct()
    {
//        $this->smarty();
        global $config;
//        $this->Smarty();
        $this->template_dir = $config['smarty']['template_dir'];  //L'insieme di queste assegnazioni
        $this->compile_dir = $config['smarty']['compile_dir'];   //serve all'oggetto Smarty per
        $this->config_dir = $config['smarty']['config_dir'];    //conoscere la posizione di alcune
        $this->cache_dir = $config['smarty']['cache_dir'];     //cartelle usate dal programma
        $this->caching = false;
    }


    /**
     * Grazie a questa funzione all'interno della variabile $dati_reg vengono
     * registrati tutti i dati inviati tramite POST dal modulo di registrazione
     * @param string or array $keys Description chiavi usate per cercare
     * @return array
     */
    public function get_Dati($keys)
    {
        $total = array_merge($_REQUEST, $_FILES);
        foreach($keys as $dato)
        {
            $dettagli[$dato] = $total[$dato];
        }
        return $dettagli;
    }


    /**
     * Questa funzione, restituisce il task inviato all'interno del vettore
     * superglobale $_REQUEST
     */
    public function getTask()
    {
        if(isset($_REQUEST['task']))
        {
            return $_REQUEST['task'];
        }
    }


    /**
     * @return mixed
     */
    public function getController()
    {
        if(isset($_REQUEST['controller']))
        {
            return $_REQUEST['controller'];
        }
//        return FALSE;
    }


    /**
     * Ritorna il contenuto del template che si vuole visualizzare
     * Questa funzione va sovrascritta nelle classi figlie impostando $nome_template
     *
     * @return tpl content
     */
    public function processa_Template($nome_template)
    {
        $contenuto = $this->fetch($nome_template.'.tpl');
        return $contenuto;
    }


    /**
     * Assegna a smarty i dati della registrazione passati come parametro
     *
     * @param array $dati
     * @param int $data
     */
    public function set_Dati($dati)
    {
        $this->assign('username', $dati['username']);
        $this->assign('email', $dati['email']);
    }


    /**
     * dal valore numerico mi ritorna un array con stringhe
     * @param type $role
     * @return array
     */
    public function imposta_ruolo($role = [0, 1, 2, 3, 4])
    {
        $cost = [];
        foreach($role as $valore)
        {
            switch ($valore)
            {
                case Roles::BANNED:
                    $ruolo = "bannato";
                    break;

                case Roles::STANDARD:
                    $ruolo = "standard";
                    break;

                case Roles::PRO:
                    $ruolo = "pro";
                    break;

                case Roles::MOD:
                    $ruolo = "mod";
                    break;

                case Roles::ADMIN:
                    $ruolo = "admin";
                    break;
                default :
                    $ruolo= "ospite";
            }
            array_push($cost, $ruolo);
        }
        return $cost;
    }


    /**
     * trasforma le stringe in numeri per i ruoli
     * @param array $role
     * @return array
     */
    public function reimposta_ruolo($role)
    {
        $cost = [];
        foreach($role as $valore)
        {
            array_push($cost, constant(strtoupper(trim($valore))));
        }
        return $cost;
    }


    /**
     * dal valore numerico mi ritorna un array con scritte
     * @param array $categories
     * @return array
     */
    public function imposta_categoria($categories = [1, 2, 3, 4, 5, 6, 7, 8])
    {
        $cost = [];
        foreach($categories as $valore)
        {

            switch ($valore)
            {
                case Roles::BANNED:
                    $categoria = "Paesaggi";
                    break;

                case Roles::STANDARD:
                    $categoria = "Ritratti";
                    break;

                case Roles::PRO:
                    $categoria = "Fauna";
                    break;

                case Roles::MOD:
                    $categoria = "Bianco e Nero";
                    break;

                case Roles::ADMIN:
                    $categoria = "Astronomia";
                    break;
                case Roles::ADMIN:
                    $categoria = "Street";
                    break;
                case Roles::ADMIN:
                    $categoria = "Natura Morta";
                    break;
                case Roles::ADMIN:
                    $categoria = "Sport";
                    break;
            }
            array_push($cost, $categoria);
        }
        return $cost;
    }


    /**
     * trasforma le stringe in numeri per le categorie
     */
    public function reimposta_categorie($categories)
    {
        $cost = [];
        foreach($categories as $valore)
        {
            array_push($cost, constant(strtoupper(trim($valore))));
        }
        return $cost;
    }
    /**
     * imposta i dati nel template identificati da una chiave ed il relativo valore
     * @param type $key
     * @param type $valore
     */
    public function impostaDati($key,$valore) {
        $this->assign($key,$valore);
    }


}