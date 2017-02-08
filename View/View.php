<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace View;

require('lib/smarty/smarty.class.php');

class View extends Smarty
{

    /**
     * Costruttore della classe
     */
    public function __construct()
    {
        global $config;
        $this->Smarty();    //Non è un costruttore
        $this->template_dir = $config['smarty']['template_dir'];  //L'insieme di queste assegnazioni
        $this->compile_dir  = $config['smarty']['compile_dir'];   //serve all'oggetto Smarty per
        $this->config_dir   = $config['smarty']['config_dir'];    //conoscere la posizione di alcune
        $this->cache_dir    = $config['smarty']['cache_dir'];     //cartelle usate dal programma
        $this->caching = false;
    }


    /**
     * Questa funzione, restituisce il task inviato all'interno del vettore
     * superglobale $_REQUEST
     */
    public function getTask()
    {
        if (isset($_REQUEST['task']))
        {
            return $_REQUEST['task'];
        }
    }


    /**
     * @return mixed
     */
    public function getController()
    {
        if (isset($_REQUEST['controller']))
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



}