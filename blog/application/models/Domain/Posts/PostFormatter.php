<?php

namespace Model\Domain\Posts;

class PostFormatter
{
    /**
     * @param PostEntity $postEntity
     * @return array
     */
    public static function format(PostEntity $postEntity)
    {
        return [
            PostConstants::POST_ID => $postEntity->getPostId()->getValue(),
            PostConstants::TITLE   => (string) $postEntity->getTitle(),
            PostConstants::TEXT    => (string) $postEntity->getText(),
            PostConstants::DATE    => $postEntity->getDate()->getFormatted(),
        ];
    }
}
