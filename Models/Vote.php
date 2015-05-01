<?php

namespace PhotoAlbum\Models;

class Vote
{
    /**
     * @var int
     */
    protected  $id;

    /**
     * @var int
     */
    protected  $rate;

    /**
     * @var User;
     */
    protected $user;

    protected function __construct($rate, $user, $id = null)
    {
        $this->setRate($rate);
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