<?php

namespace ST\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Trick
 *
 * @ORM\Table(name="trick")
 * @ORM\Entity(repositoryClass="ST\AppBundle\Repository\TrickRepository")
 * @UniqueEntity(fields="name", message="Une figure existe deja avec ce nom.")
 */
class Trick
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @var string
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;
    
    /**
     * @ORM\ManyToOne(targetEntity="ST\AppBundle\Entity\Category", cascade={"persist"})
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="ST\AppBundle\Entity\Picture", mappedBy="trick", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $pictures;
    
    /**
     * @ORM\OneToMany(targetEntity="ST\AppBundle\Entity\Video", mappedBy="trick", cascade={"persist", "remove"})
     */
    private $videos;
    
    /**
     * @ORM\OneToMany(targetEntity="ST\AppBundle\Entity\Comment", mappedBy="trick", cascade={"persist", "remove"})
     */
    private $comments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pictures = new \Doctrine\Common\Collections\ArrayCollection();
        $this->videos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set description
     *
     * @param string $description
     *
     * @return Trick
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Trick
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Trick
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set category
     *
     * @param \ST\AppBundle\Entity\Category $category
     *
     * @return Trick
     */
    public function setCategory(\ST\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \ST\AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
    

    /**
     * Add picture
     *
     * @param \ST\AppBundle\Entity\Picture $picture
     *
     * @return Trick
     */
    public function addPicture(\ST\AppBundle\Entity\Picture $picture)
    {
        $this->pictures[] = $picture;

        //$picture->setTrick($this);

        return $this;
    }

    /**
     * Remove picture
     *
     * @param \ST\AppBundle\Entity\Picture $picture
     */
    public function removePicture(\ST\AppBundle\Entity\Picture $picture)
    {
        $this->pictures->removeElement($picture);
    }

    /**
     * Get pictures
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPictures()
    {
        return $this->pictures;
    }

    /**
     * Add video
     *
     * @param \ST\AppBundle\Entity\Video $video
     *
     * @return Trick
     */
    public function addVideo(\ST\AppBundle\Entity\Video $video)
    {
        $this->videos[] = $video;

        $video->setTrick($this);

        return $this;
    }

    /**
     * Remove video
     *
     * @param \ST\AppBundle\Entity\Video $video
     */
    public function removeVideo(\ST\AppBundle\Entity\Video $video)
    {
        $this->videos->removeElement($video);
    }

    /**
     * Get videos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * Add comment
     *
     * @param \ST\AppBundle\Entity\Comment $comment
     *
     * @return Trick
     */
    public function addComment(\ST\AppBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        $comment->setTrick($this);

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \ST\AppBundle\Entity\Comment $comment
     */
    public function removeComment(\ST\AppBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }
}
