<?php

namespace App\Controller;

use App\Entity\Cloth;
use App\Form\ClothType;
use App\Repository\ClothRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('admin/cloth')]
final class ClothController extends AbstractController
{
    #[Route(name: 'app_cloth_index', methods: ['GET'])]
    public function index(ClothRepository $clothRepository): Response
    {
        return $this->render('cloth/index.html.twig', [
            'cloths' => $clothRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_cloth_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cloth = new Cloth();
        $form = $this->createForm(ClothType::class, $cloth);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cloth);
            $entityManager->flush();

            return $this->redirectToRoute('app_cloth_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cloth/new.html.twig', [
            'cloth' => $cloth,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cloth_show', methods: ['GET'])]
    public function show(Cloth $cloth): Response
    {
        return $this->render('cloth/show.html.twig', [
            'cloth' => $cloth,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cloth_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cloth $cloth, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ClothType::class, $cloth);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cloth_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cloth/edit.html.twig', [
            'cloth' => $cloth,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cloth_delete', methods: ['POST'])]
    public function delete(Request $request, Cloth $cloth, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cloth->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($cloth);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cloth_index', [], Response::HTTP_SEE_OTHER);
    }
}
