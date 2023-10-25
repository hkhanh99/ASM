<?php

namespace App\Controller;

use App\Entity\Bill;
use App\Form\BillType;
use App\Repository\BillRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BillController extends AbstractController
{
    /**
     * @Route("/bill", name="bill_index", methods={"GET"})
     */
    public function index(BillRepository $billRepository): Response
    {
        return $this->render('bill/index.html.twig', [
            'bills' => $billRepository->findAll(),
        ]);
    }

    /**
     * @Route("/bill/new", name="bill_new", methods={"GET", "POST"})
     */
    public function new(Request $request, BillRepository $billRepository): Response
    {
        $bill = new Bill();
        $form = $this->createForm(BillType::class, $bill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $billRepository->add($bill, true);

            return $this->redirectToRoute('bill_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bill/new.html.twig', [
            'bill' => $bill,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/bill/{id}", name="bill_show", methods={"GET"})
     */
    public function show(Bill $bill): Response
    {
        return $this->render('bill/show.html.twig', [
            'bill' => $bill,
        ]);
    }

    /**
     * @Route("/bill/{id}/edit", name="bill_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Bill $bill, BillRepository $billRepository): Response
    {
        $form = $this->createForm(BillType::class, $bill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $billRepository->add($bill, true);

            return $this->redirectToRoute('bill_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bill/edit.html.twig', [
            'bill' => $bill,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/bill_{id}", name="bill_delete", methods={"POST"})
     */
    public function delete(Request $request, Bill $bill, BillRepository $billRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $bill->getId(), $request->request->get('_token'))) {
            $billRepository->remove($bill, true);
        }

        return $this->redirectToRoute('bill_index', [], Response::HTTP_SEE_OTHER);
    }
    
}
