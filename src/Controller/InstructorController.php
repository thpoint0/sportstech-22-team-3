<?php

namespace App\Controller;

use App\Entity\Instructor;
use App\Form\InstructorType;
use App\Repository\InstructorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/instructor')]
class InstructorController extends AbstractController
{
    #[Route('/', name: 'app_instructor_index', methods: ['GET'])]
    public function index(InstructorRepository $instructorRepository): Response
    {
        return $this->render('instructor/index.html.twig', [
            'instructors' => $instructorRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_instructor_new', methods: ['GET', 'POST'])]
    public function new(Request $request, InstructorRepository $instructorRepository): Response
    {
        $instructor = new Instructor();
        $form = $this->createForm(InstructorType::class, $instructor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $instructorRepository->add($instructor, true);

            return $this->redirectToRoute('app_instructor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('instructor/new.html.twig', [
            'instructor' => $instructor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_instructor_show', methods: ['GET'])]
    public function show(Instructor $instructor): Response
    {
        return $this->render('instructor/show.html.twig', [
            'instructor' => $instructor,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_instructor_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Instructor $instructor, InstructorRepository $instructorRepository): Response
    {
        $form = $this->createForm(InstructorType::class, $instructor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $instructorRepository->add($instructor, true);

            return $this->redirectToRoute('app_instructor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('instructor/edit.html.twig', [
            'instructor' => $instructor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_instructor_delete', methods: ['POST'])]
    public function delete(Request $request, Instructor $instructor, InstructorRepository $instructorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$instructor->getId(), $request->request->get('_token'))) {
            $instructorRepository->remove($instructor, true);
        }

        return $this->redirectToRoute('app_instructor_index', [], Response::HTTP_SEE_OTHER);
    }
}
