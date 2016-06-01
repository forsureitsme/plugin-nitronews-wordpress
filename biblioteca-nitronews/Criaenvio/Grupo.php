<?php

namespace Criaenvio;

class Grupo extends Entidade {

    /**
     * Atributos pr�prios de CriaenvioGrupo.
     */
    public $nome;
    public $ativo;
    public $contatos_ativos;

    /**
     * Configura��es para CriaenvioGrupo
     */
    const CAMINHO     = 'grupos';
    const NOME_CLASSE = __CLASS__;

    /**
     * @param int $tipo
     * @return array
     */
    protected function _parametrosPermitidos($tipo = self::TIPO_CONSULTA) {
        return array('nome', 'id');
    }

    /**
     * Ativa o grupo que chamou o m�todo.
     * @return bool Sucesso na ativa��o.
     * @throws \BadMethodCallException Caso o identificador (id) n�o tenha sido setado.
     */
    public function ativar() {

        if (is_null($this->id)) {
            throw new \BadMethodCallException('O identificador (id) do objeto n�o foi informado.');
        }

        return self::ativarGrupos(array($this->id));
    }

    /**
     * Ativa os grupos cujo ids foram passados por par�metro.
     * @param $parametros array Ids dos grupos a serem ativados.
     * @return bool Sucesso na ativa��o.
     * @throws \BadMethodCallException Caso o par�metro passado seja inv�lido.
     */
    public function ativarGrupos($parametros) {

        if (!is_array($parametros) || !count($parametros)) {
            throw new \BadMethodCallException('O par�metro "parametros" deve ser um array.');
        }

        //Configura solicita��o.
        $this->_tipoSolicitacao = $this::TIPO_SOLICITACAO_PUT;
        $this->_caminho         = '/ativar';
        $this->_parametros      =  array('id' => implode(',', $parametros));

        return $this->_isRespostaOk($this->_realizaSolicitacao());
    }

    /**
     * Desativa o grupo que chamou o m�todo.
     * @return bool Sucesso na desativa��o.
     * @throws \BadMethodCallException Caso o identificador (id) do grupo n�o tenha sido setado.
     */
    public function desativar() {

        if (is_null($this->id)) {
            throw new \BadMethodCallException('O identificador (id) do objeto n�o foi informado.');
        }

        return self::desativarGrupos(array($this->id));
    }

    /**
     * Desativa grupos cujos ids foram passados no array do par�metro.
     * @param $parametros array Ids dos grupos para desativa��o.
     * @return bool Sucesso na desativa��o.
     * @throws \BadMethodCallException caso o par�metro passado seja inv�lido.
     */
    public function desativarGrupos($parametros) {

        if (!is_array($parametros) || !count($parametros)) {
            throw new \BadMethodCallException('O par�metro "parametros" deve ser um array.');
        }

        //Configurando solicita��o.
        $this->_tipoSolicitacao = $this::TIPO_SOLICITACAO_PUT;
        $this->_caminho         = '/desativar';
        $this->_parametros      = array('id' => implode(',', $parametros));

        return $this->_isRespostaOk($this->_realizaSolicitacao());
    }

    /**
     * Informa nome das rela��es de dados permitidas para esta classe.
     * @return array Rela��o de dados permitidas para esta classe.
     */
    public function embedsPermitidos() {
        return array('contatos');
    }


    /**
     * Valida os par�metros utilizados na cria��o do grupo.
     * @param $parametros array Informa��es usadas na cria��o do registro.
     * @return mixed Objeto salvo com dados preenchidos.
     * @throws \BadMethodCallException Caso o par�metro nome informado seja inv�lido.
     */
    public function criar($parametros){

        if (isset($parametros['nome']) && is_bool($parametros['nome'])) {
            throw new \BadMethodCallException('O par�metro "parametros" deve ser um array com valores v�lidos.');
        }

        return parent::criar($parametros);
    }

} 