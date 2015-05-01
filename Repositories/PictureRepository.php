<?php

namespace PhotoAlbum\Repositories;

use PhotoAlbum\Db;
use PhotoAlbum\Models\Picture;
use PhotoAlbum\Models\Album;
class PictureRepository
{
    /**
     * @var \PhotoAlbum\Db
     */
    private $db;

    /**
     * @var PictureRepository
     */
    private static $inst = null;

    private function __construct(\PhotoAlbum\Db $db)
    {
        $this->db = $db;
    }

    /**
     * @return PictureRepository
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
     * @return bool|Picture
     */
    public function getOne($id)
    {
        $query = "SELECT id, name, album_id, url, created_on, description FROM pictures WHERE id = ?";

        $this->db->query($query, [$id]);

        $result = $this->db->row();

        if (empty($result)) {
            return false;
        }

        $album = AlbumRepository::create()->getOne($result['album_id']);

        $picture = new Picture(
            $result['name'],
            $result['url'],
            $album,
            $result['createdOn'],
            $result['description'],
            $result['id']
        );

        return $picture;
    }

    /**
     * @return Picture[]
     */
    public function getAll()
    {
        $query = "SELECT id, name, album_id, url, created_on, description FROM pictures";

        $this->db->query($query);

        $result = $this->db->fetchAll();
        $collection = [];

        if (empty($result)) {
            return false;
        }

        foreach ($result as $row)
        {
            $album = AlbumRepository::create()->getOne($row['album_id']);

            $picture = new Picture(
                $row['name'],
                $row['url'],
                $album,
                $row['description'],
                $row['created_on'],
                $row['id']
            );

            $comments = CommentRepository::create()->getByPicture($picture);
            $picture->setComments($comments);

            $collection[] = $picture;
        }

        return $collection;
    }

    /**
     * @param Album $album
     * @return array|bool
     */
    public function getByAlbum(Album $album)
    {
        $query = "SELECT id, name, album_id, url, created_on, description FROM pictures WHERE album_id = ?";

        $this->db->query($query, [$album->getId()]);

        $result = $this->db->fetchAll();
        $collection = [];

        if (empty($result)) {
            return false;
        }

        foreach ($result as $row)
        {
            $picture = new Picture(
                $row['name'],
                $row['url'],
                $album,
                $row['description'],
                $row['created_on'],
                $row['id']
            );

            $comments = CommentRepository::create()->getByPicture($picture);
            $picture->setComments($comments);

            $votes = VoteRepository::create()->getByPicture($row['id']);
            $picture->setVotes($votes);

            $collection[] = $picture;
        }

        return $collection;
    }

    /**
     * @param Picture $picture
     * @return bool
     */
    public function save(Picture $picture)
    {
        $query = "INSERT INTO pictures (name, url, album_id, description) VALUES (?, ?, ?, ?)";
        $params = [
            $picture->getName(),
            $picture->getUrl(),
            $picture->getAlbum()->getId(),
            $picture->getDescription()
        ];

        if ($picture->getId()) {
            $query = "UPDATE pictures SET name = ?, url = ?, album_id = ?, description = ? WHERE id = ?";
            $params[] = $picture->getId();
        }

        $this->db->query($query, $params);

        return $this->db->rows() > 0;
    }

    /**
     * @param Picture $picture
     * @return bool
     */
    public function delete(Picture $picture)
    {
        $query = "DELETE FROM albums WHERE id = ?";
        $params = [ $picture->getId()];

        $this->db->query($query, $params);

        return $this->db->rows() > 0;
    }
} 