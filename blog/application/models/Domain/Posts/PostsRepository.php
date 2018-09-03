<?php

namespace Model\Domain\Posts;

use Common\Dictionary;
use Common\IntegerNumber;
use Db\Database;
use Common\Collection;

class PostsRepository
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
     * @param PostEntity $postEntity
     * @throws \Exception
     */
    public function add(PostEntity $postEntity)
    {
        $sql = "INSERT INTO posts (title, text, date) VALUES (:title, :text, :date)";

        $stmt = $this->database->prepare($sql);

        $title = (string)$postEntity->getTitle();
        $text = (string)$postEntity->getText();
        $date = $postEntity->getDate()->getValue();

        $stmt->bindParam(':title', $title, \PDO::PARAM_STR);
        $stmt->bindParam(':text',  $text,  \PDO::PARAM_STR);
        $stmt->bindParam(':date',  $date,  \PDO::PARAM_INT);

        $stmt->execute();

        if ($stmt->rowCount() == 0 && !empty($stmt->errorCode())) {
            throw new \Exception('There is some problem while adding a new post', 500); // add a new custom exception
        }
    }

    /**
     * @param IntegerNumber $postId
     * @return PostEntity
     * @throws \Exception
     */
    public function findById(IntegerNumber $postId)
    {
        $sql = "SELECT * FROM posts WHERE post_id = :post_id";

        $stmt = $this->database->prepare($sql);

        $postId = $postId->getValue();
        $stmt->bindParam(':post_id', $postId, \PDO::PARAM_INT);

        $stmt->execute();
        $post = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($stmt->rowCount() == 0) {
            throw new \Exception('There is no any comment', 203); // add a new custom exception
        }

        return (new PostEntityFactory())
            ->set(new Dictionary($post))
            ->reconstitute();
    }

    /**
     * @return Collection
     */
    public function findAll()
    {
        $posts = $this->database->query('SELECT * FROM posts')->fetchAll(\PDO::FETCH_ASSOC);

        return new Collection($posts, new PostEntityFactory());
    }
}
