<?php

namespace AppBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @UniqueEntity(fields={"email"}, message="This User has already existed!")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank ()
     * @Assert\Email()
     */
    private $email;

    /**
     * To password encode
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * creates a non-persisted field -- for encoded password
     * @Assert\NotBlank (groups={"Registration"})
     * registration just name and add to UserRegistrationForm section
     * this plain pwd used for only registration form so added/created a group (ex: edit profile page)
     * @var string
     */
    private $plainPassword;

    public function getUsername()
    {
        return $this->email;
    }

    // this is used to set the ROLES permission; added and stored $roles in a array
    // providing roles functions in fixtures.yml to order to login as a res. role
    /**
     * @ORM\Column (type="json")
     */
    private $roles = [];

    public function getRoles()
    {
        // See Security.yml
        //return ['ROLE_USER'];
        $roles = $this->roles;

        if (!in_array('ROLE_USER', $roles)) {
            $roles[] = 'ROLE_USER';
        }

        return $roles;
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    public function getPassword()
    {
        // TODO: Implement getPassword() method.
        return $this->password;
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.

    }

    public function eraseCredentials()
    {
        // minor security measure to prevent passwd accidentally saved anywhere
        $this->plainPassword = null;

    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        // forces the object to look 'dirty' to doctrine.
        // Avoids doctrine  NOT saving this entity field, unless this plainPassword has been changed
        // This object looks it has been changed (password)
        // it is very essential part

        $this->password = null;
    }
}