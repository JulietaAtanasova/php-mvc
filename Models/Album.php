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

    /**
     * @var \DateTime
     */
    private $createdOn;

    /**
     * @var Picture[]
     */
    private $pictures;

    /**
     * @var AlbumComment[];
     */
    private $comments = [];

    /**
     * @var AlbumVote[];
     */
    private $votes;

    function __construct($name, $category, $user, $description, $id = null, $createdOn = null)
    {
        $this->setCategory($category);
        $this->setDescription($description);
        $this->setName($name);
        $this->setUser($user);
        $this->setId($id);
        $this->setCreatedOn($createdOn);
    }

    /**
     * @param \PhotoAlbum\Models\AlbumComment[] $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return \PhotoAlbum\Models\AlbumComment[]
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param \DateTime $createdOn
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @param \PhotoAlbum\Models\AlbumVote[] $votes
     */
    public function setVotes($votes)
    {
        $this->votes = $votes;
    }

    /**
     * @return \PhotoAlbum\Models\AlbumVote[]
     */
    public function getVotes()
    {
        return $this->votes;
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
     * @param \PhotoAlbum\Models\Picture[] $pictures
     */
    public function setPictures($pictures)
    {
        $this->pictures = $pictures;
    }

    /**
     * @return \PhotoAlbum\Models\Picture[]
     */
    public function getPictures()
    {
        return $this->pictures;
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