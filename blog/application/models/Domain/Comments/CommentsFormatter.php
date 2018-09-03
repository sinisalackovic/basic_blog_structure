<?php

namespace Model\Domain\Comments;

class CommentsFormatter
{
    /**
     * @param CommentEntity $commentEntity
     * @return array
     * @throws \Common\NotAnObjectException
     */
    public static function format(CommentEntity $commentEntity)
    {
        return [
            CommentConstants::NAME   => (string) $commentEntity->getName(),
            CommentConstants::REMARK => (string) $commentEntity->getRemark(),
            CommentConstants::EMAIL =>  $commentEntity->hasEmail()
                ? (string) $commentEntity->getEmail()
                : '',
        ];
    }
}
