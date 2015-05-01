<?php

namespace PhotoAlbum\Models;

use \DateTime;

class Comment
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $text;

    /**
     * @var DateTime
     */
    private $createdOn;

    /**
     * @var Picture
     */
    private $picture;

    /**
     * @var User
     */
    private $user;

    function __construct($text, $picture, $user, $createdOn = null, $id = null)
    {
        $this->setCreatedOn($createdOn);
        $this->setPicture($picture);
        $this->setText($text);
        $this->setUser($user);
        $this->setId($id);
    }

    /**
     * @param \DateTime $createdOn
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = date_create($createdOn);
    }

    /**
     * @return \DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
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
     * @param \PhotoAlbum\Models\Picture $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return \PhotoAlbum\Models\Picture
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
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

}