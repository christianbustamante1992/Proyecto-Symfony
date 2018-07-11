<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Contacto
 *
 * @ORM\Table(name="contacto")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContactoRepository")
 */
class Contacto
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
     * @ORM\Column(name="contacto_nombre", type="string", length=255)
     */
    private $contactoNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="contacto_email", type="string", length=255)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    private $contactoEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="contacto_mensaje", type="string", length=255)
     */
    private $contactoMensaje;


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
     * Set contactoNombre
     *
     * @param string $contactoNombre
     *
     * @return Contacto
     */
    public function setContactoNombre($contactoNombre)
    {
        $this->contactoNombre = $contactoNombre;

        return $this;
    }

    /**
     * Get contactoNombre
     *
     * @return string
     */
    public function getContactoNombre()
    {
        return $this->contactoNombre;
    }

    /**
     * Set contactoEmail
     *
     * @param string $contactoEmail
     *
     * @return Contacto
     */
    public function setContactoEmail($contactoEmail)
    {
        $this->contactoEmail = $contactoEmail;

        return $this;
    }

    /**
     * Get contactoEmail
     *
     * @return string
     */
    public function getContactoEmail()
    {
        return $this->contactoEmail;
    }

    /**
     * Set contactoMensaje
     *
     * @param string $contactoMensaje
     *
     * @return Contacto
     */
    public function setContactoMensaje($contactoMensaje)
    {
        $this->contactoMensaje = $contactoMensaje;

        return $this;
    }

    /**
     * Get contactoMensaje
     *
     * @return string
     */
    public function getContactoMensaje()
    {
        return $this->contactoMensaje;
    }
}

