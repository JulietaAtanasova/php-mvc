<?php
namespace PhotoAlbum\Models;

use PhotoAlbum\Repositories\CategoryRepository;
class Category
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var User
     */
    private $user;

    /**
     * @param $id
     * @param $name
     * @param User $user
     */
    function __construct($name, User $user, $id = null)
    {
        $this->setId($id);
        $this->setName($name);
        $this->setUser($user);
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \PhotoAlbum\Models\User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return \PhotoAlbum\Models\User
     */
    public function getUser()
    {
        return $this->user;
    }

    public function save()
    {
        return CategoryRepository::create()->save($this);
    }
} 