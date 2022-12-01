<?php

namespace App\Controller;

use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program')]
class ProgramController extends AbstractController
{
    #[Route('/program/', name: 'program_index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', [
            'programs' => $programs,
        ]);
    }

    #[Route('/program/list/{page}', requirements: ['page' => '\d+'], name: 'program_list')]
    public function list(int $page): Response

    {

        return $this->redirectToRoute ('program_show', ['id' => 4]);
    }

    #[Route('/program/{id}/', requirements: ['id'=>'\d+'], name: 'program_list')]
    public function showProgram(int $id, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);
        return $this->render('program/list.html.twig', [
            'id' => $id,
            'program' => $program
        ]);
    }

}