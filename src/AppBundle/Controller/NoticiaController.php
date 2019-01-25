<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Noticia;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Util\UserManipulator;

/**
 * noticia controller.
 *
 * @Route("noticia")
 */
class NoticiaController extends Controller
{
    /**
     * Lists all noticia entities.
     *
     * @Route("/", name="noticia_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $noticias = $em->getRepository('AppBundle:Noticia')->noticiasActuales();

        return $this->render('noticia/index.html.twig', array(
            'noticias' => $noticias,
        ));
    }

    /**
     * Creates a new noticia entity.
     *
     * @Route("/new", name="noticia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $usuario = $this->getUser();
        $noticia = new Noticia();
        $noticia->setUsuarioNoticia($usuario);
        $fechaActual = new \DateTime("now");
        $noticia->setFechaPublicacion($fechaActual);
        $form = $this->createForm('AppBundle\Form\NoticiaType', $noticia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ( !empty($form['archivo']->getData()) ) {

              $file = $form['archivo']->getData();
              $file->getPath();
              $fileName = date("d-m-Y").md5(uniqid()).'.'.$file->guessExtension();

               try {
                  $file->move(
                      $this->getParameter('files_directory'),
                      $fileName
                  );
                } catch (FileException $e) {
                  $fileName = date("d-m-Y").md5(uniqid()).'.'.$file->guessExtension();
                  try {
                      $file->move(
                          $this->getParameter('files_directory'),
                          $fileName
                      );
                  } catch (FileException $e) {
                      $fileName = date("d-m-Y").md5(uniqid()).'.'.$file->guessExtension();
                      $file->move(
                          $this->getParameter('files_directory'),
                          $fileName
                      );
                  }
              }
              $noticia->setArchivo($fileName);
            }else{
              $noticia->setArchivo(NULL);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($noticia);
            $em->flush();
            $this->addFlash( 'exito', 'La noticia se agregó exitosamente');

            return $this->redirectToRoute('noticia_show', array('id' => $noticia->getId()));
        }

        return $this->render('noticia/new.html.twig', array(
            'noticia' => $noticia,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a noticia entity.
     *
     * @Route("/{id}", name="noticia_show")
     * @Method("GET")
     */
    public function showAction(Noticia $noticia)
    {
        $deleteForm = $this->createDeleteForm($noticia);

        return $this->render('noticia/show.html.twig', array(
            'noticia' => $noticia,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing noticia entity.
     *
     * @Route("/{id}/edit", name="noticia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Noticia $noticia)
    {
        $archivo_anterior = $noticia->getArchivo();
        $deleteForm = $this->createDeleteForm($noticia);
        $editForm = $this->createForm('AppBundle\Form\NoticiaType', $noticia);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if ( !empty($editForm['archivo']->getData()) ) {

              $file = $editForm['archivo']->getData();
              $file->getPath();
              $fileName = date("d-m-Y").md5(uniqid()).'.'.$file->guessExtension();

               try {
                  $file->move(
                      $this->getParameter('files_directory'),
                      $fileName
                  );
                } catch (FileException $e) {
                  $fileName = date("d-m-Y").md5(uniqid()).'.'.$file->guessExtension();
                  try {
                      $file->move(
                          $this->getParameter('files_directory'),
                          $fileName
                      );
                  } catch (FileException $e) {
                      $fileName = date("d-m-Y").md5(uniqid()).'.'.$file->guessExtension();
                      $file->move(
                          $this->getParameter('files_directory'),
                          $fileName
                      );
                  }
              }
              $noticia->setArchivo($fileName);
            }else{
              if (!empty($archivo_anterior)) {
                  $noticia->setArchivo($archivo_anterior);
              }
            }

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash( 'exito', 'La noticia se editó exitosamente');

            return $this->redirectToRoute('noticia_show', array('id' => $noticia->getId()));
        }

        return $this->render('noticia/edit.html.twig', array(
            'noticia' => $noticia,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a noticia entity.
     *
     * @Route("/delete/{id}", name="noticia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Noticia $noticia)
    {
        $form = $this->createDeleteForm($noticia);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $em->remove($noticia);
        $em->flush();
        $this->addFlash( 'exito', 'La noticia se eliminó exitósamente');
        return $this->redirectToRoute('noticia_index');
    }

    /**
     * Creates a form to delete a noticia entity.
     *
     * @param Noticia $noticia The noticia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Noticia $noticia)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('noticia_delete', array('id' => $noticia->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
