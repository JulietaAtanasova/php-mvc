<?php
namespace PhotoAlbum\Models;

use PhotoAlbum\Repositories\UserRepository;

class User
{
    private $id;

    private $username;

    private $password;

    private $isAdmin;

    public function __construct($username, $password, $id = null, $isAdmin = false)
    {
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setId($id);
        $this->setAdmin($isAdmin);
    }

    private function setAdmin($admin)
    {
        $this->isAdmin = (bool)$admin;
    }

    public function isAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = md5($password);
    }

    public function save()
    {
        return UserRepository::create()->save($this);
    }

}