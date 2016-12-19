<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Superpower;
use AppBundle\Form\SuperpowerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperpowerController extends Controller
{
    /**
     * @Route("superpowers_list", name="show_superpowers")
     */
    public function showSuperpowersAction()
    {
        $superpowers = $this->get('doctrine')->getRepository(Superpower::class)->findBy(['deleted' => false]);

        return $this->render('homepage/show_superpowers.html.twig', [
            'superpowers' => $superpowers
        ]);
    }

    /**
     * @param Request $request
     * @param $superpower_id
     * @return Response
     * @Route("/superpower/{superpower_id}", name="manage_superpower")
     */
    public function editSuperpowerAction(Request $request, $superpower_id = null)
    {
        $repository = $this->get('doctrine')->getRepository(Superpower::class);
        if($superpower_id){
            $superpower = $repository->find($superpower_id);
            
        }
        else{
            $superpower = new Superpower();
        }
        $form = $this->createForm(SuperpowerType::class, $superpower);
        $form->handleRequest($request);

        $errors = $form->getErrors();
        if($form->isValid()){
            $repository->save($superpower);
            $this->addFlash('success', 'Superschopnosť bola uložená');
            return $this->redirectToRoute('show_superpowers');
        }

        return $this->render('homepage/manage_superpower.html.twig', [
            'form' => $form->createView(),
            'errors' => $errors
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/delete_superpower", name="delete_superpower")
     */
    public function deleteSuperpowerAction()
    {
        if($_POST['id']){
            $repository = $this->get('doctrine')->getRepository(Superpower::class);
            $superpower = $repository->find($_POST['id']);
            $superpower->setDeleted(true);
            $repository->save($superpower);
            $this->addFlash('success', 'Superschopnosť bola vymazaná');
        }
        else{
            $this->addFlash('failure', 'Superschopnosť sa nepodarilo vymazať');
        }

        return $this->redirectToRoute('show_superpowers');
    }
    
}
