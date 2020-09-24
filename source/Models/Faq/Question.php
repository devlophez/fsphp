<?php


namespace Source\Models\Faq;


/**
 * Class Question
 * @package Source\Controllers\Faq
 */
class Question extends \Source\Core\Model
{
    /**
     * Question constructor.
     */
    public function __construct()
    {
        parent::__construct("faq_questions", ["id"], ["channel_id", "question", "response"]);
    }

    /**
     * @return bool
     */
    public function save(): bool
    {

    }
}