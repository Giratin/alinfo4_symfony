<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClubController extends AbstractController
{
    /**
     * @Route("/club", name="app_club")
     */
    public function index(): Response
    {
        return $this->render('club/index.html.twig', [
            'controller_name' => 'ClubController',
        ]);
    }

    /**
     * @Route("/club/get/{nom}", name="app_club_name")
     */
    public function getName($nom): Response
    {
        return $this->render('club/detail.html.twig', [
            'name' => $nom,
        ]);
    }

    /**
     * @Route("/club/list", name="app_club_list")
     */
    public function listAll(): Response
    {
        $formations = array(
            array('ref' => 'form147', 'Titre' => 'Formation Symfony 4','Description'=>'formation pratique',
                'date_debut'=>'06/12/2020', 'date_fin'=>'06/19/2020', 'nb_participants'=>19) ,
            array('ref'=>'form177','Titre'=>'Formation SOA' ,
                'Description'=>'formation theorique','date_debut'=>'12/03/2020','date_fin'=>'12/10/2020',
                'nb_participants'=>0),
            array('ref'=>'form178','Titre'=>'Formation Angular' ,
                'Description'=>'formation theorique','date_debut'=>'06/10/2020','date_fin'=>'06/14/2020',
                'nb_participants'=>12));

        return $this->render('club/list.html.twig', [
            'formations' => $formations,
            'nom' => 'TEST'
        ]);
    }
}
