<?php

namespace Service\Index;

use Db\Database;
use Common\Dictionary;
use Common\Collection;
use Core\ServiceAbstract;
use Model\Domain\Posts\PostFormatter;
use Model\Domain\Posts\PostConstants;
use Model\Domain\Posts\PostsRepository;

class Index extends ServiceAbstract
{
    public function run()
    {
        $postCollection = (new PostsRepository(Database::getInstance()))->findAll();

        $this->getResponse()->setHttpResponseCode(200);
        $this->getResponse()->setData([
            PostConstants::RESPONSE => $this->prepareResponse($postCollection)->getAll()
        ]);
    }

    /**
     * @param Collection $postCollection
     * @return Dictionary
     */
    private function prepareResponse(Collection $postCollection)
    {
        $postsResponse = new Dictionary([]);
        foreach($postCollection as $key => $postEntity) {
            $postsResponse->add($key, PostFormatter::format($postEntity));
        }

        return $postsResponse;
    }
}
