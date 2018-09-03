<?php

namespace Model\Domain\Comments;

use Common\Email;
use Common\Dictionary;
use Common\IntegerNumber;
use Common\StringLiteral;

class CommentEntityFactory
{
    /**
     * @var Dictionary
     */
    private $data;

    /**
     * @param Dictionary $data
     * @return CommentEntity
     */
    public function create(Dictionary $data)
    {
        $commentEntity = new CommentEntity(
            new IntegerNumber($data->get(CommentConstants::POST_ID)),
            new StringLiteral($data->get(CommentConstants::NAME)),
            new StringLiteral($data->get(CommentConstants::REMARK))
        );

        if (!$data->hasNonEmptyValue($data->get(CommentConstants::EMAIL))) {
            $commentEntity->setEmail(new Email($data->get(CommentConstants::EMAIL)));
        }

        return $commentEntity;
    }

    /**
     * @return CommentEntity
     */
    public function reconstitute()
    {
        $commentEntity = new CommentEntity(
            new IntegerNumber($this->data->get(CommentConstants::POST_ID)),
            new StringLiteral($this->data->get(CommentConstants::NAME)),
            new StringLiteral($this->data->get(CommentConstants::REMARK))
        );

        if (!$this->data->hasNonEmptyValue($this->data->get(CommentConstants::EMAIL))) {
            $commentEntity->setEmail(new Email($this->data->get(CommentConstants::EMAIL)));
        }

        return $commentEntity;
    }

    /**
     * @param Dictionary $data
     * @return $this
     */
    public function set(Dictionary $data)
    {
        $this->data = $data;
        return $this;
    }
}
