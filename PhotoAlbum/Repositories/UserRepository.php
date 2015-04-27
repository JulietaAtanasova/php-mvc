<?php
namespace PhotoAlbum\Repositories;

use PhotoAlbum\Db;
use PhotoAlbum\Models\User;

class PlayerRepository
{
    /**
     * @var \PhotoAlbum\Db
     */
    private $db;

    /**
     * @var UserRepository
     */
    private static $inst = null;

    private function __construct(\PhotoAlbum\Db $db)
    {
        $this->db = $db;
    }

    /**
     * @return UserRepository
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
     * @param $user
     * @param $pass
     * @return bool|User
     */
    public function getOneByDetails($user, $pass)
    {
        $query = "SELECT id, username, password
        FROM players WHERE username = ? AND password = ?";

        $this->db->query($query,
            [
                $user,
                md5($pass)
            ]
        );

        $result = $this->db->row();

        if (empty($result)) return false;

        return $this->getOne($result['id']);
    }


    public function getOne($id)
    {
        $query = "SELECT id, username, password
        FROM players WHERE id = ?";

        $this->db->query($query, [$id]);

        $result = $this->db->row();

        if (empty($result)) {
            return false;
        }

        $player = new User(
            $result['username'],
            $result['password'],
            $result['id']
        );

        return $player;
    }

    /**
     * @return User[]
     */
    public function getAll()
    {
        $query = "SELECT id, username, password FROM users";

        $this->db->query($query);

        $result = $this->db->fetchAll();
        $collection = [];

        foreach ($result as $row)
        {
            $collection[] = new User(
                $row['username'],
                $row['password'],
                $row['id']
            );
        }

        return $collection;
    }

    public function save(User $user)
    {
        $query = "INSERT INTO users (username, password) VALUES (?, ?)";
        $params = [
            $user->getUsername(),
            $user->getPassword()
        ];

        if ($user->getId()) {
            $query = "UPDATE users SET username = ?, password = ? WHERE id = ?";
            $params[] = $user->getId();
        }

        $this->db->query($query, $params);

        return $this->db->rows() > 0;
    }
}