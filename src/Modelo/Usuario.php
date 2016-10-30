<?php

namespace Blog\Modelo;

/**
 * @Entity 
 * @Table(name="blog_usuario")
 */
class Usuario extends \Zeus\Entity
{

    /** @Id @GeneratedValue @Column(type="integer") */
    private $id;

    /** @Column(type="string", nullable=false) */
    private $nome;

    /** @Column(type="string", length=32, nullable=false, unique=true) */
    private $login;

    /** @Column(type="string", nullable=false) */
    private $senha;

    /** @OneToMany(targetEntity="Blog\Modelo\Postagem", mappedBy="autor", cascade={"persist"}) */
    private $postagens;

    /** @OneToMany(targetEntity="Blog\Modelo\Comentario", mappedBy="autor", cascade={"persist"}) */
    private $comentarios;

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function getPostagens()
    {
        return $this->postagens;
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

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    public function setSenha($senha)
    {
        $this->senha = password_hash($senha, PASSWORD_BCRYPT);
        return $this;
    }

    public function setPostagens($postagens)
    {
        $this->postagens = $postagens;
        return $this;
    }

    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;
        return $this;
    }

    public function logar()
    {
        try {
            session_start();
        } finally {
            $_SESSION['blog_usuario'] = $this;
        }
    }

    public function deslogar()
    {
        session_destroy();
    }

}
