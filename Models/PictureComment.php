<?php

namespace PhotoAlbum\Models;

use \DateTime;

class PictureComment extends Comment
{

    /**
     * @var Picture
     */
    private $picture;


    function __construct($text, $picture, $user, $createdOn = null, $id = null)
    {
        $this->setCreatedOn($createdOn);
        $this->setPicture($picture);
        $this->setText($text);
        $this->setUser($user);
        $this->setId($id);
        parent::__construct($text, $user, $createdOn = null, $id = null);
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


}