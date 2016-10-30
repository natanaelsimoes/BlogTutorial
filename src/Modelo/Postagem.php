<?php

namespace Blog\Modelo;

/**
 * @Entity
 * @Table(name="blog_postagem")
 */
class Postagem extends \Zeus\Entity
{

    /** @Id @GeneratedValue @Column(type="integer") */
    private $id;

    /** @Column(type="date", nullable=false) */
    private $data;

    /** @ManyToOne(targetEntity="Blog\Modelo\Usuario", inversedBy="postagens") */
    private $autor;

    /** @Column(nullable=false) */
    private $titulo;

    /** @Column(type="text") */
    private $resumo;

    /** @Column(type="text", nullable= false) */
    private $texto;

    /** @OneToMany(targetEntity="Blog\Modelo\Comentario", mappedBy="postagem", cascade={"persist"}) */
    private $comentarios;

    public function __construct()
    {
        $this->data = new \DateTime();
        $this->comentarios = new \Doctrine\Common\Collections\ArrayCollection;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getAutor()
    {
        return $this->autor;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getResumo()
    {
        return $this->resumo;
    }

    public function getTexto()
    {
        return $this->texto;
    }

    public function getComentarios()
    {
        return $this->comentarios;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;
        return $this;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
        return $this;
    }

    public function setResumo($resumo)
    {
        $this->resumo = $resumo;
        return $this;
    }

    public function setTexto($texto)
    {
        $this->texto = $texto;
        return $this;
    }

    public function adicionarComentario(Comentario $c)
    {
        $c->setPostagem($this);
        $this->comentarios->add($c);
        return $this;
    }

    public function removerComentario(Comentario $c)
    {
        $this->comentarios->removeElement($c);
        return $this;
    }

}
