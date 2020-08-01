<?php


namespace Source\Models;


class UserModel extends Model
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
    public function bootstrap(string $first_name, string $last_name, string $email, string $document = null): ?UserModel
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->document = $document;
        return $this;
    }

    public function load(int $id, string $columns = "*"): ?UserModel
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

    public function find($email, string $columns = "*"): ?UserModel
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

    public function save()
    {
//        $this->safe();
//        $this->filter($this->safe());

        if(!$this->required()){
            return null;
        }

        //Atualizar -> Model@update
        if (!empty($this->id)) {
            $userId = $this->id;
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
                $this->message = "Erro a cadastrar, verifique os dados informados.";
            }

            $this->message = "Cadastro realizado com sucesso!";
        }

        $this->data = $this->read("SELECT * FROM users WHERE id = :id", "id={$userId}")->fetch();
//        $this->data = $this->load($userId);
        return $this;

    }

    public function destroy()
    {

    }

    private function required(): bool
    {
        if(empty($this->first_name) || empty($this->last_name) || empty($this->email)){
            $this->message = "Nome, sobrenome e e-mail são obrigatórios!";
            return false;
        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $this->message = "O e-mail informado não parece válido!";
            return false;
        }

        return true;
    }
}