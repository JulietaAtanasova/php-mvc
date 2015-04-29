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