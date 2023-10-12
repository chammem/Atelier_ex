<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AuthorRepository;

class AuthorController extends AbstractController
{
    public $authors = array(array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg','username' => 'Victor Hugo' , 'email' => 'victor.hugo@gmail.com ', 'nb_books' => 100),
    array('id' => 2, 'picture' => '/images/william-shakespeare.jpg','username' => ' William Shakespeare' , 'email' =>  ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
    array('id' => 3, 'picture' => '/images/Taha_Hussein.jpg','username' => 'Taha Hussein' , 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
    array('id' => 4, 'picture' => '/images/Taha_Hussein.jpg','username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
   
         );
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }
    #[Route('/showAuthor/{name}', name: 'app_showAuthor')]
    public function showAuthor($name): Response
    {   
        return $this->render('author/showAuthor.html.twig', [
            'namehtml'=> $name
        ]);
    }


    #[Route('/showtableauthor', name: 'showtableauthor')]
    public function showtableauthor(): Response
    {
       
        return $this->render('author/table.html.twig', [
            'author' => $this->authors,
        ]);
    }

    #[Route('/authorDetails/{id}', name: 'authorDetails')]
    public function authorDetails($id): Response
    {  
        
        $author = null;

        // Recherchez l'auteur en fonction de l'ID
        foreach ($this->authors as $i) {
            if ($i['id'] == $id) {
                $author = $i;
                break;
            }
        }
 //var_dump($author) . die();
        return $this->render('author/showAuthor.html.twig', [
            'author' => $author,
        ]);
    }

    #[Route('/showdbauthor', name: 'app_showdbauthor')]
    public function showdbauthor(AuthorRepository $x ): Response
    {    $author = $x->findAll();
        return $this->render('author/showdbauthor.html.twig', [
            'author'=> $author
        ]);
    }

    }