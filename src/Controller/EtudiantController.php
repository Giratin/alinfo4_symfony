<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\Query\Exec\SingleTableDeleteUpdateExecutor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    /**
     * @Route("/etudiant", name="etudiant")
     */
    public function index(): Response
    {
        return $this->render('etudiant/index.html.twig', [
            'controller_name' => 'EtudiantController',
        ]);
    }


    /**
     * @Route("/etudiant/list", name="lis_etudiant")
     */
    public function listStudents(EtudiantRepository $repository): Response
    {
        $students = $repository->findAll();
        return $this->render('etudiant/index.html.twig', array(
            'students' =>  $students
        ));
    }

    /**
     * @Route("/etudiant/create", name="create_etudiant")
     */
    public function createEtudiant(EtudiantRepository $repository, Request $request): Response
    {
        $etudiant = new Etudiant();
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if($form->isSubmitted() and $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($etudiant);
            $em->flush();
        }
        return $this->render('etudiant/create.html.twig', [
            'create_form' => $form->createView()
        ]);

    }
}
