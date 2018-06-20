<?php

namespace ST\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="ST\UserBundle\Repository\UserRepository")
 * @UniqueEntity(fields="username", message="Un compte existe deja avec ce nom d'utilisateur.")
 * @UniqueEntity(fields="email", message="Un compte existe deja avec cette adresse email.")
 */
class User implements UserInterface
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
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     * @Assert\NotBlank(message="Veuillez renseigner votre adresse email", groups={"forgotPassword"})
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     * @Assert\NotBlank(groups={"resetPassword"})
     */
    private $plainPassword;

    /**
     * @var array
     *
     * @ORM\Column(name="roles", type="array")
     */
    private $roles = array('ROLE_USER');

    /**
    * @ORM\OneToOne(targetEntity="ST\AppBundle\Entity\Picture", cascade={"persist", "remove"})
    * @ORM\JoinColumn(nullable=true)
    * @Assert\Valid()
    */
    private $picture;
    
    /**
     * @ORM\OneToMany(targetEntity="ST\AppBundle\Entity\Comment", mappedBy="user", cascade={"persist", "remove"})
     */
    private $comments;
    
    /**
     * @ORM\Column(name="validationtoken", type="string", nullable=true)
     */
    private $validationToken;
    
    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * Constructor
     */
    public function __construct()
    {   
        $this->isActive = false;
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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

     public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return User
     */
    
    /*public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }*/

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return null;
    }
    
    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    public function eraseCredentials()
    {
    }
    
    /**
     * Set picture
     *
     * @param \ST\AppBundle\Entity\Picture $picture
     *
     * @return User
     */
    public function setPicture(\ST\AppBundle\Entity\Picture $picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return \ST\AppBundle\Entity\Picture
     */
    public function getPicture()
    {
        return $this->picture;
    }
    
    /**
     * Set validationToken
     *
     * @param string $validationToken
     *
     * @return User
     */
    public function setValidationToken($validationToken)
    {
        $this->validationToken = $validationToken;

        return $this;
    }

    /**
     * Get validationToken
     *
     * @return string
     */
    public function getValidationToken()
    {
        return $this->validationToken;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Add comment
     *
     * @param \ST\AppBundle\Entity\Comment $comment
     *
     * @return User
     */
    public function addComment(\ST\AppBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

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
