<?php

namespace PhotoAlbum\Models;

use \DateTime;

class Comment
{
    /**
     * @var int
     */
    protected  $id;

    /**
     * @var string
     */
    protected  $text;

    /**
     * @var DateTime
     */
    protected  $createdOn;

    /**
     * @var User
     */
    protected  $user;

    protected function __construct($text, $user, $createdOn = null, $id = null)
    {
        $this->setCreatedOn($createdOn);
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