<?php

namespace Service\Comments;

use Db\Database;
use Common\Dictionary;
use Core\ServiceAbstract;
use Model\Domain\Comments\CommentsRepository;
use Model\Domain\Comments\CommentEntityFactory;
use Model\Domain\Posts\PostConstants;

class Post extends ServiceAbstract
{
    public function run()
    {
        try {
            $commentEntity = (new CommentEntityFactory())
                ->create(new Dictionary($this->getRequest()->getParams()));

            (new CommentsRepository(Database::getInstance()))->add($commentEntity);

            $this->getResponse()->setHttpResponseCode(200);
            $this->getResponse()->setData([]);
            
            header("Location: /posts?id=" . (int) $this->getRequest()->getParam(PostConstants::POST_IDENTIFIER));

        } catch (\Exception $e) {

            // Log this exception to Elasticsearch or Text file or other log storage
            throw new \Exception('Failed to add a new comment.', 500); // add a new custom exception
        }
    }
}
