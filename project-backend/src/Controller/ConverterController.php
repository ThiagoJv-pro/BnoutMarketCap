<?php

namespace App\Controller;

use App\Services\ConverterService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ConverterController extends AbstractController
{
    #[Route('/converter', name: 'app_converter')]
    public function getConverter(Request $request, ConverterService $converterService): Response
    {
        try {

            $fromPrice = $request->query->get('fromPrice'); //Capturar valor correspondente ao parametro passado
            $toPrice = $request->query->get('toPrice');
            $inverter = $request->query->get('inverter');
            $conversion = $converterService->converter($fromPrice, $toPrice, $inverter);

            return new JsonResponse($conversion);

        } catch (Exception $e) {

            throw new $e('Erro ao processar requisicao ' . 'linha: ' . $e->getLine());
        }

    }
}
