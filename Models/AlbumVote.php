<?php

namespace PhotoAlbum\Models;

class AlbumVote extends Vote
{
    /**
     * @var Album
     */
    private $album;

    function __construct($rate, $album, $user, $id = null)
    {
        $this->setAlbum($album);
        parent::__construct($rate, $user,$id);
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