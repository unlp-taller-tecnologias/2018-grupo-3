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
     * Set nombre
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
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellido
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
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    // /**
    //  * Set email
    //  *
    //  * @param string $email
    //  *
    //  * @return Usuario
    //  */
    // public function setEmail($email)
    // {
    //     $this->email = $email;

    //     return $this;
    // }

    // /**
    //  * Get email
    //  *
    //  * @return string
    //  */
    // public function getEmail()
    // {
    //     return $this->email;
    // }

    /**
     * Set visado
     *
     * @param boolean $visado
     *
     * @return Usuario
     */
    public function setVisado($visado)
    {
        $this->visado = $visado;

        return $this;
    }

    /**
     * Get visado
     *
     * @return bool
     */
    public function getVisado()
    {
        return $this->visado;
    }

    // /**
    //  * Set contraseña
    //  *
    //  * @param string $contraseña
    //  *
    //  * @return Usuario
    //  */
    // public function setContraseña($contraseña)
    // {
    //     $this->contraseña = $contraseña;

    //     return $this;
    // }

    // /**
    //  * Get contraseña
    //  *
    //  * @return string
    //  */
    // public function getContraseña()
    // {
    //     return $this->contraseña;
    // }

    /**
     * Set telefonoContacto
     *
     * @param integer $telefonoContacto
     *
     * @return Usuario
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
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->catedras = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add catedra
     *
     * @param \AppBundle\Entity\Catedra $catedra
     *
     * @return Usuario
     */
    public function addCatedra(\AppBundle\Entity\Catedra $catedra)
    {
        $this->catedras[] = $catedra;

        return $this;
    }

    /**
     * Remove catedra
     *
     * @param \AppBundle\Entity\Catedra $catedra
     */
    public function removeCatedra(\AppBundle\Entity\Catedra $catedra)
    {
        $this->catedras->removeElement($catedra);
    }

    /**
     * Get catedras
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCatedras()
    {
        return $this->catedras;
    }

    /**
     * Add publicaciones
     *
     * @param \AppBundle\Entity\Publicacion $publicaciones
     *
     * @return Usuario
     */
    public function addpublicaciones(\AppBundle\Entity\Publicacion $publicaciones)
    {
        $this->publicaciones[] = $publicaciones;

        return $this;
    }

    /**
     * Remove publicaciones
     *
     * @param \AppBundle\Entity\Publicacion $publicaciones
     */
    public function removePublicaciones(\AppBundle\Entity\Publicacion $publicaciones)
    {
        $this->publicaciones->removeElement($publicaciones);
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

    /**
     * Add noticia
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
     * Remove noticia
     *
     * @param \AppBundle\Entity\Noticia $noticia
     */
    public function removeNoticia(\AppBundle\Entity\Noticia $noticia)
    {
        $this->noticias->removeElement($noticia);
    }

    /**
     * Get noticias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNoticias()
    {
        return $this->noticias;
    }

    /**
     * Set rol
     *
     * @param \AppBundle\Entity\Rol $rol
     *
     * @return Usuario
     */
    public function setRol(\AppBundle\Entity\Rol $rol = null)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return \AppBundle\Entity\Rol
     */
    public function getRol()
    {
        return $this->rol;
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
}
