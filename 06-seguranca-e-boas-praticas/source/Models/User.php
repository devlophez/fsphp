<?php


namespace Source\Models;

use \Source\Core\Model;

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
     * @var string[]
     */
    protected static $required = ["first_name", "last_name", "email", "password"];

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
    public function bootstrap(string $first_name, string $last_name, string $email, string $password, string $document = null): ?User
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->document = $document;
        return $this;
    }


    /**
     * @param string $terms
     * @param string $params
     * @param string $columns
     * @return User|null
     */
    public function find(string $terms, string $params, string $columns = "*"): ?User
    {
        $find = $this->read("SELECT {$columns} FROM " . self::$entity . " WHERE {$terms}", $params);
        if ($this->fail() || !$find->rowCount()) {
            return null;
        }
        return $find->fetchObject(__CLASS__);
    }

    /**
     * @param int $id
     * @param string $columns
     * @return User|null
     */
    public function findById(int $id, string $columns = "*"): ?User
    {
//        $load = $this->read("SELECT {$columns} FROM " . self::$entity . " WHERE id = :id", "id={$id}");
//
//        /**
//         * verifica se ou deu erro ou se não teve retorno de registro
//         */
//
//        if ($this->fail() || !$load->rowCount()) {
//            $this->message = "Usuário não encontrado para o id informado.";
//            return null;
//        }
//
//        return $load->fetchObject(__CLASS__);
        return $this->find("id = :id", "id={$id}", $columns);
    }

    /**
     * @param $email
     * @param string $columns
     * @return User|null
     */
    public function findByEmail($email, string $columns = "*"): ?User
    {
//        $find = $this->read("SELECT {$columns} FROM " . self::$entity . " WHERE email = :email", "email={$email}");
//
//        /**
//         * verifica se ou deu erro ou se não teve retorno de registro
//         */
//
//        if ($this->fail() || !$find->rowCount()) {
//            $this->message = "Usuário não encontrado para o email informado.";
//            return null;
//        }
//
//        return $find->fetchObject(__CLASS__);
        return $this->find("email = :email", "email={$email}", $columns);
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
        if (!$this->required()) {
            $this->message->warning("Nome, sobrenome, email e senha são obrigatórios");
            return null;
        }

        if (!is_email($this->email)) {
            $this->message->warning("O e-mail informado não tem um formato válido");
            return null;
        }

        if (!is_password($this->password)) {
            $min = CONF_PASSWD_MIN_LEN;
            $max = CONF_PASSWD_MAX_LEN;
            $this->message->warning("A senha deve ter entre {$min} e {$max} caracteres");
            return null;
        } else {
            $this->password = passwd($this->password);
        }

        /** User Update */
        if (!empty($this->id)) {
            $userId = $this->id;

            if ($this->find("email = :e AND id != :i", "e={$this->email}&i={$userId}")) {
                $this->message->warning("O e-mail informado já está cadastrado");
                return null;
            }

            $this->update(self::$entity, $this->safe(), "id = :id", "id={$userId}");
            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return null;
            }
        }

        /** User Create */
        if (empty($this->id)) {
            if ($this->findByEmail($this->email)) {
                $this->message->warning("O e-mail informado já está cadastrado");
                return null;
            }

            $userId = $this->create(self::$entity, $this->safe());
            if ($this->fail()) {
                $this->message->error("Erro ao cadastrar, verifique os dados");
                return null;
            }
        }

        $this->data = ($this->findById($userId))->data();
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

//    /**
//     * @return bool
//     */
//    private function required(): bool
//    {
//        if (empty($this->first_name) || empty($this->last_name) || empty($this->email)) {
//            $this->message = "Nome, sobrenome e e-mail são obrigatórios!";
//            return false;
//        }
//
//        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
//            $this->message = "O e-mail informado não parece válido!";
//            return false;
//        }
//
//        return true;
//    }
}