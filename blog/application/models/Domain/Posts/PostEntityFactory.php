<?php

namespace Model\Domain\Posts;

use Common\Dictionary;
use Common\IntegerNumber;
use Common\StringLiteral;
use Common\TimestampValue;

class PostEntityFactory
{
    /**
     * @var Dictionary
     */
    private $data;

    /**
     * @param Dictionary $data
     * @return PostEntity
     */
    public function create(Dictionary $data)
    {
        return new PostEntity(
            new IntegerNumber((int) $data->get(PostConstants::POST_ID)),
            new StringLiteral($data->get(PostConstants::TITLE)),
            new StringLiteral($data->get(PostConstants::TEXT)),
            new TimestampValue(time())
        );
    }

    /**
     * @return PostEntity
     */
    public function reconstitute()
    {
        return new PostEntity(
            new IntegerNumber((int) $this->data->get(PostConstants::POST_IDENTIFIER)),
            new StringLiteral($this->data->get(PostConstants::TITLE)),
            new StringLiteral($this->data->get(PostConstants::TEXT)),
            new TimestampValue(time())
        );
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
