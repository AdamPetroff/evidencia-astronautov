<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Astronaut;
use AppBundle\Form\AstronautType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AstronautController extends Controller
{
    /**
     * @Route("/astronauts_list", name="show_astronauts")
     */
    public function showAstronautsAction()
    {
        $astronauts = $this->get('doctrine')->getRepository(Astronaut::class)->findBy(['deleted' => false]);
        return $this->render("homepage/show_astronauts.html.twig", [
            'astronauts' => $astronauts
        ]);
    }

    /**
     * @param $astronaut_id
     * @Route("/astronaut/{astronaut_id}", name="manage_astronaut")
     * @return Response
     */
    public function editAstronautAction(Request $request, $astronaut_id = null)
    {
        $repository = $this->get('doctrine')->getRepository(Astronaut::class);
        
        if($astronaut_id){
            $astronaut = $repository->find($astronaut_id);
        }
        else{
            $astronaut = new Astronaut();
        }
        $form = $this->createForm(AstronautType::class, $astronaut);
        $form->handleRequest($request);
        if($form->isValid()){
            $repository->save($astronaut);
            $this->addFlash('success', 'Astronaut bol uložený');
            return $this->redirectToRoute('show_astronauts');
        }

        return $this->render('homepage/manage_astronaut.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/delete_astronaut", name="delete_astronaut")
     */
    public function deleteAstronautAction()
    {
        if($_POST['id']){
            $repository = $this->get('doctrine')->getRepository(Astronaut::class);
            $astronaut = $repository->find($_POST['id']);
            $astronaut->setDeleted(true);
            $repository->save($astronaut);
            $this->addFlash('success', 'Astronaut bol vymazaný');
        }
        else{
            $this->addFlash('failure', 'Astronauta sa nepodarilo vymazať');
        }

        return $this->redirectToRoute('show_astronauts');
    }
}
