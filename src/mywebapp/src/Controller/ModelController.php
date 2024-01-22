<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Model;
use App\Entity\UserCar;
use App\Form\UserCarType;
use App\Service\SpamChecker;

class ModelController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SluggerInterface $slugger,
    ) {
    }

    #[Route('/marque/{brand_slug}/modele/{slug}', name: 'model_show')]
    public function show(
        Request $request,
        Model $model,
        SpamChecker $spamChecker,
    ): Response
    {
        $userCar = new UserCar();
        $form = $this->createForm(UserCarType::class, $userCar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userCar->setModel($model);

            if ($photo = $form['photo']->getData()) {
                $filename = $this->makeFileName(
                    $this->slugger,
                    (string) $form['owner']->getData(),
                    $model,
                    $photo->guessExtension()
                );
                $photo->move(
                    $this->getParameter('upload.images.path') . UserCar::DIR_NAME,
                    $filename
                );
                $userCar->setPhotoFilename($filename);
            }

            $this->entityManager->persist($userCar);

            $context = [
                'user_ip' => $request->getClientIp(),
                'user_agent' => $request->headers->get('user_agent'),
                'referrer' => $request->headers->get('referer'),
                'permalink' => $request->getUri(),
            ];
            if (2 === $spamChecker->getSpamScore($userCar, $context)) {
                throw new \RuntimeException('Spam détecté.');
            }

            $this->entityManager->flush();

            return $this->redirectToRoute('model_show', [
                'brand_slug' => $request->attributes->get('brand_slug'),
                'slug' => $request->attributes->get('slug'),
            ]);
        }

        return $this->render('model/show.html.twig', [
            'model' => $model,
            'userCarForm' => $form,
            'userCars' => $model->getUserCars(),
            'userCarsDir' => $this->getParameter('upload.images.path'),
        ]);
    }

    private function makeFileName(SluggerInterface $slugger, string $owner, Model $model, string $extension): string
    {
        return $slugger->slug(
            implode('-',[
                    $owner,
                    $model->getName(),
                    bin2hex(random_bytes(6)),
                ])) . '.' . $extension;
    }
}
