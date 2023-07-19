<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Repository\ArtistRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Impersonate\ImpersonateUrlGenerator;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;



#[Route('/artist')]
class ArtistController extends AbstractController
{


    #[Route('/', name: 'app_artist_index', methods: ['GET'])]
    public function index(ArtistRepository $artistRepository): Response
    {
        return $this->render('artist/index.html.twig', [
            'artists' => $artistRepository->findAll(),
        ]);
    }

    #[IsGaranted("ROLE_ADMIN")]
    #[Route('/new', name: 'app_artist_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ArtistRepository $artistRepository, FileUploader $fileUploader): Response
    {
        $artist = new Artist();
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('artistImageUrl')->getData();
            if ($brochureFile) {
                $brochureFileName = $fileUploader->upload($brochureFile);
                $artist->setArtistImageUrl($brochureFileName);
            }
            $artistRepository->save($artist, true);

            return $this->redirectToRoute('app_artist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('artist/new.html.twig', [
            'artist' => $artist,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_artist_show', methods: ['GET'])]
    public function show(Artist $artist): Response
    {
        return $this->render('artist/show.html.twig', [
            'artist' => $artist,
        ]);
    }

    #[IsGaranted("ROLE_ADMIN")]
    #[Route('/{id}/edit', name: 'app_artist_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Artist $artist, ArtistRepository $artistRepository, SluggerInterface $slugger, FileUploader $fileUploader): Response
    {

        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('artistImageUrl')->getData();
            if ($brochureFile) {
                $brochureFileName = $fileUploader->upload($brochureFile);
                $artist->setArtistImageUrl($brochureFileName);
            }
            $artistRepository->save($artist, true);

            return $this->redirectToRoute('app_artist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('artist/edit.html.twig', [
            'artist' => $artist,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_artist_delete', methods: ['POST'])]
    public function delete(Request $request, Artist $artist, ArtistRepository $artistRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $artist->getId(), $request->request->get('_token'))) {
            $artistRepository->remove($artist, true);
        }

        return $this->redirectToRoute('app_artist_index', [], Response::HTTP_SEE_OTHER);
    }
}
