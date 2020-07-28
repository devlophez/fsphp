<?php


namespace Source\Models;


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
     * @return object|null
     */
    public function data(): ?object
    {
        return $this->data;
    }

    /**
     * @return \PDOException
     */
    public function fail(): \PDOException
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

    protected function read()
    {

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