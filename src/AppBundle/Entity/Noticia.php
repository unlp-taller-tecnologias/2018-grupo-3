<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Noticia
 *
 * @ORM\Table(name="noticia")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NoticiaRepository")
 */
class Noticia
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_publicacion", type="datetime")
     */
    private $fechaPublicacion;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="string", length=255)
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="firmante", type="string", length=255)
     */
    private $firmante;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="noticias")
     * @ORM\JoinColumn(name="usuario_noticia", referencedColumnName="id")
     */
    private $usuarioNoticia;


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
     * @return Noticia
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
     * @return Noticia
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
     * Set fechaPublicacion
     *
     * @param \DateTime $fechaPublicacion
     *
     * @return Noticia
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
     * @return Noticia
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
     * Set firmante
     *
     * @param string $firmante
     *
     * @return Noticia
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
     * Set usuarioNoticia
     *
     * @param \AppBundle\Entity\Usuario $usuarioNoticia
     *
     * @return Noticia
     */
    public function setUsuarioNoticia(\AppBundle\Entity\Usuario $usuarioNoticia = null)
    {
        $this->usuarioNoticia = $usuarioNoticia;

        return $this;
    }

    /**
     * Get usuarioNoticia
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuarioNoticia()
    {
        return $this->usuarioNoticia;
    }
}
