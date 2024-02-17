<?php

namespace App\Controller;

use App\Message\CoinListEmail;
use App\Services\CoinService;
use App\Services\EmailService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class EmailController extends AbstractController
{

    public function __construct
    (
        private MessageBusInterface $messenger,
        private EntityManagerInterface $em,
        private CoinService $coin,

    ) {

    }

    #[Route('/email', name: 'app_email', methods: ['POST'])]
    public function index(EmailService $emailService, Request $request): Response
    {
        try {
            $data = json_decode($request->getContent(), true);
            $type = $data['coin'];
            $email = $data['email'];

            $emailService->emailRegister($email, $type);
            $this->messenger->dispatch(new CoinListEmail($email, $type));

            return new JsonResponse('Ok');
        } catch (Exception $e) {
            throw new $e('Erro ao processar requisicao ' . 'linha: ' . $e->getLine());
        }

    }
}
