<?php

namespace App\Controller;//le terme app veut dire src
// le namespace c'est le dossier

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
     /*
        En créant un controller, est généré également un dossier template du même nom



        Une route est "page web" : exemple : inscription.php, contact.php
        en local : localhost:8000
        en ligne : www.nomDeDomaine.fr

        Un controller peut contenir plusieurs routes


        Une annotation peut être écrite en commentaire mais elle est "lue" parce qu'elle commence par un @
        Une route contient 2 arguments :
        1e : la route (url) exemple : localhost:8000/page
        2e : le nom de la route :

        Les arguments des annotations sont entre DOUBLE QUOTE


        #[Route('/page', name: 'page')]

    */
    #[Route('/page', name:'page')]
    public function pageFonction(): Response// : réponse peut etre retiré
    {
        $prenom="kiks";
        $age=2;
        return $this->render('page/index.html.twig', [// relie la route à une vue, un affichage
            'prenomTwig'=>$prenom,
            'ageTwig'=>$age
        ]);
    
        
    }
    #[Route(name: 'accueil')]
    public function pageaccueil(): Response// ": response" peut etre retiré
    {
        return $this->render('page/accueil.html.twig');
    
        
    }
// la méthode render permet de relier une fonction à une vue
// on accède à la fonction par la route
// toutes nos vues seront dans le dosssier templates
// le premier argument est obligatoire






}// fermeture de la class PageController
