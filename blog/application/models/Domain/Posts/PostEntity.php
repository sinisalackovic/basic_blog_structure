<?php

namespace Model\Domain\Posts;

use Common\IntegerNumber;
use Common\StringLiteral;
use Common\TimestampValue;

class PostEntity
{
    /**
     * @var IntegerNumber
     */
    private $postId;

    /**
     * @var StringLiteral
     */
    private $title;

    /**
     * @var StringLiteral
     */
    private $text;

    /**
     * @var TimestampValue
     */
    private $date;

    /**
     * PostEntity constructor.
     * @param IntegerNumber $postId
     * @param StringLiteral $title
     * @param StringLiteral $text
     * @param TimestampValue $date
     */
    public function __construct(IntegerNumber $postId, StringLiteral $title, StringLiteral $text, TimestampValue $date)
    {
        $this->postId = $postId;
        $this->title  = $title;
        $this->text   = $text;
        $this->date   = $date;
    }

    /**
     * @return IntegerNumber
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @return StringLiteral
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return StringLiteral
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return TimestampValue
     */
    public function getDate()
    {
        return $this->date;
    }
}
