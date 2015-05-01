<?php

namespace PhotoAlbum\Repositories;

use PhotoAlbum\Db;
use PhotoAlbum\Models\Album;

class AlbumRepository
{
    /**
     * @var \PhotoAlbum\Db
     */
    private $db;

    /**
     * @var AlbumRepository
     */
    private static $inst = null;

    private function __construct(\PhotoAlbum\Db $db)
    {
        $this->db = $db;
    }

    /**
     * @return AlbumRepository
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
     * @return bool|Album
     */
    public function getOne($id)
    {
        $query = "SELECT id, name, description, category_id, user_id FROM albums WHERE id = ?";

        $this->db->query($query, [$id]);

        $result = $this->db->row();

        if (empty($result)) {
            return false;
        }

        $category = CategoryRepository::create()->getOne($result['category_id']);
        $user = UserRepository::create()->getOne($result['user_id']);

        $album = new Album(
            $result['name'],
            $category,
            $user,
            $result['description'],
            $result['id']
        );

        $pictures = PictureRepository::create()->getByAlbum($album);
        $album->setPictures($pictures);

        $comments = AlbumCommentRepository::create()->getByAlbum($album);
        $album->setComments($comments);

        return $album;
    }

    /**
     * @return Album[]
     */
    public function getAll()
    {
        $query = "SELECT id, name, description, category_id, user_id FROM albums";

        $this->db->query($query);

        $result = $this->db->fetchAll();
        $collection = [];

        foreach ($result as $row)
        {
            $category = CategoryRepository::create()->getOne($row['category_id']);
            $user = UserRepository::create()->getOne($row['user_id']);

            $album = new Album(
                $row['name'],
                $category,
                $user,
                $row['description'],
                $row['id']
            );

            $pictures = PictureRepository::create()->getByAlbum($album);
            $album->setPictures($pictures);

            $comments = AlbumCommentRepository::create()->getByAlbum($album);
            $album->setComments($comments);

            $votes = AlbumVoteRepository::create()->getByAlbum($album);
            $album->setVotes($votes);

            $collection[] = $album;
        }

        return $collection;
    }

    /**
     * @param $id
     * @return Album[]
     */
    public function getByCategory($id){
        $query = "SELECT id, name, description, category_id, user_id FROM albums WHERE category_id = ?";

        $this->db->query($query, [$id]);

        $result = $this->db->fetchAll();
        $collection = [];

        foreach ($result as $row)
        {
            $category = CategoryRepository::create()->getOne($row['category_id']);
            $user = UserRepository::create()->getOne($row['user_id']);

            $album = new Album(
                $row['name'],
                $category,
                $user,
                $row['description'],
                $row['id']
            );

            $pictures = PictureRepository::create()->getByAlbum($row['id']);
            $album->setPictures($pictures);
            $collection[] = $album;
        }

        return $collection;
    }

    /**
     * @param $id
     * @return Album[]
     */
    public function getByUser($id){
        $query = "SELECT id, name, description, category_id, user_id FROM albums WHERE user_id = ?";

        $this->db->query($query, [$id]);

        $result = $this->db->fetchAll();
        $collection = [];

        foreach ($result as $row)
        {
            $category = CategoryRepository::create()->getOne($row['category_id']);
            $user = UserRepository::create()->getOne($row['user_id']);

            $album = new Album(
                $row['name'],
                $category,
                $user,
                $row['description'],
                $row['id']
            );

            $pictures = PictureRepository::create()->getByAlbum($row['id']);
            $album->setPictures($pictures);
            $collection[] = $album;
        }

        return $collection;
    }

    /**
     * @param Album $album
     * @return bool
     */
    public function save(Album $album)
    {
        $query = "INSERT INTO albums (name, category_id, user_id, description) VALUES (?, ?, ?, ?)";
        $params = [
            $album->getName(),
            $album->getCategory()->getId(),
            $album->getUser()->getId(),
            $album->getDescription()
        ];

        if ($album->getId()) {
            $query = "UPDATE albums SET name = ?, category_id = ?, user_id = ?, description = ? WHERE id = ?";
            $params[] = $album->getId();
        }

        $this->db->query($query, $params);

        return $this->db->rows() > 0;
    }

    /**
     * @param Album $album
     * @return bool
     */
    public function delete(Album $album)
    {
        $query = "DELETE FROM albums WHERE id = ?";
        $params = [ $album->getId()];

        $this->db->query($query, $params);

        return $this->db->rows() > 0;
    }

    /**
     * @param Album $album
     * @return float
     */
    public function getRating(Album $album)
    {
        $query = "SELECT rate FROM album_votes WHERE album_id = ?";
        $params = [ $album->getId()];
        $this->db->query($query, $params);
        $result = $this->db->fetchAll();

        $sum = 0;
        foreach ($result as $row)
        {
            $sum += (int)$row['rate'];
        }

        $rating = 0;
        if(count($result) >0){
            $rating = $sum / count($result);
        }

        return $rating;
    }
} 