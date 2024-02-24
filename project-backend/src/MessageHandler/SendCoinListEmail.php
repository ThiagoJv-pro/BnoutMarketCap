<?php

namespace App\MessageHandler;

use App\Entity\Email;
use App\Message\CoinListEmail;
use App\Services\CoinService;
use App\Services\EmailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SendCoinListEmail
{
    public function __construct
    (
        private MailerInterface $mailerInterface,
        private CoinService $coin,
        private EmailService $emailService,
        private EntityManagerInterface $em
    ){
    }
    public function __invoke(CoinListEmail $coinListEmail)
    {
        
        $emailEntity = $this->em->getRepository(Email::class)->findOneBy(["address" => $coinListEmail->getEmailAddress()]);
        $type = $coinListEmail->getRequestCoin();

        $func = array(
            'All' => $this->coin->getInfoCoin(),
            'Crypto' => $this->coin->getListCrypto(),
            'Traditional' => $this->coin->getListTraditionalCurrency(),
        );

        if(array_key_exists($type, $func))
        {
            $type = $func[$type];
        }

            $email = (new TemplatedEmail())
                ->from('project@gmail.com')
                ->to($emailEntity->getAddress())
                ->subject('Exchange list')
                ->htmlTemplate('email/index.html.twig')
                ->context(compact('type'));
    
            $this->mailerInterface->send($email);
    }
}