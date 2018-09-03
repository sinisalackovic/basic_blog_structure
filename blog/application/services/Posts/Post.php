<?php

namespace Service\Posts;

use Db\Database;
use Common\Dictionary;
use Core\ServiceAbstract;
use Model\Domain\Posts\PostsRepository;
use Model\Domain\Posts\PostEntityFactory;

class Post extends ServiceAbstract
{
    public function run()
    {
        try {

            $postEntity = (new PostEntityFactory())
                ->create(new Dictionary($this->getRequest()->getParams()));

            (new PostsRepository(Database::getInstance()))->add($postEntity);

            $this->getResponse()->setHttpResponseCode(200);
            $this->getResponse()->setData([]);

            header("Location: /");

        } catch (\Exception $e) {

            // Log this exception to Elasticsearch or Text file or other log storage
            throw new \Exception('Failed to add a new post', 500); // add a new custom exception
        }
    }
}
