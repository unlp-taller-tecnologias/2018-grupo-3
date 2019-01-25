<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Model\UserManagerInterface;

/**
 * Usuario controller.
 *
 * @Route("usuario")
 */
class UsuarioController extends Controller
{

    private $userManager;
    /**
     * Lists all usuario entities.
     *
     * @Route("/", name="usuario_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $usuarios = $em->getRepository('AppBundle:Usuario')->findAll();

        return $this->render('usuario/index.html.twig', array(
            'usuarios' => $usuarios,
        ));
    }

    /**
     * Creates a new usuario entity.
     *
     * @Route("/new", name="usuario_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request,  UserManagerInterface $userManager)
    {

        $this->userManager = $userManager;
        $usuario = $this->userManager->createUser();

        $usuario->setEnabled(true);


        $form = $this->createForm('AppBundle\Form\UsuarioType', $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData()->getRol()->getNombre();
            switch ($data) {
                case 'responsable':
                    $usuario->addRole('ROLE_CATEDRA');
                    break;

                case 'administrador':
                    $usuario->addRole('ROLE_ADMIN');
                    break;

                case 'moderador':
                    $usuario->addRole('ROLE_MODERADOR');
                    break;
            }

            $this->userManager->updateUser($usuario);
            $this->addFlash( 'exito', 'El usuario se agregó exitosamente');
            return $this->redirectToRoute('usuario_show', array('id' => $usuario->getId()));
        }

        return $this->render('usuario/new.html.twig', array(
            'usuario' => $usuario,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a usuario entity.
     *
     * @Route("/{id}", name="usuario_show")
     * @Method("GET")
     */
    public function showAction(Usuario $usuario)
    {
        $deleteForm = $this->createDeleteForm($usuario);

        return $this->render('usuario/show.html.twig', array(
            'usuario' => $usuario,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    private function editRole($usuario, $data) {
        switch ($usuario->getRol()->getNombre()) {
            case 'responsable':
                $usuario->removeRole('ROLE_ADMIN');
                $usuario->removeRole('ROLE_MODERADOR');
                break;

            case 'administrador':
                $usuario->removeRole('ROLE_CATEDRA');
                $usuario->removeRole('ROLE_MODERADOR');
                break;

            case 'moderador':
                $usuario->removeRole('ROLE_ADMIN');
                $usuario->removeRole('ROLE_CATEDRA');
                break;
        }

        switch ($data) {
            case 'responsable':
                $usuario->addRole('ROLE_CATEDRA');
                break;

            case 'administrador':
                $usuario->addRole('ROLE_ADMIN');
                break;

            case 'moderador':
                $usuario->addRole('ROLE_MODERADOR');
                break;
        }

        return $usuario;
    }

    /**
     * Displays a form to edit an existing usuario entity.
     *
     * @Route("/{id}/edit", name="usuario_edit")
     * @Method({"GET", "POST"})
     * 
     */
    public function editAction(Request $request, Usuario $usuario, UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
        $deleteForm = $this->createDeleteForm($usuario);
        $editForm = $this->createForm('AppBundle\Form\UsuarioUpdateType', $usuario);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $data = $editForm->getData()->getRol()->getNombre();
            $usuario = $this->editRole($usuario, $data);

            $this->userManager->updateUser($usuario);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash( 'exito', 'El usuario se ha editado exitosamente.');

            return $this->redirectToRoute('usuario_index');
        }

        return $this->render('usuario/edit.html.twig', array(
            'usuario' => $usuario,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a usuario entity.
     *
     * @Route("/delete/{id}", name="usuario_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Usuario $usuario)
    {
        $form = $this->createDeleteForm($usuario);
        $form->handleRequest($request);

        if ( $usuario->getPublicaciones()->isEmpty() && $usuario->getNoticias()->isEmpty() ){
            $em = $this->getDoctrine()->getManager();
            $em->remove($usuario);
            $em->flush();
            $this->addFlash( 'exito', 'El usuario se ha eliminado exitosamente.');
        }
        else{
            $this->addFlash( 'error', 'Error: El usuario posee publicaciones y/o noticias, no se puede eliminar');
        }

        return $this->redirectToRoute('usuario_index');
    }

    /**
     * Creates a form to delete a usuario entity.
     *
     * @param Usuario $usuario The usuario entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Usuario $usuario)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('usuario_delete', array('id' => $usuario->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
