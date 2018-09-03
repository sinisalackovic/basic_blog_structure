<?php

namespace Model\Domain\Comments;

use Db\Database;
use Common\Collection;
use Common\IntegerNumber;

class CommentsRepository
{

    /**
     * @var Database
     */
    private $database;

    /**
     * PostsRepository constructor.
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @param CommentEntity $commentEntity
     * @throws \Common\NotAnObjectException
     * @throws \Exception
     */
    public function add(CommentEntity $commentEntity)
    {
        $sql = "INSERT INTO comments (post_id, remark, name, email) VALUES (:post_id, :remark, :name, :email)";

        $stmt = $this->database->prepare($sql);

        $postId = $commentEntity->getPostId()->getValue();
        $remark = (string) $commentEntity->getRemark();
        $name   = (string) $commentEntity->getName();

        $stmt->bindParam(':post_id', $postId, \PDO::PARAM_INT);
        $stmt->bindParam(':remark',  $remark, \PDO::PARAM_STR);
        $stmt->bindParam(':name',    $name ,  \PDO::PARAM_STR);

        if ($commentEntity->hasEmail()) {
            $email = (string) $commentEntity->getEmail();
            $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        }

        $stmt->execute();

        if ($stmt->rowCount() == 0 && !empty($stmt->errorCode())) {
            throw new \Exception('There is some problem while adding a new comment', 500); // add a new custom exception
        }
    }

    /**
     * @param IntegerNumber $postId
     * @return Collection
     * @throws \Exception
     */
    public function findAllByPostId(IntegerNumber $postId)
    {
        $sql = "SELECT * FROM comments WHERE post_id = :post_id";

        $stmt = $this->database->prepare($sql);

        $postId = $postId->getValue();
        $stmt->bindParam(':post_id', $postId, \PDO::PARAM_INT);

        $stmt->execute();
        $comments = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if ($stmt->rowCount() == 0) {
            throw new \Exception('There are no any comment for this post', 203); // add a new custom exception
        }

        return new Collection($comments, new CommentEntityFactory());
    }
}
