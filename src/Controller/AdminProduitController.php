<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminProduitController extends AbstractController
{
    /*

        CRUD : 
        Create(INSRT INTO) 
        Read (SELECT)
        Update 
        Delete

        /gestion_produit/afficher      name="produit_afficher"
        /gestion_produit/ajouter       name="produit_ajouter"
        /gestion_produit/modifier      name="produit_modifier"
        /gestion_produit/supprimer     name="produit_supprimer"

        _____________________________________________________________________________________________________

        MVC :
        Model :
            - Entity (=table)
            - Repository (= Requête SELECT)
            - EntityManagerInterface (= Requêtes INSERT INTO - UPDATE / DELETE )




    */



    /**
     * La fonction produit_afficher() permet d'afficher la table produit en bdd sous forme de tableau (BACK-OFFICE)
     * Sur chaque ligne, on y trouvera les routes pour modifier et supprimer
     * également on trouvera la route pour ajouter un produit 
     * 
     * @Route("/gestion_produit/afficher", name="produit_afficher")
     */
    public function produit_afficher(ProduitRepository $repoProduit)
    {
        $produitsArray = $repoProduit->findAll();

        return $this->render('admin_produit/produit_afficher.html.twig', [
            "produits" => $produitsArray
        ]);
    }




    /**
     * La fonction produit_ajouter() permet d'ajouter un produit
     * 
     * 
     * @Route("/gestion_produit/ajouter", name="produit_ajouter")
     */
    public function produit_ajouter(Request $request, EntityManagerInterface $manager)
    {
        // Pour ajouter un produit on a besoin de créer un nouvel objet (instance) issu de la class Produit(Entity)

        $produit = new Produit;
        dump($produit);// on observe qu'il y a toutes les propriétés de la class Produit (id, titre, prix etc...) et qu'elles sont null


        /*
            Pour créer un formulaire, on utilise la méthode createForm() provenant de la class AbstractController
            2 arguments obligatoires :
            1er : class du formType : ProduitType::class
            2e : objet issu de la class (entity)

            3e (facultatif) : tableau
        */

            $form = $this->createForm(ProduitType::class, $produit);
            // $form est un objet (qui contient ses méthodes)



            $form->handleRequest($request); 
            /*
                HandleRequest() permet de gérer le traitement de la saisie du formulaire.
                Lorsque qu'on soumet le formulaire (bouton submit) $_POST est transmis à la même URL
                grâce à la request, on peut traiter le contenu de la requête 

                La class Request contient les propriétés concernant les superglobales
                request = $_POST
                query = $_GET
                files = $_FILES ....

                ex pour appeler le $_POST : $request->request 


            */

            // si le formulaire a été soumis (clic sur le bouton de type="submit")
            // et si le formulaire a été validé (respect des conditions/contraintes)
            if($form->isSubmitted() && $form->isValid())
            {
                //dd($request);
                dump($produit);

                $produit->setDateAt(new \DateTimeImmutable('now'));
                /*
                    Lorsqu'on importe une class provenant du projet symfony on doit définir d'où elle provient par le 'use'
                    DateTimeImmutable n'est pas une class créée par Symfony, on la trouve sur PHP
                    il faut utiliser devant la class l'antislash
                */

                //dd($produit);


                $manager->persist($produit); // on persiste ce qu'on souhaite envoyer en BDD : l'objet $produit
                // on ne définit pas dans quelle table, car on envoit un objet issu d'une class (= Entity)
                $manager->flush(); // envoie en BDD


                // notification




                // redirection
            }


        return $this->render("admin_produit/produit_ajouter.html.twig",[
            "formProduit" => $form->createView()
        ]);
    }



















}
