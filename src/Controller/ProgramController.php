<?php

namespace App\Controller;

use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgramController extends AbstractController
{
    #[Route('/program/', name: 'program_index')]
    public function index(): Response
    {
        return $this->render('program/index.html.twig', [
            'website' => 'Wild Series',
        ]);
    }

    // #[Route('/program/{id}', methods: ['GET'], name: 'program_show')]
    // public function show(int $id, ProgramRepository $programRepository): Response
    // {
    //     // $this->$program();
    //     $program = $programRepository;
    //     $programRepository = new ProgramRepository();
        
    //     if (!$program) {
    //         throw $this->createNotFoundException (
    //             'Error : ' . $id . ' not found. '
    //         );
    //     }
    //     return $this->render('program/show.html.twig', [
    //         'program' => $program,
    //     ]);
    // }


}