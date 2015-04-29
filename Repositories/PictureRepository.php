<?php

namespace PhotoAlbum\Repositories;

use PhotoAlbum\Db;
use PhotoAlbum\Models\Picture;
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

    public function save(Picture $picture)
    {
        $query = "INSERT INTO albums (name, url, album_id, description) VALUES (?, ?, ?, ?)";
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
} 