<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Services\ChartService;
use App\Services\CoinPriceService;
use App\Entity\CoinPrice;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ChartController extends AbstractController
{

    public function __construct
    (
        private ChartService $chart,
        private CoinPriceService $coinPriceService
    ) {
        $this->chart = $chart;
    }

    #[Route('/chart/{symbol}', name: 'app_chart', methods: ['GET'])]
    #[Route('/chart/update', name: 'app_chart_update', methods:['GET'])]
    
    public function returnCoinValue(string $symbol, Request $request): Response
    {
        try {
            $data = $request->get('_route');
            if($data == 'app_chart_update') {
                $this->chart->updateChart();
            }
            
            $chartValue = $this->coinPriceService->getCoinPriceBySymbol($symbol);
            return new JsonResponse($chartValue);
        } catch (Exception $e) {
            throw new $e('Erro ao processar requisicao ' . 'linha: ' . $e->getLine());
        }

    }

}
