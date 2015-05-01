<?php

namespace PhotoAlbum\Repositories;

use PhotoAlbum\Db;
use PhotoAlbum\Models\Comment;

class CommentRepository
{
    /**
     * @var \PhotoAlbum\Db
     */
    private $db;

    /**
     * @var CommentRepository
     */
    private static $inst = null;

    private function __construct(\PhotoAlbum\Db $db)
    {
        $this->db = $db;
    }

    /**
     * @return CommentRepository
     */
    public static function create()
    {
        if (self::$inst == null)
        {
            self::$inst = new self(Db::getInstance());
        }

        return self::$inst;
    }

    /**
     * @param $id
     * @return bool|Comment
     */
    public function getOne($id)
    {
        $query = "SELECT id, text, created_on, picture_id, user_id FROM albums WHERE id = ?";

        $this->db->query($query, [$id]);

        $result = $this->db->row();

        if (empty($result)) {
            return false;
        }

        $picture = PictureRepository::create()->getOne($result['picture_id']);
        $user = UserRepository::create()->getOne($result['user_id']);

        $comment = new Comment(
            $result['text'],
            $picture,
            $user,
            $result['created_on'],
            $result['id']
        );

        return $comment;
    }

    /**
     * @param $id
     * @return Comment[]
     */
    public function getByPicture($id){
        $query = "SELECT id, text, created_on, picture_id, user_id FROM pictures WHERE picture_id = ?";

        $this->db->query($query, [$id]);

        $result = $this->db->fetchAll();
        $collection = [];

        foreach ($result as $row)
        {
            $picture = PictureRepository::create()->getOne($row['picture_id']);
            $user = UserRepository::create()->getOne($row['user_id']);

            $collection[] = new Comment(
                $row['text'],
                $picture,
                $user,
                $row['created_on'],
                $row['id']
            );
        }

        return $collection;
    }

    public function getByUser($id){
        $query = "SELECT id, text, created_on, picture_id, user_id FROM pictures WHERE user_id = ?";

        $this->db->query($query, [$id]);

        $result = $this->db->fetchAll();
        $collection = [];

        foreach ($result as $row)
        {
            $picture = PictureRepository::create()->getOne($row['picture_id']);
            $user = UserRepository::create()->getOne($row['user_id']);

            $collection[] = new Comment(
                $row['text'],
                $picture,
                $user,
                $row['created_on'],
                $row['id']
            );
        }

        return $collection;
    }

    /**
     * @param Comment $comment
     * @return bool
     */
    public function save(Comment $comment)
    {
        $query = "INSERT INTO pictures (text, picture_id, user_id ) VALUES (?, ?, ?)";
        $params = [
            $comment->getText(),
            $comment->getPicture()->getId(),
            $comment->getUser()->getId()
        ];

        if ($comment->getId()) {
            $query = "UPDATE pictures SET text = ?, picture_id = ?, user_id = ? WHERE id = ?";
            $params[] = $comment->getId();
        }

        $this->db->query($query, $params);

        return $this->db->rows() > 0;
    }

    /**
     * @param Comment $comment
     * @return bool
     */
    public function delete(Comment $comment)
    {
        $query = "DELETE FROM comments WHERE id = ?";
        $params = [ $comment->getId()];

        $this->db->query($query, $params);

        return $this->db->rows() > 0;
    }
} 