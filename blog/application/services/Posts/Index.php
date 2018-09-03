<?php

namespace Service\Posts;

use Db\Database;
use Common\Collection;
use Common\Dictionary;
use Core\ServiceAbstract;
use Model\Domain\Posts\PostConstants;
use Model\Domain\Posts\PostFormatter;
use Model\Domain\Posts\PostsRepository;

class Index extends ServiceAbstract
{
    public function run()
    {
        $this->getResponse()->setHttpResponseCode(200);
        $this->getResponse()->setData([]);
    }
}
