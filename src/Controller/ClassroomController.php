<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use App\Repository\ClassroomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    /**
     * @Route("/classroom", name="classroom")
     */
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }

    /**
     * @Route("/classroom/list", name="classroom_list")
     */
    public function listAllClassrooms(ClassroomRepository $rep) : Response
    {
        $classes = $rep->findAll();
        return $this->render('classroom/list.html.twig', array(
            'classes' => $classes
        ));
    }

    /**
     * @Route("/classroom/create", name="classroom_create")
     */
    public function createClassroom(Request $req) : Response
    {
        $classroom = new Classroom();
        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($req);

        if($form->isSubmitted() and $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($classroom);
            $em->flush();
        }

        return $this->render('classroom/create.html.twig', array(
            'form_create' => $form->createView()
        ));
    }


    /**
     * @Route("/classroom/update/{id}", name="classroom_update")
     */
    public function updateClassroom(Request $req, $id) : Response
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Classroom::class);

        $classroom = $repository->find($id);

        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($req);

        if($form->isSubmitted() and $form->isValid()){
            $em->flush();
        }
        $isUpdate = true;
        return $this->render('classroom/create.html.twig', array(
            'isUpdate' => $isUpdate,
            'form_create' => $form->createView()
        ));
    }

    /**
     * @Route("/classroom/delete/{id}", name="classroom_delete")
     */
    public function deleteClassroom($id) : Response
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository(Classroom::class);
        $classroom = $repository->find($id);
        $em->remove($classroom);
        $em->flush();
        return $this->redirect('/classroom/list');
    }
}
