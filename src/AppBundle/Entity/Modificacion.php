<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modificacion
 *
 * @ORM\Table(name="modificacion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ModificacionRepository")
 */
class Modificacion
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
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora", type="datetime")
     */
    private $hora;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_autor", type="string", length=255)
     */
    private $nombreAutor;

    /**
     * @ORM\ManyToOne(targetEntity="Publicacion", inversedBy="modificaciones")
     * @ORM\JoinColumn(name="publicacion_modificada", referencedColumnName="id")
     */
    private $publicacionModificada;


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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Modificacion
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set hora
     *
     * @param \DateTime $hora
     *
     * @return Modificacion
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get hora
     *
     * @return \DateTime
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set nombreAutor
     *
     * @param string $nombreAutor
     *
     * @return Modificacion
     */
    public function setNombreAutor($nombreAutor)
    {
        $this->nombreAutor = $nombreAutor;

        return $this;
    }

    /**
     * Get nombreAutor
     *
     * @return string
     */
    public function getNombreAutor()
    {
        return $this->nombreAutor;
    }

    /**
     * Set publicacionModificada
     *
     * @param \AppBundle\Entity\Publicacion $publicacionModificada
     *
     * @return Modificacion
     */
    public function setPublicacionModificada(\AppBundle\Entity\Publicacion $publicacionModificada = null)
    {
        $this->publicacionModificada = $publicacionModificada;

        return $this;
    }

    /**
     * Get publicacionModificada
     *
     * @return \AppBundle\Entity\Publicacion
     */
    public function getPublicacionModificada()
    {
        return $this->publicacionModificada;
    }
}
