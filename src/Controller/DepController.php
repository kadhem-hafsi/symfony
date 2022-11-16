<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Departement;
use App\Entity\Computer;
use App\Form\DepartementType;
use App\Form\ComputerType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DepController extends AbstractController
{
  
     #[Route('/depliste', name: 'depliste')]
    public function affichDepart(ManagerRegistry $doctrine): Response
    {
        //$deparetemts=$doctrine->getRepository(Departement::class)->findAll();
        $deparetemts=$doctrine->getRepository(Departement::class)->listdep();
        return $this->render('dep/ListDep.html.twig', [
            'controller_name' => 'DepController',
            'deparetemts'=>$deparetemts,
        ]);
    }

///////////////////////////////////////////////
    #[Route('/ajoudep', name: 'ajoudep')]
    public function ajouterDepartement(ManagerRegistry $doctrine,Request $request): Response
    {
        $departements = new Departement();
        $form=$this->createform(DepartementType::class,$departements);
        $form->handleRequest($request);

        if($form->isSubmitted ()){
            $em=$doctrine->getManager();
            $em->persist($departements);
            $em->flush();
            return $this->redirectToRoute(route:'depliste');
        }
        
        return $this->render('dep/ajouDep.html.twig', [
            'controller_name' => 'DepController',
            'f'=> $form->createview(),
        ]);
    }
//////////////////////////////////////////////////////////////

#[Route('/Mod/{id}', name: 'M')]
    public function Modiffier(ManagerRegistry $doctrine,$id,Request $request): Response
    {
        $deparetemts=$doctrine->getRepository(Departement::class)->find($id);
        $form=$this->createForm(DepartementType::class,$deparetemts);
        $form->handleRequest($request);
       // $form->add('Moddifer_departement',SubmitType::class);
        if($form->isSubmitted()){
            $em=$doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute(route:'depliste');
        }
        
        return $this->render('dep/Modif.html.twig', [
            'controller_name' => 'DepController',
            'f' => $form->createview(),
        ]);
    }
//////////////////////////////////////////////////////
    #[Route('/Supp/{id}', name: 'S')]
    public function Suprimer(ManagerRegistry $doctrine,$id,Request $request): Response
    {
        $deparetemts=$doctrine->getRepository(Departement::class)->find($id);
            $em=$doctrine->getManager();
            $em->remove($deparetemts);
            $em->flush();
        
        return $this->redirectToRoute(route:'depliste');
    }

/////////////1em methode d'ajout d'un compu a prtir de choix implicite (id) de deprtement/////
    #[Route('/ajoucomp/{id}', name: 'ajouC')]
    public function ajouterComputer(ManagerRegistry $doctrine,Request $request,$id): Response
    {
        $computers = new Computer();
        $formComp=$this->createform(ComputerType::class,$computers);
        $formComp->handleRequest($request);

        if($formComp->isSubmitted() && $formComp->isValid()){
            $dep=$doctrine->getRepository(Departement::class)->find($id);
            $computers->setIdDepartement($dep);
            $em=$doctrine->getManager();
            $em->persist($computers);
            $em->flush();
            return $this->redirectToRoute(route:'depliste');
        }
        
        return $this->render('dep/ajouComp.html.twig', [
            'controller_name' => 'DepController',
            'fCom'=> $formComp->createview(),
           
        ]);
    }

//////////2 eme methode d ajout d'un compu a prtir de choisx direct de deprtement/////

 #[Route('/ajoucomp2', name: 'ajoucomp2')]
    public function ajouterComputer2(ManagerRegistry $doctrine,Request $request): Response
    {
        $computers = new Computer();
        $formComp=$this->createform(ComputerType::class,$computers);
        $formComp->handleRequest($request);

        if($formComp->isSubmitted() && $formComp->isValid()){
         //$dep=$doctrine->getRepository(Departement::class)->find($id);
        // $computers->setIdDepartement($dep);
            $em=$doctrine->getManager();
            $em->persist($computers);
            $em->flush();
            return $this->redirectToRoute(route:'depliste');
        }
        
        return $this->render('dep/ajouComp2.html.twig', [
            'controller_name' => 'DepController',
            'fCom'=> $formComp->createview(),
           
        ]);
    }


      #[Route('/compliste', name: 'compliste')]
    public function affichcomp(ManagerRegistry $doctrine): Response
    {
        $computer=$doctrine->getRepository(Departement::class)->listcomp();
        return $this->render('dep/Listcomp.html.twig', [
            'controller_name' => 'DepController',
            'computer'=>$computer,
        ]);
    }

}
