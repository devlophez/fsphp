<?php


namespace Source\Models\Faq;


/**
 * Class Channel
 * @package Source\Controllers\Faq
 */
class Channel extends \Source\Core\Model
{
    /**
     * Channel constructor.
     * @param string $entity
     * @param array $protected
     * @param array $required
     */
    public function __construct()
    {
        parent::__construct("faq_channels", ["id"], ["channel", "description"]);
    }

    /**
     * @return bool
     */
    public function save(): bool
    {

    }
}