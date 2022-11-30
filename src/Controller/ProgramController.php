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
        return $this->redirectToRoute('program/index.html.twig', [
            'website' => 'Wild Series',
        ]);
    }

    #[Route('/program/list/{page}', requirements: ['page' => '\d+'], name: 'program_list')]
    public function list(int $page): Response

    {

        return $this->redirectToRoute ('program_show', ['id' => 4]);
    }

    #[Route('/program/{id}', methods: ['GET'], name: 'program_show')]
    public function show(int $id): Response
    {
        // , ProgramRepository $programRepository
        // // $this->$program();
        // $program = $programRepository;
        // $programRepository = new ProgramRepository();

        // if (!$program) {
        //     throw $this->createNotFoundException (
        //         'Error : ' . $id . ' not found. '
        //     );
        // }
        return $this->redirectToRoute('program_show', ['id' => 4]);
    }

}