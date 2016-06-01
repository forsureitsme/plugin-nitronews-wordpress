<?php

namespace Criaenvio;

class Remetente extends Entidade {

    /**
     * Atributos pr�prios de CriaenvioRemetente.
     */
    public $nome;
    public $email;
    public $confirmado;
    public $principal;

    /**
     * Configura��es para CriaenvioRemetente
     */
    const CAMINHO     = 'remetentes';
    const NOME_CLASSE = __CLASS__;

    /**
     *
     * @return array
     */
    protected function _parametrosPermitidos() {
        return array('nome', 'id', 'email');
    }

    public function embedsPermitidos() {
        return [];
    }

} 