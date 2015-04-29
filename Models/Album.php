<?php

namespace PhotoAlbum\Models;

use PhotoAlbum\Repositories\AlbumRepository;

class Album
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
     * @var string
     */
    private $description;

    /**
     * @var Category
     */
    private $category;

    /**
     * @var User
     */
    private $user;

    function __construct($category, $name, $user, $description, $id = null)
    {
        $this->setCategory($category);
        $this->setDescription($description);
        $this->setName($name);
        $this->setUser($user);
        $this->setId($id);
    }

    /**
     * @param \PhotoAlbum\Models\Category $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return \PhotoAlbum\Models\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
    public function setUser($user)
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
        return AlbumRepository::create()->save($this);
    }

} 