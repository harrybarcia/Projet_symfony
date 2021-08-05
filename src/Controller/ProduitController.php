<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
//le fonction catalogue permet d'afficher la table produit en bdd (front-office)
//sur chaque produit on y trouvera le bouton pour accéder à la route fiche_produit
{
    #[Route('/catalogue', name: 'catalogue')]
    // d'abord la classe suivi du nom de l'objet.
    public function catalogue(ProduitRepository $repoProduit): Response
    {

        /*
        lorsqu'on créé une entity est généré son repository
        Repository:Requête Select
        1ere façon, création de l'objet issu de la class ProduitRepository
        On utilise la méthode getDoctrine() provenant de la classe AbstractController
        Dans celle-ci se trouve la méthode getRepository() qui aura comme argument
        le nom de la class ligne 28 ici.
        A la ligne 17 j'ai ça 
            public function catalogue(): Response


                $repoProduit=$this->getDoctrine()->getRepository(Produit::class);
        $produitsArray=$repoProduit->findAll();
        dump($produitsArray);
        return $this->render('produit/catalogue.html.twig');


2eme façon, c'est d'appeler en argument de la fonction catalogue() la class suivi de son objet.

Ici $repoProduit est un nouvel objet.
        */

    $produitsArray=$repoProduit->findAll();
        dump($produitsArray);
        return $this->render('produit/catalogue.html.twig',
        ["produits"=>$produitsArray]);
        
    }
}
