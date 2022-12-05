<?php

namespace App\Controller;

use App\Entity\Season;
use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Category;
use App\Repository\ProgramRepository;
use App\Repository\CategoryRepository;
use App\Repository\SeasonRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProgramController extends AbstractController
{
    #[Route('/program/', name: 'program_index')]
    public function index(ProgramRepository $programRepository, CategoryRepository $categoryRepository): Response
    {
        $programs = $programRepository->findAll();
        $categories = $categoryRepository->findAll();

        return $this->render('program/index.html.twig', [
            'programs' => $programs,
            'categories' => $categories
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

    #[Route('/new', name: 'new')]
    public function new(
        Request $request, ProgramRepository $programRepository, SeasonRepository $seasonRepository
        ): Response
    {
        $program = new Program();
        // $season = new Season();
        // Create the form, linked with $program
        $form = $this->createForm(ProgramType::class, $program);
        // Get data from HTTP request
    $form->handleRequest($request);

    // Was the form submitted ?
    if ($form->isSubmitted()) {
        $programRepository->save($program, true);            
        // Redirect to categories list

        return $this->redirectToRoute('program_index');
        // Deal with the submitted data
        // For example : persiste & flush the entity
        // And redirect to a route that display the result
    }
        // Render the form (best practice)
        return $this->renderForm('program/new.html.twig', [
            'form' => $form,
        ]);
        // Alternative
        // return $this->render('program/new.html.twig', [
        //   'form' => $form->createView(),
        // ]);
    }

    #[Route('/season/{season_id}/program/{program_id}', name: 'season_show_program')]
    #[Entity('season', options: ['mapping' => ['season_id' => 'id']])]
    #[Entity('program', options: ['mapping' => ['program_id' => 'id']])]
    public function showSeasonsProgram(Season $season, Program $program, )
    {
        return $this->render('season/show.html.twig', [
            'season' => $season,
            'program' => $program
        ]);
    }

    #[Route('/episode/{episode_id}/season/{season_id}/program/{program_id}', name: 'episode_show_season_show_program')]
    #[Entity('episode', options: ['mapping' => ['episode_id' => 'id']])]
    #[Entity('season', options: ['mapping' => ['season_id' => 'id']])]
    #[Entity('program', options: ['mapping' => ['program_id' => 'id']])]
    public function showEpisodeSeasonsProgram(Episode $episode, Season $season, Program $program, )
    {
        return $this->render('program/episode_show.html.twig', [
            'episode' => $episode,
            'season' => $season,
            'program' => $program
        ]);
    }
}