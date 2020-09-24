<?php

namespace App\Controller;

use App\Service\LuckyNumberGenerator;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    private $luckyNumberGenerator;

    public function __construct(LuckyNumberGenerator $luckyNumberGenerator)
    {
        $this->luckyNumberGenerator = $luckyNumberGenerator;
    }

    /**
     * @Route("/lucky/number/{max<\d+>}", methods={"GET"})
     */
    public function number($max, LoggerInterface $logger)
    {
        //$number = random_int($this->globalMinNumber, $max);
        //$generator = new LuckyNumberGenerator();
        $number = $this->luckyNumberGenerator->getRandomNumber($max);

        $logger->info(sprintf('Lucky number is "%d"', $number));

        // was very common in Symfony 3
        // we basically never do this in Symfony 4/5
//        $this->container->get('logger')
//            ->info('I am logging');
//
//        // allowed with public: true
//        $this->container->get('App\Service\LuckyNumberGenerator')
//            ->getRandomNumber(5);

        //dd($this->getParameter('favorite_food'));

        return $this->render('lucky/number.html.twig', [
            'number' => $number,
        ]);
    }

    public function numberApi($max)
    {
        $number = random_int(0, $max);

        return new JsonResponse(['number' => $number]);

//        return new Response(json_encode(['number' => $number]), 200, [
//            'Content-Type' => 'application/json',
//        ]);
    }
}
