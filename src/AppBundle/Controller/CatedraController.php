<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Catedra;
use AppBundle\Entity\Etiqueta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;


/**
 * Catedra controller.
 *
 * @Route("catedra")
 */
class CatedraController extends Controller
{
    /**
     * Lists all catedra entities.
     *
     * @Route("/", name="catedra_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $catedras = $em->getRepository('AppBundle:Catedra')->findAll();

        return $this->render('catedra/index.html.twig', array(
            'catedras' => $catedras,
        ));
    }

    /**
     * Creates a new catedra entity.
     *
     * @Route("/new", name="catedra_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Security $security)
    {
        $userRol = $security->getUser()->getRoles()[0];

        if ( $userRol == 'ROLE_ADMIN' ) {
            $catedra = new Catedra();
            $form = $this->createForm('AppBundle\Form\CatedraType', $catedra);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($catedra);
                $em->flush();

                return $this->redirectToRoute('catedra_show', array('id' => $catedra->getId()));
            }

            return $this->render('catedra/new.html.twig', array(
                'catedra' => $catedra,
                'form' => $form->createView(),
            ));
        }else{
            return $this->render('catedra/error.html.twig');
        }
    }

    /**
     * Finds and displays a catedra entity.
     *
     * @Route("/{id}", name="catedra_show")
     * @Method("GET")
     */
    public function showAction(Catedra $catedra)
    {
        $deleteForm = $this->createDeleteForm($catedra);
        $publicaciones = [];

        foreach ( $catedra->getPublicacionesCatedra() as $publicacion ) {
            if ($publicacion->getAprobada() == 1) {
                $publicaciones[$publicacion->getId()] = $publicacion;
            }
        }

        $em =   $this->getDoctrine()->getManager();
        $etiquetas = $em->getRepository('AppBundle:Etiqueta')->findAll();

        return $this->render('catedra/show.html.twig', array(
            'catedra' => $catedra,
            'publicaciones' => $publicaciones,
            'etiquetas' => $etiquetas,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Finds and displays a catedra entity.
     *
     * @Route("/{id}/etiqueta/{etiqueta}", name="catedra_show_etiqueta")
     * @Method("GET")
     */
    public function showEtiquetaAction(Catedra $catedra, Etiqueta $etiqueta = null)
    {
        $deleteForm = $this->createDeleteForm($catedra);

        $em =   $this->getDoctrine()->getManager();

        if ($etiqueta == null) {
          $publicaciones = $catedra->getPublicacionesCatedra();
        } else {
          $publicaciones = $em->getRepository(
            'AppBundle:Publicacion')->findBy(array(
            'etiqueta' => $etiqueta->getId(),
            'catedra' => $catedra->getId(),
            'aprobada' => 1));
        }

        $etiquetas = $em->getRepository('AppBundle:Etiqueta')->findAll();

        return $this->render('catedra/show.html.twig', array(
            'catedra' => $catedra,
            'publicaciones' => $publicaciones,
            'etiquetas' => $etiquetas,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing catedra entity.
     *
     * @Route("/{id}/edit", name="catedra_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Catedra $catedra, Security $security)
    {

        $userRol = $security->getUser()->getRoles()[0];
        if ( $userRol == 'ROLE_ADMIN' ) {
            $deleteForm = $this->createDeleteForm($catedra);
            $editForm = $this->createForm('AppBundle\Form\CatedraType', $catedra);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('catedra_edit', array('id' => $catedra->getId()));
            }

            return $this->render('catedra/edit.html.twig', array(
                'catedra' => $catedra,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
        }else{
            return $this->render('catedra/error.html.twig');
        }
    }


    /**
     *
     * @Route("/{id}/mi_catedra", name="adm_catedra")
     * @Method({"GET", "POST"})
     */
    public function admCatedra( Catedra $catedra, Security $security){

            $user = $security->getUser();

            if (isset($user)) {
                $userRol = $user->getRoles()[0];
                $publicaciones = $catedra->getPublicacionesCatedra();
                $catedraUser = $user->getCatedra();

                if ( $userRol == 'ROLE_ADMIN' || $userRol == 'ROLE_MODERADOR' || ($catedraUser == $catedra) ) {
                    return $this->render('catedra/micatedra.html.twig', array(
                    'catedra' => $catedra,
                    'publicaciones' => $publicaciones,
                    ));
                }
            }
            return $this->render('catedra/error.html.twig');
    }


    /**
     * Deletes a catedra entity.
     *
     * @Route("/delete/{id}", name="catedra_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Catedra $catedra, Security $security)
    {
        $userRol = $security->getUser()->getRoles()[0];
        if ( $userRol == 'ROLE_ADMIN' ) {
            $form = $this->createDeleteForm($catedra);
            $form->handleRequest($request);

            if ( $catedra->getPublicacionesCatedra()->isEmpty() && $catedra->getUsuariosResponsables()->isEmpty()){
                $em = $this->getDoctrine()->getManager();
                $em->remove($catedra);
                $em->flush();
            }
            else{
                $this->addFlash( 'error', 'La catedra posee publicaciones y/o usuarios asociadxs');
            }

            return $this->redirectToRoute('catedra_index');
        }else{
            return $this->render('catedra/error.html.twig');
        }
    }

    /**
     * Creates a form to delete a catedra entity.
     *
     * @param Catedra $catedra The catedra entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Catedra $catedra)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('catedra_delete', array('id' => $catedra->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
