<?php

namespace ST\AppBundle\Controller;

use ST\AppBundle\Entity\Trick;
use ST\AppBundle\Entity\Comment;
use ST\AppBundle\Form\TrickType;
use ST\AppBundle\Form\CommentType;
use ST\AppBundle\Form\TrickEditType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class TrickController extends Controller
{
  public function indexAction($page)
  { 
    if ($page < 1) {
      throw new NotFoundHttpException('Page '.$page.' inexistante.');
    }

    $nbPerPage = 12;
    
    //Récupérer la liste des figures
    $listTricks = $this->getDoctrine()
    ->getManager()
    ->getRepository('STAppBundle:Trick')
    ->getTricks($page, $nbPerPage)
    ;

    $nbPages = ceil(count($listTricks) / $nbPerPage);

    // Si la page n'existe pas, on retourne une 404
    if ($page > $nbPages && $nbPages >= 1) {
      throw $this->createNotFoundException('La page '.$page.' n\'existe pas.');
    }

    return $this->render('STAppBundle:Trick:index.html.twig', array(
      'listTricks' => $listTricks,
      'nbPages'     => $nbPages,
      'page'        => $page,
    ));
  }

  public function viewAction(Trick $trick, Request $request, $page)
  {
    if ($page < 1) {
      throw new NotFoundHttpException('Page '.$page.' inexistante.');
    }

    $nbPerPage = 1;

    $em = $this->getDoctrine()->getManager();

    $trick_id = $trick->getId();
    $listComments = $em
    ->getRepository('STAppBundle:Comment')
    ->getComments($trick_id, $page, $nbPerPage)
    ;

    $nbPages = ceil(count($listComments) / $nbPerPage);

    if ($page > $nbPages && $nbPages >= 1) {
      throw $this->createNotFoundException('La page '.$page.' n\'existe pas.');
    }

    $comment = new Comment();
    $comment->setDate(new \DateTime());
    $comment->setTrick($trick);
    $user = $this->getUser();
    
    if (isset($user)) {
      $comment->setUser($user);
    }

    $form = $this->createForm(CommentType::class, $comment);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

      $em->persist($comment);
      $em->flush();

      $request->getSession()->getFlashBag()->add('message', 'le commentaire a bien été ajouté.');

      return $this->redirectToRoute('st_app_view', array('slug' => $trick->getSlug()));
    }
    
    return $this->render('STAppBundle:Trick:view.html.twig', array(
       'trick' => $trick,
       'listComments' => $listComments,
       'form' => $form->createView(),
       'nbPages'     => $nbPages,
       'page'        => $page,
    ));
  }
    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function addAction(Request $request)
  { 
    $trick = new Trick();

    $form = $this->createForm(TrickType::class, $trick);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    
      $em = $this->getDoctrine()->getManager();
      $em->persist($trick);
      $em->flush();

      $request->getSession()->getFlashBag()->add('message', 'La figure a bien été enregistrée.');

      return $this->redirectToRoute('st_app_home');
    }

    return $this->render('STAppBundle:Trick:add.html.twig', array(
         'form' => $form->createView(),
    ));
  }

  public function editAction($id, Request $request)
  { 
    $em = $this->getDoctrine()->getManager();

    $trick = $em->getRepository('STAppBundle:Trick')->find($id);

    if (null === $trick) {
      throw new NotFoundHttpException("La figure d'id ".$id." n'existe pas.");
    }

    //$form = $this->createForm(TrickType::class, $trick);

    $form = $this->get('form.factory')->create(TrickEditType::class, $trick);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      
      $em->flush();

      $request->getSession()->getFlashBag()->add('message', 'La figure a bien été modifiée');

      return $this->redirectToRoute('st_app_home');
    }

    return $this->render('STAppBundle:Trick:edit.html.twig', array(
         'trick' => $trick,
         'form' => $form->createView(),
        
    ));
  }

  public function deleteAction(Request $request, $id)
  { 
    $em = $this->getDoctrine()->getManager();

    $trick = $em->getRepository('STAppBundle:Trick')->find($id);

    if (null === $trick) {
      throw new NotFoundHttpException("La figure d'id ".$id." n'existe pas.");
    }

    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

      $em->remove($trick);
      $em->flush();

      $request->getSession()->getFlashBag()->add('message', 'La figure a bien été supprimée');

      return $this->redirectToRoute('st_app_home');
    }

    return $this->render('STAppBundle:Trick:delete.html.twig', array(
          'trick' => $trick,
          'form'  => $form->createView(),
    ));
  }
  
}
