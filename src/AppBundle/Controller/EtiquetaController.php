<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Etiqueta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * etiqueta controller.
 *
 * @Route("etiqueta")
 */
class EtiquetaController extends Controller
{
    /**
     * Lists all etiquetum entities.
     *
     * @Route("/", name="etiqueta_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $etiquetas = $em->getRepository('AppBundle:Etiqueta')->findAll();

        return $this->render('etiqueta/index.html.twig', array(
            'etiquetas' => $etiquetas,
        ));
    }

    /**
     * Creates a new etiqueta entity.
     *
     * @Route("/new", name="etiqueta_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $etiqueta = new Etiqueta();
        $form = $this->createForm('AppBundle\Form\EtiquetaType', $etiqueta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($etiqueta);
            $em->flush();

            return $this->redirectToRoute('etiqueta_show', array('id' => $etiqueta->getId()));
        }

        return $this->render('etiqueta/new.html.twig', array(
            'etiqueta' => $etiqueta,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a etiqueta entity.
     *
     * @Route("/{id}", name="etiqueta_show")
     * @Method("GET")
     */
    public function showAction(Etiqueta $etiqueta)
    {
        $deleteForm = $this->createDeleteForm($etiqueta);

        return $this->render('etiqueta/show.html.twig', array(
            'etiqueta' => $etiqueta,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing etiqueta entity.
     *
     * @Route("/{id}/edit", name="etiqueta_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Etiqueta $etiqueta)
    {
        $deleteForm = $this->createDeleteForm($etiqueta);
        $editForm = $this->createForm('AppBundle\Form\EtiquetaType', $etiqueta);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etiqueta_edit', array('id' => $etiquetum->getId()));
        }

        return $this->render('etiqueta/edit.html.twig', array(
            'etiqueta' => $etiqueta,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a etiqueta entity.
     *
     * @Route("/{id}", name="etiqueta_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Etiqueta $etiqueta)
    {
        $form = $this->createDeleteForm($etiqueta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($etiqueta);
            $em->flush();
        }

        return $this->redirectToRoute('etiqueta_index');
    }

    /**
     * Creates a form to delete a etiqueta entity.
     *
     * @param Etiqueta $etiqueta The etiqueta entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Etiqueta $etiqueta)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('etiqueta_delete', array('id' => $etiqueta->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
