<?php

namespace TodasAsPatas\WebBundle\Controller\Backend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Responde o json de tradução do datatable 
 *
 * @author Fábio Lemos Elizandro <fabio@elizandro.com.br>
 */
class DataTableController extends Controller
{

    /**
     * Ação que renderiza o json de traduçã 
     */
    public function ptBRAction()
    {
        $data = array(
            "sProcessing" => "Processando...",
            "sLengthMenu" => "Mostrar _MENU_ registros",
            "sZeroRecords" => "Não foram encontrados resultados",
            "sInfo" => "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty" => "Mostrando de 0 até 0 de 0 registros",
            "sInfoFiltered" => "(filtrado de _MAX_ registros no total)",
            "sInfoPostFix" => "",
            "sSearch" => "Buscar:",
            "sUrl" => "",
            "oPaginate" => array(
                "sFirst" => "Primeiro",
                "sPrevious" => "Anterior",
                "sNext" => "Seguinte",
                "sLast" => "Último"
            )
        );

        return new JsonResponse($data);
    }

}
