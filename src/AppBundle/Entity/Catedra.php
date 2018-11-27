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
     * @ORM\Column(name="secretario", type="string", length=255)
     */
    private $secretario;

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
     * @ORM\OneToMany(targetEntity="Usuario", mappedBy="catedra")
     */
    private $usuariosResponsables;

    /**
     * @ORM\OneToMany(targetEntity="Publicacion", mappedBy="catedra")
     */
    private $publicacionesCatedra;


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
     * Constructor
     */
    public function __construct()
    {
        $this->usuariosResponsables = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set nombre.
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
     * Get nombre.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set emailContacto.
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
     * Get emailContacto.
     *
     * @return string
     */
    public function getEmailContacto()
    {
        return $this->emailContacto;
    }

    /**
     * Set horarioAtencion.
     *
     * @param string $horarioAtencion
     *
     * @return Catedra
     */
    public function setHorarioAtencion($horarioAtencion)
    {
        $this->horarioAtencion = $horarioAtencion;

        return $this;
    }

    /**
     * Get horarioAtencion.
     *
     * @return string
     */
    public function getHorarioAtencion()
    {
        return $this->horarioAtencion;
    }

    /**
     * Set telefonoContacto.
     *
     * @param int|null $telefonoContacto
     *
     * @return Catedra
     */
    public function setTelefonoContacto($telefonoContacto = null)
    {
        $this->telefonoContacto = $telefonoContacto;

        return $this;
    }

    /**
     * Get telefonoContacto.
     *
     * @return int|null
     */
    public function getTelefonoContacto()
    {
        return $this->telefonoContacto;
    }

    /**
     * Add usuariosResponsable.
     *
     * @param \AppBundle\Entity\Usuario $usuariosResponsable
     *
     * @return Catedra
     */
    public function addUsuariosResponsable(\AppBundle\Entity\Usuario $usuariosResponsable)
    {
        $this->usuariosResponsables[] = $usuariosResponsable;

        return $this;
    }

    /**
     * Remove usuariosResponsable.
     *
     * @param \AppBundle\Entity\Usuario $usuariosResponsable
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeUsuariosResponsable(\AppBundle\Entity\Usuario $usuariosResponsable)
    {
        return $this->usuariosResponsables->removeElement($usuariosResponsable);
    }

    /**
     * Get usuariosResponsables.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuariosResponsables()
    {
        return $this->usuariosResponsables;
    }


    /**
     * Add publicacionesCatedra.
     *
     * @param \AppBundle\Entity\Publicacion $publicacionesCatedra
     *
     * @return Catedra
     */
    public function addPublicacionesCatedra(\AppBundle\Entity\Publicacion $publicacionesCatedra)
    {
        $this->publicacionesCatedra[] = $publicacionesCatedra;

        return $this;
    }

    /**
     * Remove publicacionesCatedra.
     *
     * @param \AppBundle\Entity\Publicacion $publicacionesCatedra
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePublicacionesCatedra(\AppBundle\Entity\Publicacion $publicacionesCatedra)
    {
        return $this->publicacionesCatedra->removeElement($publicacionesCatedra);
    }

    /**
     * Get publicacionesCatedra.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPublicacionesCatedra()
    {
        return $this->publicacionesCatedra;
    }

    public function __toString() {
        return $this->nombre;
    }

    /**
     * Set secretario.
     *
     * @param string $secretario
     *
     * @return Catedra
     */
    public function setSecretario($secretario)
    {
        $this->secretario = $secretario;

        return $this;
    }

    /**
     * Get secretario.
     *
     * @return string
     */
    public function getSecretario()
    {
        return $this->secretario;
    }
}
