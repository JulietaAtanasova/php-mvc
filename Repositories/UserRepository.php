<?php
namespace PhotoAlbum\Repositories;

use PhotoAlbum\Db;
use PhotoAlbum\Models\User;

class UserRepository
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
        FROM users WHERE username = ? AND password = ?";

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

    /**
     * @param $id
     * @return bool|User
     */
    public function getOne($id)
    {
        $query = "SELECT id, username, password, is_admin FROM users WHERE id = ?";

        $this->db->query($query, [$id]);

        $result = $this->db->row();

        if (empty($result)) {
            return false;
        }

        $user = new User(
            $result['username'],
            $result['password'],
            $result['id'],
            $result['is_admin']
        );

        return $user;
    }

    /**
     * @param $name
     * @return bool|User
     */
    public function getOneByName($name)
    {
        $query = "SELECT id, username, password, is_admin FROM users WHERE username = ?";

        $this->db->query($query, [$name]);

        $result = $this->db->row();

        if (empty($result)) {
            return false;
        }

        $user = new User(
            $result['username'],
            $result['password'],
            $result['id'],
            $result['is_admin']
        );

        return $user;
    }

    /**
     * @return User[]
     */
    public function getAll()
    {
        $query = "SELECT id, username, password, is_admin FROM users";

        $this->db->query($query);

        $result = $this->db->fetchAll();
        $collection = [];

        foreach ($result as $row)
        {
            $collection[] = new User(
                $row['username'],
                $row['password'],
                $row['id'],
                $row['is_admin']
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