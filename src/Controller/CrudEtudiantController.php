<?php

namespace App\Controller;

use App\Entity\Test;
use App\Entity\Etudiant;
use App\Repository\TestRepository;
use App\Repository\EtudiantRepository;
use DateTimeInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;



#[Route('/crud/Etudiant')]
class CrudEtudiantController extends AbstractController
{
    #[Route('/list', name: 'app_crud_etudiant')]
    public function list(LibraryRepository $repository): Response
    {
          $list = $repository->findAll();
                return $this->render('crud_Etudiant/list.html.twig', ['list' => $list]);


    }
//insert Etudiant
    #[Route('/new', name: 'app_crud_etudiant_new')]
    public function add(ManagerRegistry $doctrine, Request $request): Response
    {

        if ($request->isMethod('POST')) {

            $firstName = $request->request->get('firstName');
            $lastName = $request->request->get('lastName');
            $Email = $request->request->get('Email');


            $Etudiant = new Etudiant();
            $Etudiant->setFirstName($firstName);
            $Etudiant->setLastName($lastName);
            $Etudiant->setDateCreation($creationDate);

            // Persist and flush the new Library entity to the database
            $em = $doctrine->getManager();
            $em->persist($library);
            $em->flush();

            // Redirect to another route (e.g., the library list) after the form is processed
            return $this->redirectToRoute('app_crud_etudiant');
        }

        // If the request is not POST, display the form (GET request)
        return $this->render('crud_Etudiant/form.html.twig');
    }
//delete library
    #[Route('/delete/{id}', name: 'app_delete_etudiant')]
    public function deleteEtudiant(Etudiant $Etudiant, ManagerRegistry $doctrine): Response
    {

        $em = $doctrine->getManager();
        $em->remove($library);
        $em->flush();
        return $this->redirectToRoute('app_crud_library');

 //update
     #[Route('/update/{id}', name: 'app_crud_update_Etudiant')]
     public function update(ManagerRegistry $doctrine, LibraryRepository $repository, Request $request): Response
     {
         if ($request->isMethod('POST')) {
             $id = $request->get('id');
             $Etudiant = $repository->find($id);


             $newfirstName = $request->request->get('firstName');
             $newlastName = $request->request->get('lastName');
             $newWebsite = $request->request->get('website');
             $newEmail = $request->request->get('Email');


             $Etudiant>setLastName($newlastName);
             $Etudiant->setFirstName($newfirstName);
             $Etudiant->setEmail($newEmail);

             //presist the object in the doctrine
             $em = $doctrine->getManager();
             $em->flush();
             return $this->redirectToRoute('app_crud_etudiant');
         }


         return $this->render('crud_Etudiant/formupdate.html.twig');
     }


 }










}
