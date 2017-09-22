<?php

namespace MoviesBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table(name="genre")
 * @ORM\Entity(repositoryClass="MoviesBundle\Repository\GenreRepository")
 */
class Genre
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, unique=true)
     */
    private $name;


    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="MoviesBundle\Entity\Movie", mappedBy="genres")
     */
    private $movies;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->movies = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Genre
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add movie
     *
     * @param \MoviesBundle\Entity\Movie $movie
     *
     * @return Genre
     */
    public function addMovie(\MoviesBundle\Entity\Movie $movie)
    {
        $this->movies[] = $movie;

        return $this;
    }

    /**
     * Remove movie
     *
     * @param \MoviesBundle\Entity\Movie $movie
     */
    public function removeMovie(\MoviesBundle\Entity\Movie $movie)
    {
        $this->movies->removeElement($movie);
    }

    /**
     * Get movies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMovies()
    {
        return $this->movies;
    }
}
