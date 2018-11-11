<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Catedra;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

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
    public function newAction(Request $request)
    {
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

        return $this->render('catedra/show.html.twig', array(
            'catedra' => $catedra,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing catedra entity.
     *
     * @Route("/{id}/edit", name="catedra_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Catedra $catedra)
    {
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
    }

    /**
     * Deletes a catedra entity.
     *
     * @Route("/{id}", name="catedra_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Catedra $catedra)
    {
        $form = $this->createDeleteForm($catedra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($catedra);
            $em->flush();
        }

        return $this->redirectToRoute('catedra_index');
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
