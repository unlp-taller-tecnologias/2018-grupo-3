<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etiqueta
 *
 * @ORM\Table(name="etiqueta")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EtiquetaRepository")
 */
class Etiqueta
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
     * @ORM\OneToMany(targetEntity="Publicacion", mappedBy="etiqueta")
     */
    private $publicaciones;


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
     * @return Etiqueta
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
     * Constructor
     */
    public function __construct()
    {
        $this->publicaciones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add publicacione
     *
     * @param \AppBundle\Entity\Publicacion $publicacione
     *
     * @return Etiqueta
     */
    public function addPublicacione(\AppBundle\Entity\Publicacion $publicacione)
    {
        $this->publicaciones[] = $publicacione;

        return $this;
    }

    /**
     * Remove publicacione
     *
     * @param \AppBundle\Entity\Publicacion $publicacione
     */
    public function removePublicacione(\AppBundle\Entity\Publicacion $publicacione)
    {
        $this->publicaciones->removeElement($publicacione);
    }

    /**
     * Get publicaciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPublicaciones()
    {
        return $this->publicaciones;
    }
}
