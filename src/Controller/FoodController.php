<?php

namespace App\Controller;

use App\Entity\Food;
use App\Form\FoodType;
use App\Repository\FoodRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FoodController extends AbstractController
{
    /**
     * @Route("/food", name="food_index")
     */
    public function index(FoodRepository $foodRepository): Response
    {
        return $this->render('food/index.html.twig', [
            'food' => $foodRepository->findAll(),
        ]);
    }
    /**
     * @Route("/food/new", name="food_new", methods={"GET", "POST"})
     */
    public function new(Request $request, FoodRepository $foodRepository): Response
    {
        $food = new Food();
        $form = $this->createForm(FoodType::class, $food);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $foodRepository->add($food, true);

            return $this->redirectToRoute('food_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('food/new.html.twig', [
            'food' => $food,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/food/{id}", name="food_show", methods={"GET"})
     */
    public function show(Food $food): Response
    {
        return $this->render('food/show.html.twig', [
            'food' => $food,
        ]);
    }

    /**
     * @Route("/food/{id}/edit", name="food_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Food $food, FoodRepository $foodRepository): Response
    {
        $form = $this->createForm(FoodType::class, $food);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $foodRepository->add($food, true);

            return $this->redirectToRoute('food_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('food/edit.html.twig', [
            'food' => $food,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/food/{id}", name="food_delete", methods={"POST"})
     */
    public function delete(Request $request, Food $food, FoodRepository $foodRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $food->getId(), $request->request->get('_token'))) {
            $foodRepository->remove($food, true);
        }

        return $this->redirectToRoute('food_index', [], Response::HTTP_SEE_OTHER);
    }
    /**
     * Displays all foods of give chef id.
     * 
     * @Route("/food/{id}/chef", name="food_chef")
     */
    public function showPartsByCarId($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Food::class);
        $data = $repo->find($id);
        return $this->render('food/showFoodAndChef.html.twig', array(
            'food' => $data,
        ));
    }
}
