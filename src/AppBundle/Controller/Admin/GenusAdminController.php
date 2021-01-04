<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\Genus;
use AppBundle\Form\GenusFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Security ("is_granted('ROLE_ADMIN')")
 * @Route("/admin")
 */
class GenusAdminController extends Controller
{
    /**
	 * //@Security ("is_granted('ROLE_ADMIN')")
     * @Route("/genus", name="admin_genus_list")
     */
    public function indexAction()
    {
    	//provides the access control for given credential users
		// this message for us only as below or use annotations
		//$this->denyAccessUnlessGranted('ROLE_ADMIN'); // to apply to all controllers then use @top, annotations

        $genuses = $this->getDoctrine()
            ->getRepository('AppBundle:Genus')
            ->findAll();

        return $this->render('admin/genus/list.html.twig', array(
            'genuses' => $genuses
        ));
    }

    /**
     * @Route("/genus/new", name="admin_genus_new")
     */
    public function newAction(Request $request)
    {
        // let's go to work!
        $form = $this->createForm( GenusFormType::class);

        // handles the data only POST
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //dump($form->getData());die;
            $genus = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($genus);
            $em->flush();

            $this->addFlash('Success', 'A New Genus is Created!');

            return $this->redirectToRoute('admin_genus_list');
        }

        return $this->render(':admin/genus:new.html.twig', [
            'genusForm' => $form->createView()
        ]);
    }


    /**
     * @Route("/genus/{id}/edit", name="admin_genus_edit")
     */
    public function editAction(Request $request, Genus $genus)
    {
        // let's go to work!
        $form = $this->createForm(GenusFormType::class, $genus);

        // handles the data only POST
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //dump($form->getData());die;
            $genus = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($genus);
            $em->flush();

            $this->addFlash('Success', 'Genus is Edited Successfully!');

            return $this->redirectToRoute('admin_genus_list');
        }

        return $this->render(':admin/genus:edit.html.twig', [
            'genusForm' => $form->createView()
        ]);
    }
}