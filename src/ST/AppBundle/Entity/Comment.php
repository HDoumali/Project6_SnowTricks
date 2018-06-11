<?php

namespace ST\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="ST\AppBundle\Repository\CommentRepository")
 */
class Comment
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;
    
    /**
     * @ORM\ManyToOne(targetEntity="ST\AppBundle\Entity\Trick", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $trick;
    
    /**
     * @ORM\ManyToOne(targetEntity="ST\UserBundle\Entity\User", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
    
    public function __construct()
    {
        $this->date = new \DateTime();
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Comment
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set trick
     *
     * @param \ST\AppBundle\Entity\Trick $trick
     *
     * @return Comment
     */
    public function setTrick(\ST\AppBundle\Entity\Trick $trick)
    {
        $this->trick = $trick;

        return $this;
    }

    /**
     * Get trick
     *
     * @return \ST\AppBundle\Entity\Trick
     */
    public function getTrick()
    {
        return $this->trick;
    }

    /**
     * Set user
     *
     * @param \ST\UserBundle\Entity\User $user
     *
     * @return Comment
     */
    public function setUser(\ST\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \ST\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
