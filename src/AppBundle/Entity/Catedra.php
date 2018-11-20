<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Catedra
 *
 * @ORM\Table(name="catedra")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CatedraRepository")
 */
class Catedra
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
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="email_contacto", type="string", length=255)
     */
    private $emailContacto;

    /**
     * @var string
     *
     * @ORM\Column(name="horario_atencion", type="string", length=255)
     */
    private $horarioAtencion;

    /**
     * @var int
     *
     * @ORM\Column(name="telefono_contacto", type="integer", nullable=true)
     */
    private $telefonoContacto;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="catedras")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     */
    private $usuarioResponsable;


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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Catedra
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set emailContacto
     *
     * @param string $emailContacto
     *
     * @return Catedra
     */
    public function setEmailContacto($emailContacto)
    {
        $this->emailContacto = $emailContacto;

        return $this;
    }

    /**
     * Get emailContacto
     *
     * @return string
     */
    public function getEmailContacto()
    {
        return $this->emailContacto;
    }

    /**
     * Set horarioAtencion
     *
     * @param \DateTime $horarioAtencion
     *
     * @return Catedra
     */
    public function setHorarioAtencion($horarioAtencion)
    {
        $this->horarioAtencion = $horarioAtencion;

        return $this;
    }

    /**
     * Get horarioAtencion
     *
     * @return \DateTime
     */
    public function getHorarioAtencion()
    {
        return $this->horarioAtencion;
    }

    /**
     * Set telefonoContacto
     *
     * @param integer $telefonoContacto
     *
     * @return Catedra
     */
    public function setTelefonoContacto($telefonoContacto)
    {
        $this->telefonoContacto = $telefonoContacto;

        return $this;
    }

    /**
     * Get telefonoContacto
     *
     * @return int
     */
    public function getTelefonoContacto()
    {
        return $this->telefonoContacto;
    }

    /**
     * Set usuarioResponsable
     *
     * @param \AppBundle\Entity\Usuario $usuarioResponsable
     *
     * @return Catedra
     */
    public function setUsuarioResponsable(\AppBundle\Entity\Usuario $usuarioResponsable = null)
    {
        $this->usuarioResponsable = $usuarioResponsable;

        return $this;
    }

    /**
     * Get usuarioResponsable
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuarioResponsable()
    {
        return $this->usuarioResponsable;
    }
}
