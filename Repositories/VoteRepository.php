<?php

namespace PhotoAlbum\Repositories;

use PhotoAlbum\Db;
use PhotoAlbum\Models\Picture;
use PhotoAlbum\Models\PictureVote;

class VoteRepository
{
    /**
     * @var \PhotoAlbum\Db
     */
    private $db;

    /**
     * @var VoteRepository
     */
    private static $inst = null;

    private function __construct(\PhotoAlbum\Db $db)
    {
        $this->db = $db;
    }

    /**
     * @return VoteRepository
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
     * @return bool|PictureVote
     */
    public function getOne($id)
    {
        $query = "SELECT id, rate, picture_id, user_id FROM votes WHERE id = ?";

        $this->db->query($query, [$id]);

        $result = $this->db->row();

        if (empty($result)) {
            return false;
        }

        $picture = PictureRepository::create()->getOne($result['picture_id']);
        $user = UserRepository::create()->getOne($result['user_id']);

        $vote = new PictureVote(
            $result['rate'],
            $picture,
            $user,
            $result['id']
        );

        return $vote;
    }

    /**
     * @param Picture $picture
     * @return array
     */
    public function getByPicture(Picture $picture){
        $query = "SELECT id, rate, picture_id, user_id FROM votes WHERE picture_id = ?";

        $this->db->query($query, [$picture->getId()]);

        $result = $this->db->fetchAll();
        $collection = [];

        foreach ($result as $row)
        {
            $user = UserRepository::create()->getOne($row['user_id']);

            $collection[] = new PictureVote(
                $row['rate'],
                $picture,
                $user,
                $row['id']
            );
        }

        return $collection;
    }

    /**
     * @param $id
     * @return PictureVote[]
     */
    public function getByUser($id){
        $query = "SELECT id, rate, picture_id, user_id FROM votes WHERE user_id = ?";

        $this->db->query($query, [$id]);

        $result = $this->db->fetchAll();
        $collection = [];

        foreach ($result as $row)
        {
            $picture = PictureRepository::create()->getOne($row['picture_id']);
            $user = UserRepository::create()->getOne($row['user_id']);

            $collection[] = new PictureVote(
                $row['rate'],
                $picture,
                $user,
                $row['id']
            );
        }

        return $collection;
    }

    /**
     * @param PictureVote $vote
     * @return bool
     */
    public function save(PictureVote $vote)
    {
        $query = "INSERT INTO votes (rate, picture_id, user_id ) VALUES (?, ?, ?)";
        $params = [
            $vote->getRate(),
            $vote->getPicture()->getId(),
            $vote->getUser()->getId()
        ];

        if ($vote->getId()) {
            $query = "UPDATE votes SET rate = ?, picture_id = ?, user_id = ? WHERE id = ?";
            $params[] = $vote->getId();
        }

        $this->db->query($query, $params);

        return $this->db->rows() > 0;
    }

    /**
     * @param PictureVote $vote
     * @return bool
     */
    public function delete(PictureVote $vote)
    {
        $query = "DELETE FROM votes WHERE id = ?";
        $params = [ $vote->getId()];

        $this->db->query($query, $params);

        return $this->db->rows() > 0;
    }
} 