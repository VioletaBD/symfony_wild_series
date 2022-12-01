<?php

namespace App\Controller;

use App\Repository\ProgramRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
            'program' => $program,
            'categories' => $categories,
        ]);
    }

    #[Route('/program/{id}/season/{seasonId}/', requirements: ['id'=>'\d+'], name: 'program_season_show')]
    public function showSeasons(
        int $id, 
        int $seasonId, 
        ProgramRepository $programRepository, 
        SeasonRepository $seasonRepository, 
        CategoryRepository $categoryRepository
        )
    {
        $season = $seasonRepository->findOneBy(['id' => $seasonId]);
        $categories = $categoryRepository->findAll();
        $program = $programRepository->findOneBy(['id' => $id]);

        return $this->render('season/show.html.twig', [
            'season' => $season,
            'categories' => $categories,
            'program' => $program
        ]);
    }
}