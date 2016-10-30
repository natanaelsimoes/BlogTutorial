<?php

namespace Blog\Visualizacao;

use Zeus\Annotations\Route;

class VisualizacaoPostagem
{
    
    
    public static function paginaInicial() {
        self::verPostagens();
    }

    /** @Route("postagem/listar;postagem/listar/$quantidade/$aPartirDe") */
    public static function verPostagens($quantidade = 10, $aPartirDe = 0)
    {
        $ctrl = \Blog\Controlador\ControladorPostagem::getInstance();
        $postagens = $ctrl->listar($quantidade, $aPartirDe);
        echo 'hello';
    }

}
