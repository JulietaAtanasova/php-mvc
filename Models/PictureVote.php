<?php

namespace PhotoAlbum\Models;

use PhotoAlbum\Repositories\VoteRepository;

class PictureVote extends Vote
{
    /**
     * @var Picture
     */
    private $picture;

    function __construct($rate, $picture, $user, $id = null)
    {
        $this->setPicture($picture);
        parent::__construct($rate, $user,$id);
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

    public function save()
    {
        return VoteRepository::create()->save($this);
    }
} 