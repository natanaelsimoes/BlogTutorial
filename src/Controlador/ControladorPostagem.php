<?php

namespace Blog\Controlador;

use Zeus\Annotations\Route;

class ControladorPostagem extends \Zeus\Singleton
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

    public function listar($quantidade = 10, $aPartirDe = 0)
    {
        return \Blog\Modelo\Postagem::select('p')
                        ->setFirstResult($aPartirDe)->setMaxResults($quantidade)
                        ->orderBy('p.id', 'DESC')
                        ->getQuery()->getResult();
    }

    public function postagemUnica($id)
    {
        return \Blog\Modelo\Postagem::find($id);
    }

    /** @Route("postagem/salvar") */
    public static function salvar()
    {
        $id = filter_input(INPUT_POST, 'id');
        $autorId = filter_input(INPUT_POST, 'autor');
        $resumo = filter_input(INPUT_POST, 'resumo');
        $texto = filter_input(INPUT_POST, 'texto');
        $titulo = filter_input(INPUT_POST, 'titulo');
        if (empty($id)) {
            $postagem = new \Blog\Modelo\Postagem();
        } else {
            $postagem = \Blog\Modelo\Postagem::find($id);
        }
        $autor = \Blog\Modelo\Usuario::find($autorId);
        $postagem
                ->setAutor($autor)->setResumo($resumo)->setTexto($texto)
                ->setTitulo($titulo)->save();
        header('location: listar');
    }

    /** @Route("postagem/excluir/$id") */
    public static function excluir($id)
    {
        $postagem = \Blog\Modelo\Postagem::find($id);
        $postagem->delete();
        header('location: ../listar');
    }
    
    /** @Route("postagem/$id/comentario/adicionar") */
    public static function adicionarComentario($id)
    {
        $postagem = \Blog\Modelo\Postagem::find($id);
        $autor = \Blog\Modelo\Usuario::find(filter_input(INPUT_POST, 'autor'));
        $comentario = new \Blog\Modelo\Comentario();
        $comentario->setAutor($autor)->setTexto(filter_input(INPUT_POST, 'texto'));
        $postagem->adicionarComentario($comentario)->save();
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }

    /** @Route("postagem/comentario/excluir/$id") */
    public static function excluirComentario($id)
    {
        $comentario = \Blog\Modelo\Comentario::find($id);
        $comentario->delete();
        header('location: ' . $_SERVER['HTTP_REFERER']);
    }

}
