<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Business\CryptocurrencyBO;
use App\Business\TraditionalCurrencyBO;
use App\Api\apiClient;
use App\Business\CoinBO;
use App\Entity\TraditionalCurrency;
use Doctrine\ORM\EntityManagerInterface;

use function Amp\Iterator\toArray;

class CoinController extends AbstractController
{   
    private $coin;
    /**
     * @var TraditionalCurrencyBO
     */
    private $traditionalCurrencyBO;
   
    private $apiClient;
    
    /**
      * @var CryptocurrencyBO
    */ 
    private $cc;
    private $em;

    public function __construct(
      CoinBO $coin,
      apiClient $apiClient, 
      EntityManagerInterface $entityManager, 
      TraditionalCurrencyBO $traditionalCurrencyBO,
      CryptocurrencyBO $cc,
      ){
      $this->apiClient =  $apiClient;
      $this->em = $entityManager; //Injetar dependencia
      $this->traditionalCurrencyBO = $traditionalCurrencyBO;
      $this->cc = $cc;
      $this->coin = $coin;
    } 

    #[Route('/cryptocurrency', name: 'get_crypto_currency', methods: ['GET'])]
    /**@Cors(allowOrigin="*", allowHeaders={"X-Requested-With", "Content-Type"})
    */
    public function getCriptocurrency():  Response
    {
     
    $data = $this->apiClient->getData();
    $teste = $this->cc->getCryptoCurrencysFromApi($data);
      // $teste = $this->coin->getInfoCoin();
      return new JsonResponse($teste);

    }



    #[Route('/currency', name: 'get_currency', methods: ['GET'])]
    /**@Cors(allowOrigin="*", allowHeaders={"X-Requested-With", "Content-Type"})
    */
    public function getCurrency():  Response
    {
    
      $infoCoin = $this->coin->getInfoCoin();
      
      // dd($infoCoin);
      return new JsonResponse($infoCoin);

    }
}