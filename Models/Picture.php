<?php

namespace PhotoAlbum\Models;

class Picture
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
    private $url;

    /**
     * @var string
     */
    private $description;

    /**
     * @var Album
     */
    private $album;

    function __construct($name, $url, $album, $description, $id = null)
    {
        $this->setAlbum($album);
        $this->setDescription($description);
        $this->setId($id);
        $this->setName($name);
        $this->setUrl($url);
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
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

}