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
     * @var \Date
     *
     * @ORM\Column(name="fecha_caducidad", type="date", nullable=true)
     */
    private $fechaCaducidad;

    /**
     * @var string
     *
     * @ORM\Column(name="link1", type="string", length=255, nullable=true)
     */
    private $link1;

    /**
     * @var string
     *
     * @ORM\Column(name="link2", type="string", length=255, nullable=true)
     */
    private $link2;

    /**
     * @var string
     *
     * @ORM\Column(name="link3", type="string", length=255, nullable=true)
     */
    private $link3;

    /**
     * @var string
     *
     * @ORM\Column(name="link4", type="string", length=255, nullable=true)
     */
    private $link4;

    /**
     * @var string
     *
     * @ORM\Column(name="link5", type="string", length=255, nullable=true)
     */
    private $link5;


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

    /**
     * Set fechaCaducidad.
     *
     * @param \DateTime|null $fechaCaducidad
     *
     * @return Noticia
     */
    public function setFechaCaducidad($fechaCaducidad = null)
    {
        $this->fechaCaducidad = $fechaCaducidad;

        return $this;
    }

    /**
     * Get fechaCaducidad.
     *
     * @return \DateTime|null
     */
    public function getFechaCaducidad()
    {
        return $this->fechaCaducidad;
    }

    /**
     * Set link1.
     *
     * @param string|null $link1
     *
     * @return Noticia
     */
    public function setLink1($link1 = null)
    {
        $this->link1 = $link1;

        return $this;
    }

    /**
     * Get link1.
     *
     * @return string|null
     */
    public function getLink1()
    {
        return $this->link1;
    }

    /**
     * Set link2.
     *
     * @param string|null $link2
     *
     * @return Noticia
     */
    public function setLink2($link2 = null)
    {
        $this->link2 = $link2;

        return $this;
    }

    /**
     * Get link2.
     *
     * @return string|null
     */
    public function getLink2()
    {
        return $this->link2;
    }

    /**
     * Set link3.
     *
     * @param string|null $link3
     *
     * @return Noticia
     */
    public function setLink3($link3 = null)
    {
        $this->link3 = $link3;

        return $this;
    }

    /**
     * Get link3.
     *
     * @return string|null
     */
    public function getLink3()
    {
        return $this->link3;
    }

    /**
     * Set link4.
     *
     * @param string|null $link4
     *
     * @return Noticia
     */
    public function setLink4($link4 = null)
    {
        $this->link4 = $link4;

        return $this;
    }

    /**
     * Get link4.
     *
     * @return string|null
     */
    public function getLink4()
    {
        return $this->link4;
    }

    /**
     * Set link5.
     *
     * @param string|null $link5
     *
     * @return Noticia
     */
    public function setLink5($link5 = null)
    {
        $this->link5 = $link5;

        return $this;
    }

    /**
     * Get link5.
     *
     * @return string|null
     */
    public function getLink5()
    {
        return $this->link5;
    }
}
