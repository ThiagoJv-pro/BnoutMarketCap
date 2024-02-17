<?php

namespace App\Controller;

use App\Entity\Chart;
use App\Services\NewsService;
use App\Services\QualquerTeste;
use App\Services\TraitService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{

    public function __construct
    (
        private NewsService $newsService,
        private TraitService $traitService
    ) {

    }
    #[Route('/news', name: 'app_news')]
    public function index(): Response
    {
        try {
            $dataReturn = $this->newsService->getDataNews();

            return new JsonResponse($dataReturn);
        } catch (Exception $e) {
            throw new $e('Erro ao processar requisicao ' . 'linha: ' . $e->getLine());
        }

    }
}
