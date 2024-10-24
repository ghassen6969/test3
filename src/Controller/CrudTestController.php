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

#[Route('/crud/Test')]
class CrudTestController extends AbstractController
{
    #[Route('/list', name: 'app_crud_Test')]
    public function list(LibraryRepository $repository): Response
    {
          $list = $repository->findAll();
                return $this->render('crud_Test/list.html.twig', ['list' => $list]);


    }
//insert Test
    #[Route('/new', name: 'app_crud_Test_new')]
    public function add(ManagerRegistry $doctrine, Request $request): Response
    {

        if ($request->isMethod('POST')) {

            $date $request->request->get('date');
            $note = $request->request->get('note');
            $matiere = $request->request->get('matiere');


            $Test = new Test();
            $Test->setDate($date);
            $Test->setNote($note);
            $Test->setMatiere($matiere);

            // Persist and flush the new Library entity to the database
            $em = $doctrine->getManager();
            $em->persist($library);
            $em->flush();

            // Redirect to another route (e.g., the library list) after the form is processed
            return $this->redirectToRoute('app_crud_Test');
        }

        // If the request is not POST, display the form (GET request)
        return $this->render('crud_Test/form.html.twig');
    }
//delete library
    #[Route('/delete/{id}', name: 'app_delete_Test')]
    public function app_delete_Test(Test $Test, ManagerRegistry $doctrine): Response
    {

        $em = $doctrine->getManager();
        $em->remove($library);
        $em->flush();
        return $this->redirectToRoute('app_crud_Test');

 //update
     #[Route('/update/{id}', name: 'app_crud_update_Test')]
     public function update(ManagerRegistry $doctrine, LibraryRepository $repository, Request $request): Response
     {
         if ($request->isMethod('POST')) {
             $id = $request->get('id');
             $Test = $repository->find($id);


             $newdate = $request->request->get('date');
             $newnote = $request->request->get('note');
             $newmatiere = $request->request->get('matiere');



             $Test->setDate($newdate);
             $Test->setNote($newnote);
             $Test->setMatiere($newmatiere);

             //presist the object in the doctrine
             $em = $doctrine->getManager();
             $em->flush();
             return $this->redirectToRoute('app_crud_etudiant');
         }


         return $this->render('crud_Test/formupdate.html.twig');
     }


 }