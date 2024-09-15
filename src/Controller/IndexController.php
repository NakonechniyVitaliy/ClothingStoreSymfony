<?php

namespace App\Controller;

use App\Entity\Cloth;
use App\Repository\ClothRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(ClothRepository $clothRepository): Response
    {
        $cloth = $clothRepository->findAll();

        return $this->render('index/index.html.twig', [
            'cloth' => $cloth,
        ]);
    }
}
