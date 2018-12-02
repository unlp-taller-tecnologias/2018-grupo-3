<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publicacion
 *
 * @ORM\Table(name="publicacion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicacionRepository")
 */
class Publicacion
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
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="bajada", type="string", length=255)
     */
    private $bajada;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_autor", type="string", length=255)
     */
    private $nombreAutor;

    /**
     * @var \Date
     *
     * @ORM\Column(name="fecha_publicacion", type="date")
     */
    private $fechaPublicacion;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="string", length=255)
     */
    private $contenido;

    /**
     * @var \Date
     *
     * @ORM\Column(name="fecha_caducidad", type="date", nullable=true)
     */
    private $fechaCaducidad;

    /**
     * @var string
     *
     * @ORM\Column(name="firmante", type="string", length=255, nullable=true)
     */
    private $firmante;

    /**
     * @var string
     *
     * @ORM\Column(name="archivo", type="string", length=255, nullable=true)
     */
    private $archivo;

    /**
     * @var string
     *
     * @ORM\Column(name="links", type="string", length=255, nullable=true)
     */
    private $links;

    /**
     * @ORM\ManyToOne(targetEntity="Etiqueta", inversedBy="publicaciones")
     * @ORM\JoinColumn(name="etiqueta_id", referencedColumnName="id")
     */
    private $etiqueta;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="publicaciones")
     * @ORM\JoinColumn(name="usuario_publicacion", referencedColumnName="id")
     */
    private $usuarioPublicacion;

    /**
     * @ORM\ManyToOne(targetEntity="Catedra", inversedBy="publicacionesCatedra")
     * @ORM\JoinColumn(name="catedra", referencedColumnName="id")
     */
    private $catedra;

    /**
     * @ORM\OneToMany(targetEntity="Modificacion", mappedBy="publicacionModificada")
     */
    private $modificaciones;

    /**
     * @var bool
     *
     * @ORM\Column(name="visada", type="boolean", nullable=true)
     */
    private $visada;

    /**
     * @var bool
     *
     * @ORM\Column(name="aprobada", type="boolean", nullable=true)
     */
    private $aprobada;


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
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Publicacion
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set bajada
     *
     * @param string $bajada
     *
     * @return Publicacion
     */
    public function setBajada($bajada)
    {
        $this->bajada = $bajada;

        return $this;
    }

    /**
     * Get bajada
     *
     * @return string
     */
    public function getBajada()
    {
        return $this->bajada;
    }

    /**
     * Set nombreAutor
     *
     * @param string $nombreAutor
     *
     * @return Publicacion
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
     * Set fechaPublicacion
     *
     * @param \DateTime $fechaPublicacion
     *
     * @return Publicacion
     */
    public function setFechaPublicacion($fechaPublicacion)
    {
        $this->fechaPublicacion = $fechaPublicacion;

        return $this;
    }

    /**
     * Get fechaPublicacion
     *
     * @return \DateTime
     */
    public function getFechaPublicacion()
    {
        return $this->fechaPublicacion;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     *
     * @return Publicacion
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return string
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Set fechaCaducidad
     *
     * @param \DateTime $fechaCaducidad
     *
     * @return Publicacion
     */
    public function setFechaCaducidad($fechaCaducidad)
    {
        $this->fechaCaducidad = $fechaCaducidad;

        return $this;
    }

    /**
     * Get fechaCaducidad
     *
     * @return \DateTime
     */
    public function getFechaCaducidad()
    {
        return $this->fechaCaducidad;
    }

    /**
     * Set firmante
     *
     * @param string $firmante
     *
     * @return Publicacion
     */
    public function setFirmante($firmante)
    {
        $this->firmante = $firmante;

        return $this;
    }

    /**
     * Get firmante
     *
     * @return string
     */
    public function getFirmante()
    {
        return $this->firmante;
    }

    /**
     * Set archivo
     *
     * @param string $archivo
     *
     * @return Publicacion
     */
    public function setArchivo($archivo)
    {
        $this->archivo = $archivo;

        return $this;
    }

    /**
     * Get archivo
     *
     * @return string
     */
    public function getArchivo()
    {
        return $this->archivo;
    }

    /**
     * Set links
     *
     * @param string $links
     *
     * @return Publicacion
     */
    public function setLinks($links)
    {
        $this->links = $links;

        return $this;
    }

    /**
     * Get links
     *
     * @return string
     */
    public function getLinks()
    {
        return $this->links;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->modificaciones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set etiqueta
     *
     * @param \AppBundle\Entity\Etiqueta $etiqueta
     *
     * @return Publicacion
     */
    public function setEtiqueta(\AppBundle\Entity\Etiqueta $etiqueta = null)
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    /**
     * Get etiqueta
     *
     * @return \AppBundle\Entity\Etiqueta
     */
    public function getEtiqueta()
    {
        return $this->etiqueta;
    }

    /**
     * Set usuarioPublicacion
     *
     * @param \AppBundle\Entity\Usuario $usuarioPublicacion
     *
     * @return Publicacion
     */
    public function setUsuarioPublicacion(\AppBundle\Entity\Usuario $usuarioPublicacion = null)
    {
        $this->usuarioPublicacion = $usuarioPublicacion;

        return $this;
    }

    /**
     * Get usuarioPublicacion
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuarioPublicacion()
    {
        return $this->usuarioPublicacion;
    }

    /**
     * Add modificacione
     *
     * @param \AppBundle\Entity\Modificacion $modificacione
     *
     * @return Publicacion
     */
    public function addModificacione(\AppBundle\Entity\Modificacion $modificacione)
    {
        $this->modificaciones[] = $modificacione;

        return $this;
    }

    /**
     * Remove modificacione
     *
     * @param \AppBundle\Entity\Modificacion $modificacione
     */
    public function removeModificacione(\AppBundle\Entity\Modificacion $modificacione)
    {
        $this->modificaciones->removeElement($modificacione);
    }

    /**
     * Get modificaciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModificaciones()
    {
        return $this->modificaciones;
    }

    /**
     * Set catedra.
     *
     * @param \AppBundle\Entity\Catedra|null $catedra
     *
     * @return Publicacion
     */
    public function setCatedra(\AppBundle\Entity\Catedra $catedra = null)
    {
        $this->catedra = $catedra;

        return $this;
    }

    /**
     * Get catedra.
     *
     * @return \AppBundle\Entity\Catedra|null
     */
    public function getCatedra()
    {
        return $this->catedra;
    }

    /**
     * Set visada.
     *
     * @param bool $visada
     *
     * @return Publicacion
     */
    public function setVisada($visada)
    {
        $this->visada = $visada;

        return $this;
    }

    /**
     * Get visada.
     *
     * @return bool
     */
    public function getVisada()
    {
        return $this->visada;
    }

    /**
     * Set aprobada.
     *
     * @param bool $aprobada
     *
     * @return Publicacion
     */
    public function setAprobada($aprobada)
    {
        $this->aprobada = $aprobada;

        return $this;
    }

    /**
     * Get aprobada.
     *
     * @return bool
     */
    public function getAprobada()
    {
        return $this->aprobada;
    }
}
