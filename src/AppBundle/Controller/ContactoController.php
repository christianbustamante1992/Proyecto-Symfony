<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contacto;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Contacto controller.
 *
 * @Route("contacto")
 */
class ContactoController extends Controller
{
    /**
     * Lists all contacto entities.
     *
     * @Route("/", name="contacto_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contactos = $em->getRepository('AppBundle:Contacto')->findAll();

        return $this->render('contacto/index.html.twig', array(
            'contactos' => $contactos,
        ));
    }

    /**
     * Creates a new contacto entity.
     *
     * @Route("/new", name="contacto_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $contacto = new Contacto();
        $form = $this->createForm('AppBundle\Form\ContactoType', $contacto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contacto);
            $em->flush();

            return $this->redirectToRoute('contacto_show', array('id' => $contacto->getId()));
        }

        return $this->render('contacto/new.html.twig', array(
            'contacto' => $contacto,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a contacto entity.
     *
     * @Route("/{id}", name="contacto_show")
     * @Method("GET")
     */
    public function showAction(Contacto $contacto)
    {
        $deleteForm = $this->createDeleteForm($contacto);

        return $this->render('contacto/show.html.twig', array(
            'contacto' => $contacto,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing contacto entity.
     *
     * @Route("/{id}/edit", name="contacto_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Contacto $contacto)
    {
        $deleteForm = $this->createDeleteForm($contacto);
        $editForm = $this->createForm('AppBundle\Form\ContactoType', $contacto);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contacto_edit', array('id' => $contacto->getId()));
        }

        return $this->render('contacto/edit.html.twig', array(
            'contacto' => $contacto,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a contacto entity.
     *
     * @Route("/{id}", name="contacto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Contacto $contacto)
    {
        $form = $this->createDeleteForm($contacto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contacto);
            $em->flush();
        }

        return $this->redirectToRoute('contacto_index');
    }

    /**
     * Creates a form to delete a contacto entity.
     *
     * @param Contacto $contacto The contacto entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Contacto $contacto)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contacto_delete', array('id' => $contacto->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
