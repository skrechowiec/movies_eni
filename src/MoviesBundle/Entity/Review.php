<?php

namespace MoviesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Review
 *
 * @ORM\Table(name="review")
 * @ORM\Entity(repositoryClass="MoviesBundle\Repository\ReviewRepository")
 */
class Review
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
     * @ORM\Column(name="Titre", type="string", length=50)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="Critique", type="string", length=255)
     */
    private $critique;

    /**
     * @var int
     *
     * @ORM\Column(name="Note", type="integer")
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="pseudo", type="string", length=255)
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Movie", inversedBy="critiques")
     */
    private $film;


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
     * Set titre
     *
     * @param string $titre
     *
     * @return Review
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set critique
     *
     * @param string $critique
     *
     * @return Review
     */
    public function setCritique($critique)
    {
        $this->critique = $critique;

        return $this;
    }

    /**
     * Get critique
     *
     * @return string
     */
    public function getCritique()
    {
        return $this->critique;
    }

    /**
     * Set note
     *
     * @param integer $note
     *
     * @return Review
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return int
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     *
     * @return Review
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set film
     *
     * @param \MoviesBundle\Entity\Movie $film
     *
     * @return Review
     */
    public function setFilm(\MoviesBundle\Entity\Movie $film = null)
    {
        $this->film = $film;

        return $this;
    }

    /**
     * Get film
     *
     * @return \MoviesBundle\Entity\Movie
     */
    public function getFilm()
    {
        return $this->film;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
