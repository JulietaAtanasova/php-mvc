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

            $collection[] = new Album(
                $row['name'],
                $category,
                $user,
                $row['description'],
                $row['id']
            );
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

            $collection[] = new Album(
                $row['name'],
                $category,
                $user,
                $row['description'],
                $row['id']
            );
        }

        return $collection;
    }

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
} 