<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Publicacion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use FOS\UserBundle\Util\UserManipulator;

/**
 * Publicacion controller.
 *
 * @Route("publicacion")
 */
class PublicacionController extends Controller
{
    /**
     * Lists all publicacion entities.
     *
     * @Route("/", name="publicacion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $publicaciones = $em->getRepository('AppBundle:Publicacion')->publicacionesActuales();

        return $this->render('publicacion/index.html.twig', array(
            'publicaciones' => $publicaciones,
        ));
    }

    /**
     * Creates a new publicacion entity.
     *
     * @Route("/new", name="publicacion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        // $publicacion = new Publicacion();
        // $form = $this->createForm('AppBundle\Form\PublicacionVisadoType', $publicacion);
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $em = $this->getDoctrine()->getManager();
        //     $publicaciones = $request->request->get('appbundle_publicacion')['aprobada'];
        //     if ($publicaciones){
        //         foreach ($publicaciones as $clave) {
        //             $publicacion = $em->getRepository('AppBundle:Publicacion')->find($clave);
        //             $publicacion->setAprobada(1);
        //             $em->persist($publicacion);
        //         }
        //     }
        //     $em->flush();     
        // }
        // return $this->render('publicacion/visar.html.twig', array(
        //     'visar_form' => $form->createView(),
        // ));


        $usuario = $this->getUser();
        $fechaActual = new \DateTime("now");
        $publicacion = new Publicacion();
        $publicacion->setUsuarioPublicacion($usuario);
        $publicacion->setCatedra($usuario->getCatedra());
        $publicacion->setFechaPublicacion($fechaActual);
        $form = $this->createForm('AppBundle\Form\PublicacionType', $publicacion);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
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
            $publicacion->setArchivo($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($publicacion);
            $em->flush();
        
            return $this->redirectToRoute('publicacion_show', array('id' => $publicacion->getId()));
        }
        
        return $this->render('publicacion/new.html.twig', array(
            'publicacion' => $publicacion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a publicacion entity.
     *
     * @Route("/{id}", name="publicacion_show")
     * @Method("GET")
     */
    public function showAction(Publicacion $publicacion)
    {
        $deleteForm = $this->createDeleteForm($publicacion);

        return $this->render('publicacion/show.html.twig', array(
            'publicacion' => $publicacion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing publicacion entity.
     *
     * @Route("/{id}/edit", name="publicacion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Publicacion $publicacion)
    {
        $deleteForm = $this->createDeleteForm($publicacion);
        $editForm = $this->createForm('AppBundle\Form\PublicacionType', $publicacion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('publicacion_edit', array('id' => $publicacion->getId()));
        }

        return $this->render('publicacion/edit.html.twig', array(
            'publicacion' => $publicacion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a publicacion entity.
     *
     * @Route("/{id}", name="publicacion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Publicacion $publicacion)
    {
        $form = $this->createDeleteForm($publicacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($publicacion);
            $em->flush();
        }

        return $this->redirectToRoute('publicacion_index');
    }

    /**
     * Creates a form to delete a publicacion entity.
     *
     * @param Publicacion $publicacion The publicacion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Publicacion $publicacion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('publicacion_delete', array('id' => $publicacion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

     /**
      * Lista todas las publicaciones que estan pendientes de visado.
      *
      * @Route("/visar", name="publicacion_visar")
      * @Method({"GET", "POST"})
      */
    public function visarAction(Request $request)
    {

        $publicacion = new Publicacion();
        $form = $this->createForm('AppBundle\Form\PublicacionVisadoType', $publicacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $publicaciones = $request->request->get('appbundle_publicacion')['aprobada'];
            if ($publicaciones){
                foreach ($publicaciones as $clave) {
                    $publicacion = $em->getRepository('AppBundle:Publicacion')->find($clave);
                    $publicacion->setAprobada(1);
                    $em->persist($publicacion);
                }
            }
            $em->flush();     
        }
        return $this->render('publicacion/visar.html.twig', array(
            'visar_form' => $form->createView(),
        ));
    }
}
