<?php

namespace PhotoAlbum\Models;

use \DateTime;

class AlbumComment extends Comment
{

    /**
     * @var Album
     */
    private $album;


    function __construct($text, $album, $user, $createdOn = null, $id = null)
    {
        $this->setCreatedOn($createdOn);
        $this->setAlbum($album);
        $this->setText($text);
        $this->setUser($user);
        $this->setId($id);
        parent::__construct($text, $user, $createdOn = null, $id = null);
    }

    /**
     * @param \PhotoAlbum\Models\Album $album
     */
    public function setAlbum($album)
    {
        $this->album = $album;
    }

    /**
     * @return \PhotoAlbum\Models\Album
     */
    public function getAlbum()
    {
        return $this->album;
    }

}