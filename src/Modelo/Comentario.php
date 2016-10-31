<?php

namespace Blog\Modelo;

/**
 * @Entity
 * @Table(name="blog_comentario")
 */
class Comentario extends \Zeus\Entity
{

    /** @Id @GeneratedValue @Column(type="integer") */
    private $id;

    /** @ManyToOne(targetEntity="Blog\Modelo\Postagem", inversedBy="comentarios") */
    private $postagem;

    /** @ManyToOne(targetEntity="Blog\Modelo\Usuario", inversedBy="comentarios") */
    private $autor;

    /** @Column(type="text", nullable=false) */
    private $texto;

    public function getId()
    {
        return $this->id;
    }

    public function getPostagem()
    {
        return $this->postagem;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function getTexto()
    {
        return $this->texto;
    }

    public function setPostagem($postagem)
    {
        $this->postagem = $postagem;
        return $this;
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;
        return $this;
    }

    public function setTexto($texto)
    {
        $this->texto = $texto;
        return $this;
    }

}
