<?php

namespace PhotoAlbum\Repositories;

use PhotoAlbum\Db;
use PhotoAlbum\Models\Album;
use PhotoAlbum\Models\AlbumVote;

class AlbumVoteRepository
{
    /**
     * @var \PhotoAlbum\Db
     */
    private $db;

    /**
     * @var ALbumVoteRepository
     */
    private static $inst = null;

    private function __construct(\PhotoAlbum\Db $db)
    {
        $this->db = $db;
    }

    /**
     * @return ALbumVoteRepository
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
     * @return bool|AlbumVote
     */
    public function getOne($id)
    {
        $query = "SELECT id, rate, album_id, user_id FROM album_votes WHERE id = ?";

        $this->db->query($query, [$id]);

        $result = $this->db->row();

        if (empty($result)) {
            return false;
        }


        $album = AlbumRepository::create()->getOne($result['album_id']);
        $user = UserRepository::create()->getOne($result['user_id']);

        $vote = new AlbumVote(
            $result['rate'],
            $album,
            $user,
            $result['id']
        );

        return $vote;
    }

    /**
     * @param Album $album
     * @return array
     */
    public function getByAlbum(Album $album){
        $query = "SELECT id, rate, album_id, user_id FROM album_votes WHERE album_id = ?";

        $this->db->query($query, [$album->getId()]);

        $result = $this->db->fetchAll();
        $collection = [];

        foreach ($result as $row)
        {
            $user = UserRepository::create()->getOne($row['user_id']);

            $collection[] = new AlbumVote(
                $row['rate'],
                $album,
                $user,
                $row['id']
            );
        }

        return $collection;
    }

    /**
     * @param $id
     * @return AlbumVote[]
     */
    public function getByUser($id){
        $query = "SELECT id, rate, album_id, user_id FROM album_votes WHERE user_id = ?";

        $this->db->query($query, [$id]);

        $result = $this->db->fetchAll();
        $collection = [];

        foreach ($result as $row)
        {
            $album = AlbumRepository::create()->getOne($row['album_id']);
            $user = UserRepository::create()->getOne($row['user_id']);

            $collection[] = new AlbumVote(
                $row['rate'],
                $album,
                $user,
                $row['id']
            );
        }

        return $collection;
    }

    /**
     * @param AlbumVote $vote
     * @return bool
     */
    public function save(AlbumVote $vote)
    {
        $query = "INSERT INTO album_votes (rate, album_id, user_id ) VALUES (?, ?, ?)";
        $params = [
            $vote->getRate(),
            $vote->getAlbum()->getId(),
            $vote->getUser()->getId()
        ];

        if ($vote->getId()) {
            $query = "UPDATE album_votes SET rate = ?, album_id = ?, user_id = ? WHERE id = ?";
            $params[] = $vote->getId();
        }

        $this->db->query($query, $params);

        return $this->db->rows() > 0;
    }

    /**
     * @param AlbumVote $vote
     * @return bool
     */
    public function delete(AlbumVote $vote)
    {
        $query = "DELETE FROM album_votes WHERE id = ?";
        $params = [ $vote->getId()];

        $this->db->query($query, $params);

        return $this->db->rows() > 0;
    }
} 