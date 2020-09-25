<?php

namespace App\Controller;

use App\Security\User;
use App\Service\LuckyNumberGenerator;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Security;

/**
 * @method getUser(): User
 */
class LuckyController extends AbstractController
{
    private $luckyNumberGenerator;

    public function __construct(LuckyNumberGenerator $luckyNumberGenerator)
    {
        $this->luckyNumberGenerator = $luckyNumberGenerator;
    }

    /**
     * @Route("/lucky/number/{max<\d+>}", methods={"GET"}, name="app_lucky_number")
     *
     */
    public function number($max, LoggerInterface $logger, Security $security)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'You are not an admin');

        /** @var User $user */
        $user = $this->getUser();

        //$number = random_int($this->globalMinNumber, $max);
        //$generator = new LuckyNumberGenerator();
        $number = $this->luckyNumberGenerator->getRandomNumber($max);

        //$this->denyAccessUnlessGranted('EDIT', $product);

//        if ($number >= 20) {
//            throw new AccessDeniedException('This number is too lucky');
//        }
        $this->denyAccessUnlessGranted('VIEW', $number);

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
