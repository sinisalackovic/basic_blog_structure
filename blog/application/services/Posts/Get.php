<?php

namespace Service\Posts;

use Db\Database;
use Common\Collection;
use Common\Dictionary;
use Common\IntegerNumber;
use Core\ServiceAbstract;
use Model\Domain\Posts\PostConstants;
use Model\Domain\Posts\PostFormatter;
use Model\Domain\Posts\PostsRepository;
use Model\Domain\Comments\CommentsFormatter;
use Model\Domain\Comments\CommentsRepository;

class Get extends ServiceAbstract
{
    public function run()
    {
        $postId     = new IntegerNumber((int) $this->getRequest()->getParam(PostConstants::POST_ID));
        $postEntity = (new PostsRepository(Database::getInstance()))->findById($postId);

        try {
            $commentCollection = (new CommentsRepository(Database::getInstance()))
                ->findAllByPostId($postId);

            $this->getResponse()->setHttpResponseCode(200);
            $this->getResponse()->setData([
                PostConstants::RESPONSE => [
                    'comments' => $this->prepareResponse($commentCollection)->getAll(),
                    'post'     => PostFormatter::format($postEntity),
                ]
            ]);

        } catch (\Exception $e) {
            // Log this exception to Elasticsearch or Text file or other log storage
            $this->getResponse()->setHttpResponseCode(400);
            $this->getResponse()->setData([
                PostConstants::RESPONSE => [
                    'comments' => [],
                    'post'     => PostFormatter::format($postEntity),
                ]
            ]);
        }
    }

    /**
     * @param Collection $commentCollection
     * @return Dictionary
     */
    private function prepareResponse(Collection $commentCollection)
    {
        $commentsResponse = new Dictionary([]);
        foreach($commentCollection as $key => $commentEntity) {
            $commentsResponse->add($key, CommentsFormatter::format($commentEntity));
        }

        return $commentsResponse;
    }
}
