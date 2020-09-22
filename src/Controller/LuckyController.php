<?php

namespace App\Controller;

use App\Service\LuckyNumberGenerator;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    private $logger;
    private $luckyNumberGenerator;

    public function __construct(Logger $logger, LuckyNumberGenerator $luckyNumberGenerator)
    {
        $this->logger = $logger;
        $this->luckyNumberGenerator = $luckyNumberGenerator;
    }

    /**
     * @Route("/lucky/number/{max<\d+>}", methods={"GET"})
     */
    public function number($max)
    {
        //$number = random_int($this->globalMinNumber, $max);
        //$generator = new LuckyNumberGenerator();
        $number = $this->luckyNumberGenerator->getRandomNumber($max);

        $this->logger->info(sprintf('Lucky number is "%d"', $number));

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
