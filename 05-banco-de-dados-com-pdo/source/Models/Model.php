<?php


namespace Source\Models;


use Source\Database\Connect;

abstract class Model
{
    /**
     * @var object|null
     */
    protected $data;

    /**
     * @var \PDOException
     */
    protected $fail;

    /**
     * @var string|null
     */
    protected $message;

    /**
     * quando for atribuido uma propriedade que não esteja acessível
     * será manipulada e enviada para a camada de data
     */
    public function __set($name, $value)
    {
        if(empty($this->data)){
            $this->data = new \stdClass();
        }

        $this->data->$name = $value;
    }

    /**
     * - Vai servir para validar se aquele recurso realmente é válido
     */

    public function __isset($name)
    {
        return isset($this->data->$name);
    }

    /**
     * - Vai servir para obter os recursos.
     * - Será executada toda vez que for tentado acessar
     * uma propriedade que não existe ou está inacessível.
     */
    public function __get($name)
    {
        return ($this->data->$name ?? null);
    }

    /**
     * @return object|null
     */
    public function data(): ?object
    {
        return $this->data;
    }

    /**
     * @return \PDOException
     */
    public function fail(): ?\PDOException
    {
        return $this->fail;
    }

    /**
     * @return string|null
     */
    public function message(): ?string
    {
        return $this->message;
    }

    protected function create()
    {

    }

    protected function read(string $select, $params = null): ?\PDOStatement
    {
        try {
            $stmt = Connect::getInstance()->prepare($select);

            if ($params) {
                parse_str($params, $params);
                foreach ($params as $key => $value) {
                    $type = (is_numeric($value) ? \PDO::PARAM_INT : \PDO::PARAM_STR);
                    $stmt->bindValue(":{$key}", $value, $type);
                }
            }

            $stmt->execute();
            return $stmt;

        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    protected function update()
    {

    }

    protected function delete()
    {

    }

    /**
     * colunas que não podem ser persistidos na rotina
     * então esses campos estarão salvos ou protegidos,
     * ou seja,
     * prevenir o cadastro de informações que não
     * podem ser manipulados na base de dados.
     */
    protected function safe(): ?array
    {

    }

    /**
     * será filtrado antes dos campos serem filtrados no banco
     */
    private function filter()
    {

    }
}