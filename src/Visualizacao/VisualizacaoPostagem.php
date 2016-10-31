<?php

namespace Blog\Visualizacao;

use Zeus\Annotations\Route;

class VisualizacaoPostagem
{

    /** @Route("postagem/listar;postagem/listar/$quantidade/$aPartirDe") */
    public static function verPostagens($quantidade = 10, $aPartirDe = 0)
    {
        $ctrl = \Blog\Controlador\ControladorPostagem::getInstance();
        $postagens = $ctrl->listar($quantidade, $aPartirDe);
        echo Twig::getInstance()->render('Postagens.twig', ['postagens' => $postagens, 'pIndice' => $aPartirDe]);
    }

    /** @Route("postagem/$id") */
    public static function verPostagem($id)
    {
        $ctrl = \Blog\Controlador\ControladorPostagem::getInstance();
        $ctrlUsuario = \Blog\Controlador\ControladorUsuario::getInstance();
        $postagem = $ctrl->postagemUnica($id);
        $usuarios = $ctrlUsuario->todosUsuarios();
        echo Twig::getInstance()->render('Postagem.twig', ['postagem' => $postagem, 'usuarios' => $usuarios]);
    }

    /** @Route("sobre") */
    public static function verSobre()
    {
        $texGen = new \Badcow\LoremIpsum\Generator;
        $texto = "<p>" . implode("</p><p>", $texGen->getParagraphs(2)) . "</p>";
        echo Twig::getInstance()->render('Sobre.twig', ['texto' => $texto]);
    }

    /** @Route("postagem/adicionar") */
    public static function adicionar()
    {
        $ctrlUsuario = \Blog\Controlador\ControladorUsuario::getInstance();
        $postagem = new \Blog\Modelo\Postagem;
        $usuarios = $ctrlUsuario->todosUsuarios();
        echo Twig::getInstance()->render('Edicao.twig', ['postagem' => $postagem, 'usuarios' => $usuarios]);
    }

    /** @Route("postagem/editar/$id") */
    public static function editar($id)
    {
        $ctrl = \Blog\Controlador\ControladorPostagem::getInstance();
        $postagem = $ctrl->postagemUnica($id);
        echo Twig::getInstance()->render('Edicao.twig', ['postagem' => $postagem, 'usuarios' => $usuarios]);
    }

}
