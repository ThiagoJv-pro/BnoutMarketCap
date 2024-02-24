<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Services\CryptocurrencyService;
use App\Services\TraditionalCurrencyBO;
use App\Api\apiClient;

use App\Services\ChartService;
use App\Services\CoinService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use PHPUnit\Util\Json;
use Symfony\Component\HttpFoundation\Request;

use function Amp\Iterator\toArray;

class CoinController extends AbstractController
{
  public function __construct(
    private CoinService $coin,
    private ChartService $chart,
    private apiClient $apiClient,
    private EntityManagerInterface $entityManager,
    private TraditionalCurrencyBO $traditionalCurrencyBO,
    private CryptocurrencyService $cc,
  ) {
  }

  #[Route('/cryptocurrency', name: 'get_crypto_currency', methods: ['GET'])]
  /**@Cors(allowOrigin="*", allowHeaders={"X-Requested-With", "Content-Type"})
   */
  public function getCriptocurrency(): Response
  {
    try {
      $data = $this->apiClient->getData();
      $crypto = $this->cc->getCryptoCurrencysFromApi($data);
      // $teste = $this->coin->getInfoCoin();
      return new JsonResponse($crypto);

    } catch (Exception $e) {

      throw new $e('Erro ao processar requisicao ' . 'linha: ' . $e->getLine());
    }


  }

  #[Route('/currency', name: 'get_currency', methods: ['GET'])]
  #[Route('/currency/update', name: 'get_currency_update', methods: ['GET'])]
  public function getCurrency(Request $request): Response
  {
    try {
      $data = $request->get('_route');

      $infoCoin = ($data == 'get_currency') ? 
      $this->coin->getInfoCoin() : 
      $this->traditionalCurrencyBO->getTraditionalCurrencyFromApi(true); 

      return new JsonResponse($infoCoin);

    } catch (Exception $e) {

      throw new $e('Erro ao processar requisicao ' . 'linha: ' . $e->getLine());
    }
  }

  #[Route('/listCoin', name: 'get_list_coin', methods: ['GET'])]
  public function getListCoin(Request $request): Response
  {
    try {

      $typeCurrency = $request->query->get('currency');
      $list = array();

      if ($typeCurrency == 'c') {
        $list = $this->coin->getFavoriteCrypto();
      } else if ($typeCurrency == 't') {
        $list = $this->coin->getFavoriteTraditionalCurrency();
      }

      return new JsonResponse($list);

    } catch (Exception $e) {
      throw new $e('Erro ao processar requisicao ' . 'linha: ' . $e->getLine());
    }
  }

}