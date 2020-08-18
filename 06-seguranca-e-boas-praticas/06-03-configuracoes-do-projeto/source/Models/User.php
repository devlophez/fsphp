<?php

namespace Source\Models;

use Source\Core\Model;

/**
 * Class User
 * @package Source\Models
 */
class User extends Model
{
    /**
     * @var array $safe no update or create
     */

    protected static $safe = ["id", "created_at", "updated_at"];

    /**
     * @var string $entity database table
     */
    protected static $entity = "users";

    /**
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string|null $document
     * @return $this|null
     *
     * vai ajudar a criar um novo registro,
     * implementar os campos que são obrigatórios
     * e que devem ser informados.
     */
    public function bootstrap(string $first_name, string $last_name, string $email, string $document = null): ?User
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->document = $document;
        return $this;
    }

    /**
     * @param int $id
     * @param string $columns
     * @return User|null
     */
    public function load(int $id, string $columns = "*"): ?User
    {
        $load = $this->read("SELECT {$columns} FROM " . self::$entity . " WHERE id = :id", "id={$id}");

        /**
         * verifica se ou deu erro ou se não teve retorno de registro
         */

        if ($this->fail() || !$load->rowCount()) {
            $this->message = "Usuário não encontrado para o id informado.";
            return null;
        }

        return $load->fetchObject(__CLASS__);
    }

    /**
     * @param $email
     * @param string $columns
     * @return User|null
     */
    public function find($email, string $columns = "*"): ?User
    {
        $find = $this->read("SELECT {$columns} FROM " . self::$entity . " WHERE email = :email", "email={$email}");

        /**
         * verifica se ou deu erro ou se não teve retorno de registro
         */

        if ($this->fail() || !$find->rowCount()) {
            $this->message = "Usuário não encontrado para o email informado.";
            return null;
        }

        return $find->fetchObject(__CLASS__);
    }

    /**
     * @param int $limit
     * @param int $offset
     * @param string $columns
     * @return array|null
     */
    public function all(int $limit = 30, int $offset = 0, string $columns = "*"): ?array
    {
        $all = $this->read("SELECT {$columns} FROM " . self::$entity . " LIMIT :limit OFFSET :offset", "limit={$limit}&offset={$offset}");

        /**
         * verifica se ou deu erro ou se não teve retorno de registro
         */

        if ($this->fail() || !$all->rowCount()) {
            $this->message = "Sua consulta não retornou usuários.";
            return null;
        }

        return $all->fetchAll(\PDO::FETCH_CLASS, __CLASS__);
    }

    /**
     * @return $this|null
     */
    public function save()
    {
//        $this->safe();
//        $this->filter($this->safe());

        if (!$this->required()) {
            return null;
        }

        //Atualizar -> Model@update
        if (!empty($this->id)) {
            $userId = $this->id;

            $email = $this->read("SELECT id FROM users WHERE email = :email AND id = :id", "email={$this->email}&id={$userId}");

            if ($email->rowCount()) {
                $this->message = "o e-mail informado já está cadastrado.";
                return null;
            }

            $this->update(self::$entity, $this->safe(), "id = :id", "id={$userId}");
            if ($this->fail()) {
                $this->message = "Erro ao atualizar, verifique os dados informados.";
            }

            $this->message = "Cadastro atualziado com sucesso!";
        }

        //Cadastrar -> Model->create
        if (empty($this->id)) {

            //verificar e-mail existente
            if ($this->find($this->email)) {
                $this->message = "o e-mail informado já está cadastrado.";
                return null;
            }

            $userId = $this->create(self::$entity, $this->safe());
            if ($this->fail()) {
                $this->message = "Erro ao cadastrar, verifique os dados informados.";
            }

            $this->message = "Cadastro realizado com sucesso!";
        }

        $this->data = $this->read("SELECT * FROM users WHERE id = :id", "id={$userId}")->fetch();
//        $this->data = $this->load($userId);
        return $this;

    }

    /**
     * @return $this|null
     */
    public function destroy(): ?User
    {
        if (!empty($this->id)) {
            $this->delete(self::$entity, "id = :id", "id={$this->id}");
        }

        if ($this->fail()) {
            $this->message = "Erro ao remover, verifique os dados informados.";
            return null;
        }

        $this->message = "Cadastro removido com sucesso!";
        $this->data = null;
        return $this;
    }

    /**
     * @return bool
     */
    private function required(): bool
    {
        if (empty($this->first_name) || empty($this->last_name) || empty($this->email)) {
            $this->message = "Nome, sobrenome e e-mail são obrigatórios!";
            return false;
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->message = "O e-mail informado não parece válido!";
            return false;
        }

        return true;
    }
}