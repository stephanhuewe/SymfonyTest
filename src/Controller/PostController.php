<?php

namespace App\Controller;

use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;

/**
 * @Route("/post", name="post.")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(PostRepository $postRepository)
    {
        $posts = $postRepository->findAll();



        return $this->render('post/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request)
    {
        // create a new post
        $post = new Post();

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        $form->getErrors();

        if ($form->isSubmitted() && $form->isValid())
        {

            // entity manager
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

        }

        return $this->redirect($this->generateUrl('post.index'));

        // return a response
        //return new Response('Post was created.');
        //return $this->redirect($this->generateUrl('post.index'));

        //return $this->render('post/create.html.twig', [
          //  'form' => $form->createView()
        //]);
    }

    /**
     * @Route("/show/{id}", name ="show")
     */
    public function show(Post $post)
    {
        //$post = $postRepository->find($id);


        // Create the show view
        return $this->render('post/show.html.twig', [
            'post' => $post
        ]);
    }

    /**
     * @Route("/delete/{id}", name ="delete")
     */
    public function remove(Post $post)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em -> flush();

        $this->addFlash('success', 'Post was removed');

        // Create the show view
        return $this->redirect($this->generateUrl('post.index'));
    }
}
