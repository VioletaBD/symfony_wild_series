<?php

namespace App\Controller;

use App\Entity\Season;
use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Category;
use App\Form\ProgramType;
use App\Repository\ProgramRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    #[Route('/program/new', name: 'program_new')]
    public function new(
        Request $request,
        ProgramRepository $programRepository
    ): Response {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $programRepository->save($program, true);
            return $this->redirectToRoute('program_index');
        }
        return $this->renderForm('program/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/program/{programId}', name: 'program_show')]
    public function showProgram(int $programId, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $programId]);
        return $this->render('program/show.html.twig', [
            'program' => $program
        ]);
    }

    #[Route('/program/{program_id}/category/{category_id}', name: 'program_show_category')]
    #[Entity('program', options: ['mapping' => ['program_id' => 'id']])]
    #[Entity('category', options: ['mapping' => ['category_id' => 'id']])]
    public function showProgramCategory(Program $program, Category $category): Response
    {
        return $this->render('program/show.html.twig', [
            'program' => $program,
            'category' => $category,
        ]);
    }

    #[Route('program/{program_id}/season/{season_id}/', name: 'program_season_show')]
    #[Entity('season', options: ['mapping' => ['season_id' => 'id']])]
    #[Entity('program', options: ['mapping' => ['program_id' => 'id']])]
    public function showSeasonsProgram(Season $season, Program $program,)
    {
        return $this->render('season/show.html.twig', [
            'season' => $season,
            'program' => $program
        ]);
    }

    #[Route('/program/{program_id}/season/{season_id}/episode/{episode_id}', name: 'program_episode_show')]
    #[Entity('episode', options: ['mapping' => ['episode_id' => 'id']])]
    #[Entity('season', options: ['mapping' => ['season_id' => 'id']])]
    #[Entity('program', options: ['mapping' => ['program_id' => 'id']])]
    public function showEpisodeSeasonsProgram(Episode $episode, Season $season, Program $program,)
    {
        return $this->render('program/episode_show.html.twig', [
            'episode' => $episode,
            'season' => $season,
            'program' => $program
        ]);
    }
}
