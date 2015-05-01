<?php

namespace PhotoAlbum\Repositories;

use PhotoAlbum\Db;
use PhotoAlbum\Models\AlbumComment;
use PhotoAlbum\Models\Album;

class AlbumCommentRepository
{
    /**
     * @var \PhotoAlbum\Db
     */
    private $db;

    /**
     * @var AlbumCommentRepository
     */
    private static $inst = null;

    private function __construct(\PhotoAlbum\Db $db)
    {
        $this->db = $db;
    }

    /**
     * @return AlbumCommentRepository
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
     * @return bool|AlbumComment
     */
    public function getOne($id)
    {
        $query = "SELECT id, text, created_on, album_id, user_id FROM album_comments WHERE id = ?";

        $this->db->query($query, [$id]);

        $result = $this->db->row();

        if (empty($result)) {
            return false;
        }

        $album = AlbumRepository::create()->getOne($result['album_id']);
        $user = UserRepository::create()->getOne($result['user_id']);

        $comment = new AlbumComment(
            $result['text'],
            $album,
            $user,
            $result['created_on'],
            $result['id']
        );

        return $comment;
    }

    /**
     * @param Album $album
     * @return AlbumComment[]
     */
    public function getByAlbum(Album $album){
        $query = "SELECT id, text, created_on, album_id, user_id FROM album_comments WHERE album_id = ?";

        $this->db->query($query, [$album->getId()]);

        $result = $this->db->fetchAll();
        $collection = [];

        foreach ($result as $row)
        {
            $user = UserRepository::create()->getOne($row['user_id']);

            $comment = new AlbumComment(
                $row['text'],
                $album,
                $user,
                $row['created_on'],
                $row['id']
            );

            $collection[] = $comment;
        }

        return $collection;
    }

    /**
     * @param $id
     * @return AlbumComment[]
     */
    public function getByUser($id){
        $query = "SELECT id, text, created_on, album_id, user_id FROM album_comments WHERE user_id = ?";

        $this->db->query($query, [$id]);

        $result = $this->db->fetchAll();
        $collection = [];

        foreach ($result as $row)
        {
            $album = AlbumRepository::create()->getOne($row['album_id']);
            $user = UserRepository::create()->getOne($row['user_id']);

            $collection[] = new AlbumComment(
                $row['text'],
                $album,
                $user,
                $row['created_on'],
                $row['id']
            );
        }

        return $collection;
    }

    /**
     * @param AlbumComment $comment
     * @return bool
     */
    public function save(AlbumComment $comment)
    {
        $query = "INSERT INTO album_comments (text, album_id, user_id ) VALUES (?, ?, ?)";
        $params = [
            $comment->getText(),
            $comment->getAlbum()->getId(),
            $comment->getUser()->getId()
        ];

        if ($comment->getId()) {
            $query = "UPDATE album_comments SET text = ?, album_id = ?, user_id = ? WHERE id = ?";
            $params[] = $comment->getId();
        }

        $this->db->query($query, $params);

        return $this->db->rows() > 0;
    }

    /**
     * @param AlbumComment $comment
     * @return bool
     */
    public function delete(AlbumComment $comment)
    {
        $query = "DELETE FROM album_comments WHERE id = ?";
        $params = [ $comment->getId()];

        $this->db->query($query, $params);

        return $this->db->rows() > 0;
    }
} 