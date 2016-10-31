<?php

namespace Blog\Controlador;

class ControladorUsuario extends \Zeus\Singleton
{

    public function todosUsuarios()
    {
        return \Blog\Modelo\Usuario::select('u')
                        ->orderBy('u.nome')
                        ->getQuery()->getResult();
    }

}
