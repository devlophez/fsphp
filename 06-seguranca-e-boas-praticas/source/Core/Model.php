<?php


namespace Source\Core;


/**
 * Class Model
 * @package Source\Models
 */
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
        if (empty($this->data)) {
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

    /**
     * @param string $entity
     * @param array $data
     *
     * persiste e cria o novo registro no banco de dados
     *
     */
    protected function create(string $entity, array $data): ?int
    {

        try {
            $columns = implode(", ", array_keys($data));
            $values = ":" . implode(", :", array_keys($data));

//            echo "INSERT INTO $entity ({$columns}) VALUES ({$values})";

            $query = "INSERT INTO $entity ({$columns}) VALUES ({$values})";
            $stmt = Connect::getInstance()->prepare($query);

            $stmt->execute($this->filter($data));

            return Connect::getInstance()->lastInsertId();

        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    /**
     * @param string $select
     * @param null $params
     * @return \PDOStatement|null
     */
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

    /**
     * @param string $entity
     * @param array $data
     * @param string $terms
     * @param string $params
     * @return int|null
     */
    protected function update(string $entity, array $data, string $terms, string $params): ?int
    {
//        var_dump(
//            $entity,
//            $data,
//            $terms,
//            $params
//        );

        try {

            $dateSet = [];

            foreach ($data as $bind => $value) {
                $dataSet[] = "{$bind} = :{$bind}";
            }

            $dataSet = implode(", ", $dataSet);

//            var_dump($dataSet);

//            echo "UPDATE {$entity} SET {$dataSet} WHERE {$terms}";

            $query = "UPDATE {$entity} SET {$dataSet} WHERE {$terms}";

            parse_str($params, $params);

            $stmt = Connect::getInstance()->prepare($query);

            $stmt->execute($this->filter(array_merge($data, $params)));

            return ($stmt->rowCount() ?? 1);

        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
    }

    /**
     * @param string $entity
     * @param string $terms
     * @param string $params
     * @return int|null
     */
    protected function delete(string $entity, string $terms, string $params): ?int
    {
        try {
            $stmt = Connect::getInstance()->prepare("DELETE FROM {$entity} WHERE {$terms}");
            parse_str($params, $params);
            $stmt->execute($params);
            return ($stmt->rowCount() ?? 1);
        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
//        echo "DELETE FROM {$entity} WHERE {$terms}";

//        var_dump($entity, $terms, $params);
    }

    /**
     *
     * colunas que não podem ser persistidos na rotina.
     * então esses campos estarão salvos ou protegidos,
     * ou seja,
     * prevenir o cadastro de informações que não
     * podem ser manipulados na base de dados.
     */
    protected function safe(): ?array
    {
        $safe = (array)$this->data;

        foreach (static::$safe as $unset) {
            unset($safe[$unset]);
        }

        return $safe;
    }

    /**
     * será filtrado e verificados antes dos campos serem persistidos no banco
     */
    private function filter(array $data): ?array
    {
        $filter = [];
        foreach ($data as $key => $value) {
            $filter[$key] = (is_null($value) ? null : filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS));
        }

        return $filter;
    }
}