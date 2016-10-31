<?php

namespace Blog\Controlador;

use Zeus\Annotations\Route;

class ControladorPostagem
{

    /** @Route("postagem/carregarTeste") */
    public static function carregarTeste()
    {
        $alice = new \Blog\Modelo\Usuario();
        $alice->setLogin('alice')->setNome('Alice')->setSenha('1234')->save();
        $bob = new \Blog\Modelo\Usuario();
        $bob->setLogin('bob')->setNome('Bob')->setSenha('1234')->save();
        $eva = new \Blog\Modelo\Usuario();
        $eva->setLogin('eva')->setNome('Eva')->setSenha('1234')->save();

        $texGen = new \Badcow\LoremIpsum\Generator;
        $resumo = implode(" ", $texGen->getSentences(2));
        $texto = "<p>" . implode("</p><p>", $texGen->getParagraphs(2)) . "</p>";

        $autores = [$alice, $bob, $eva];
        for ($i = 0; $i < 20; $i++) {
            $p = new \Blog\Modelo\Postagem();
            $aIndice = mt_rand(0, 2);
            $p->setResumo($resumo)->setTexto($texto)->setAutor($autores[$aIndice])->setTitulo("Postagem r$i")->save();
        }

        $p1 = new \Blog\Modelo\Postagem();
        $p1->setAutor($alice)->setResumo($resumo)->setTexto($texto)
                ->setTitulo('Postagem p1')->save();
        $p2 = new \Blog\Modelo\Postagem();
        $p2->setAutor($bob)->setResumo($resumo)->setTexto($texto)
                ->setTitulo('Postagem p2')->save();
        $p3 = new \Blog\Modelo\Postagem();
        $p3->setAutor($eva)->setResumo($resumo)->setTexto($texto)
                ->setTitulo('Postagem p3')->save();

        $comentario = "<p>" . implode("</p><p>", $texGen->getSentences(1)) . "</p>";
        $c1 = new \Blog\Modelo\Comentario();
        $c1->setAutor($alice)->setTexto($comentario);
        $p3->adicionarComentario($c1);
        $c2 = new \Blog\Modelo\Comentario();
        $c2->setAutor($bob)->setPostagem($p1)->setTexto($comentario)->save();
        $c3 = new \Blog\Modelo\Comentario();
        $c3->setAutor($eva)->setPostagem($p2)->setTexto($comentario)->save();


        echo 'Postagens de teste carregados';
    }

}
