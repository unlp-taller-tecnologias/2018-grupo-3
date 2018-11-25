<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioRepository")
 */
class Usuario extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=255)
     */
    private $apellido;

    // *
    //  * @var string
    //  *
    //  * @ORM\Column(name="email", type="string", length=255, unique=true)

    // private $email;

    /**
     * @var bool
     *
     * @ORM\Column(name="visado", type="boolean")
     */
    private $visado;

    // *
    //  * @var string
    //  *
    //  * @ORM\Column(name="contraseña", type="string", length=255)

    // private $contraseña;

    /**
     * @var int
     *
     * @ORM\Column(name="telefono_contacto", type="integer", nullable=true)
     */
    private $telefonoContacto;

    /**
     * @ORM\ManyToOne(targetEntity="Catedra", inversedBy="usuariosResponsables")
     * @ORM\JoinColumn(name="catedra_id", referencedColumnName="id")
     */
    private $catedra;

    /**
     * @ORM\OneToMany(targetEntity="Publicacion", mappedBy="usuarioPublicacion")
     */
    private $publicaciones;

    /**
     * @ORM\OneToMany(targetEntity="Noticia", mappedBy="usuarioNoticia")
     */
    private $noticias;

    /**
     * @ORM\ManyToOne(targetEntity="Rol", inversedBy="usuarios")
     * @ORM\JoinColumn(name="rol_id", referencedColumnName="id")
     */
    private $rol;


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
     * Set nombre.
     *
     * @param string $nombre
     *
     * @return Usuario
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
     * Set apellido.
     *
     * @param string $apellido
     *
     * @return Usuario
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido.
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set visado.
     *
     * @param bool $visado
     *
     * @return Usuario
     */
    public function setVisado($visado)
    {
        $this->visado = $visado;

        return $this;
    }

    /**
     * Get visado.
     *
     * @return bool
     */
    public function getVisado()
    {
        return $this->visado;
    }

    /**
     * Set telefonoContacto.
     *
     * @param int|null $telefonoContacto
     *
     * @return Usuario
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
     * Set catedra.
     *
     * @param \AppBundle\Entity\Catedra|null $catedra
     *
     * @return Usuario
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
     * Add publicacione.
     *
     * @param \AppBundle\Entity\Publicacion $publicacione
     *
     * @return Usuario
     */
    public function addPublicacione(\AppBundle\Entity\Publicacion $publicacione)
    {
        $this->publicaciones[] = $publicacione;

        return $this;
    }

    /**
     * Remove publicacione.
     *
     * @param \AppBundle\Entity\Publicacion $publicacione
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePublicacione(\AppBundle\Entity\Publicacion $publicacione)
    {
        return $this->publicaciones->removeElement($publicacione);
    }

    /**
     * Get publicaciones.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPublicaciones()
    {
        return $this->publicaciones;
    }

    /**
     * Add noticia.
     *
     * @param \AppBundle\Entity\Noticia $noticia
     *
     * @return Usuario
     */
    public function addNoticia(\AppBundle\Entity\Noticia $noticia)
    {
        $this->noticias[] = $noticia;

        return $this;
    }

    /**
     * Remove noticia.
     *
     * @param \AppBundle\Entity\Noticia $noticia
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeNoticia(\AppBundle\Entity\Noticia $noticia)
    {
        return $this->noticias->removeElement($noticia);
    }

    /**
     * Get noticias.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNoticias()
    {
        return $this->noticias;
    }

    /**
     * Set rol.
     *
     * @param \AppBundle\Entity\Rol|null $rol
     *
     * @return Usuario
     */
    public function setRol(\AppBundle\Entity\Rol $rol = null)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol.
     *
     * @return \AppBundle\Entity\Rol|null
     */
    public function getRol()
    {
        return $this->rol;
    }

    public function __toString() {
        return $this->nombre;
    }
}
