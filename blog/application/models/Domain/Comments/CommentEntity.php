<?php

namespace Model\Domain\Comments;

use Common\Email;
use Common\IntegerNumber;
use Common\StringLiteral;
use Common\NotAnObjectException;

// Need a new UserEntity, new db table for users and use "user_uuid" here
class CommentEntity
{
    /**
     * @var IntegerNumber
     */
    private $postId;

    /**
     * @var StringLiteral
     */
    private $name;

    /**
     * @var StringLiteral
     */
    private $remark;

    /**
     * @var Email
     */
    private $email;

    /**
     * CommentEntity constructor.
     * @param IntegerNumber $postId
     * @param StringLiteral $name
     * @param StringLiteral $remark
     */
    public function __construct(IntegerNumber $postId, StringLiteral $name, StringLiteral $remark)
    {
        $this->postId = $postId;
        $this->name   = $name;
        $this->remark = $remark;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return StringLiteral
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * @return Email
     * @throws NotAnObjectException
     */
    public function getEmail()
    {
        if (!$this->hasEmail()) {
            throw new NotAnObjectException(__FUNCTION__, Email::class);
        }

        return $this->email;
    }

    /**
     * @param Email $email
     * @return $this
     */
    public function setEmail(Email $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasEmail()
    {
        return $this->email instanceof Email;
    }
}
