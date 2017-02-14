<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Prove\Aggiungere;

class Mostra_Foto_per_Pagina
{
    /**
     * Restituisce il numero di pagine totali e le foto da visualizzare
     *
     * @param array $array_PhotoDB L'array di foto proveniente dal DB
     * @param int $numero_pagina Pagina dalla quale partire per mostrare le foto
     * @return array L'array con numero di pagine totali e le foto da mostrare per la pagina scelta
     */
    public function display_photos($array_PhotoDB, $numero_pagina=1)
    {
        $pagine_totali = ceil(count($array_PhotoDB)/PHOTOS_PER_PAGE);
        $start = PHOTOS_PER_PAGE *($numero_pagina - 1);
        $end  = (PHOTOS_PER_PAGE * $numero_pagina)- 1;

        $mostra = array($pagine_totali);
        for($i=$start; $i<=$end; $i++)
        {
            array_push($mostra, $array_PhotoDB[$i]);
        }
        
        return $mostra;

        //L'elemento $mostra[0] è il numero di pagine totali.
        //Gli elementi $mostra[1] fino al $mostra[count($mostra)-1] sono le foto da visualizzare
    }
    /**
     * serve per dividere un array in un numero fissato di righe
     * @param array $mostra è l'array dal db di foto
     * @param int $limit_perRiga 
     * @return array
     */
    public function mostra_per_righe($mostra, $limit_perRiga=PHOTOS_PER_ROW){
        return array_chunk($mostra, $limit_perRiga);
        
    }

}