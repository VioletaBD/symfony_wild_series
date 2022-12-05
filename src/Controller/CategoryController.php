<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\ProgramRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends AbstractController
{
    #[Route('/category/', name: 'category_index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('category/index.html.twig', [
            'categories' => $categories,
        ]);
    }
    
    #[Route('/new', name: 'new')]
    public function new(Request $request, CategoryRepository $categoryRepository): Response
    {
        $category = new Category();
       
        // Create the form, linked with $category
        $form = $this->createForm(CategoryType::class, $category);
        
        // Get data from HTTP request

    $form->handleRequest($request);

    // Was the form submitted ?
    if ($form->isSubmitted()) {
        $categoryRepository->save($category, true);            


        // Redirect to categories list

        return $this->redirectToRoute('category_index');

        // Deal with the submitted data
        // For example : persiste & flush the entity
        // And redirect to a route that display the result

    }
        // Render the form (best practice)
        return $this->renderForm('category/new.html.twig', [
            'form' => $form,
        ]);

        // Alternative
        // return $this->render('category/new.html.twig', [
        //   'form' => $form->createView(),
        // ]);
    }

    #[Route('/category/{categoryName}/', requirements: ['category'=>'{categoryName}'], name: 'category_show')]
    public function showCategory(string $categoryName, ProgramRepository $programRepository, CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findBy(['name' => $categoryName]);

        if (!$category) {
            throw $this->createNotFoundException('The Category ' . $categoryName . ' does not exist');
        } else {

            $programs = $programRepository->findBy(
                ['category' => $category], 
                ['title' => 'DESC'], 
                3
            );
        }

        return $this->render('category/show.html.twig', [
            'programs' => $programs,
            // 'categories' => $categories,
        ]);
    }
}