<?php


namespace Application\models;


use Application\core\Database;
use PDO;
use PDOException;

class Gadget
{
    private $id;
    private $id_tipo_modulo;
    private $id_gadget;
    private $situacao;
    private $valor;
    private $u_horario;
    private $apelido;

    /**
     * @param $id
     */
    public function buscaGadget($id)
    {
        try {
            $conn = new Database();
            $result = $conn->executarQuery("CALL sp_busca_modulo(:id)", array(
                ':id' => $id
            ));

            $retorno = [$result->fetchAll(PDO::FETCH_CLASS, 'Application\\models\\Gadget'), 'isError' => false];

        } catch (PDOException $ex) {
            $retorno = ['erro' => $ex->getCode(), 'mensagem' => $ex->getMessage(), 'isError' => true];
        } finally {
            return $retorno;
        }
    }

    /**
     * @param $situacao
     * @param $data_hora
     * @param $modulo
     * @return array
     */
    public function ligarDesligarTomada($situacao, $data_hora, $modulo)
    {
        try {
            $conn = new Database();

            $result = $conn->executarQuery("CALL sp_ligar_desligar_tomada(:situacao, :datahora, :modulo)", array(
                ':situacao' => $situacao,
                ':datahora' => $data_hora,
                ':modulo' => $modulo
            ));

            $retorno = [$result->rowCount(), 'isError' => false];

        } catch (PDOException $ex) {
            $retorno = ['erro' => $ex->getCode(), 'mensagem' => $ex->getMessage(), 'isError' => true];
        } finally {
            return $retorno;
        }
    }

    /**
     * @param $id_tipo_gadget
     * @param $id_gadget
     * @param $situacao
     * @param $valor
     * @param $apelido
     * @return array
     */
    public function cadastrarGadget($id_tipo_gadget, $id_gadget, $situacao, $valor, $apelido)
    {
        try {
            $conn = new Database();
            $result = $conn->executarQuery("CALL sp_cadastra_modulo(:tipo_gadget,:id_gadget,:situacao,:valor,:apelido)", array(
                ':tipo_gadget' => $id_tipo_gadget,
                ':id_gadget' => $id_gadget,
                ':situacao' => $situacao,
                ':valor' => $valor,
                ':apelido' => $apelido
            ));

            $retorno = [$result->rowCount(), 'isError' => false];

        } catch (PDOException $ex) {
            $retorno = ['erro' => $ex->getCode(), 'mensagem' => $ex->getMessage(), 'isError' => true];
        } finally {
            return $retorno;
        }
    }

    /**
     * @param $apelido
     * @param $id_gadget
     * @param $tipo_modulo
     * @return array
     */
    public function atualizaApelido($apelido, $id_gadget, $tipo_modulo){
        try {
            $conn = new Database();
            $result =$conn->executarQuery("CALL sp_atualiza_apelido(:apelido, :id_gadget, :tipo_modulo)", array(
                ':apelido' => $apelido,
                ':id_gadget' => $id_gadget,
                ':tipo_modulo' => $tipo_modulo
            ));

            $retorno = [$result->rowCount(),'isError'=>false];

        } catch (PDOException $ex) {
            $retorno = ['erro' => $ex->getCode(), 'mensagem' => $ex->getMessage(), 'isError' => true];
        } finally {
            return $retorno;
        }
    }

    /**
     * @param $temp
     * @param $datahora
     * @param $mod
     * @return array
     */
    public function alterarValor($valor, $datahora, $mod){
        try {
            $conn = new Database();
            $result =$conn->executarQuery("CALL sp_atualiza_valor(:valor, :datahora, :mod)", array(
                ':valor' => $valor,
                ':datahora' => $datahora,
                ':mod' => $mod
            ));

            $retorno = [$result->rowCount(),'isError'=>false];

        } catch (PDOException $ex) {
            $retorno = ['erro' => $ex->getCode(), 'mensagem' => $ex->getMessage(), 'isError' => true];
        } finally {
            return $retorno;
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->$name;
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->$name = $value;
    }
}