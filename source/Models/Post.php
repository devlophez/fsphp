<?php


namespace Source\Models;

use Source\Core\Model;
use Source\Models\User;
use Source\Models\Category;

/**
 * Class Post
 * @package Source\Controllers
 */
class Post extends Model
{

    /**
     * @var bool
     */
    private $all;

    /**
     * Post constructor.
     * @param bool $all
     */
    public function __construct(bool $all = false)
    {
        $this->all = $all;
        parent::__construct("posts", ["id"], ["title", "id", "subtitle", "content"]);
    }

    /**
     * @param string|null $terms
     * @param string|null $params
     * @param string $columns
     * @return mixed|Post
     */
    public function find(?string $terms = null, ?string $params = null, string $columns = "*")
    {
        if (!$this->all) {
            $terms = "status = :status AND post_at <= NOW()" . ($terms ? " AND {$terms}" : "");
            $params = "status=post" . ($params ? "&{$params}" : "");
        }
        return parent::find($terms, $params, $columns);
    }

    /**
     * @param string $uri
     * @param string $columns
     * @return Post|null
     */
    public function findByUri(string $uri, string $columns = "*"): ?Post
    {
        return ($this->find("uri = :uri", "uri={$uri}", $columns))->fetch();
    }

    /**
     * @return \Source\Models\User|null
     */
    public function author(): ?User
    {
        if ($this->author) {
            return (new User())->findById($this->author);
        }

        return null;
    }

    /**
     * @return \Source\Models\Category|null
     */
    public function category(): ?Category
    {
        if ($this->category) {
            return (new Category())->findById($this->category);
        }

        return null;
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        /** Post Update */
        if (!empty($this->id)) {
            $postId = $this->id;
            $this->update($this->safe(), "id = :id", "id={$postId}");

            if ($this->fail()) {
                $this->message->error("Erro ao atualizar, verifique os dados");
                return false;
            }
        }

        //** Post Create */


        $this->data = $this->findById($postId)->data();
        return true;
    }
}