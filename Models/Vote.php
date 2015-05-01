<?php

namespace PhotoAlbum\Models;

class Vote
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $rate;

    /**
     * @var Picture
     */
    private $picture;

    /**
     * @var User;
     */
    private $user;

    function __construct($rate, $picture, $user, $id = null)
    {
        $this->setRate($rate);
        $this->setPicture($picture);
        $this->setUser($user);
        $this->setId($id);
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
     * @param int $rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    }

    /**
     * @return int
     */
    public function getRate()
    {
        return $this->rate;
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