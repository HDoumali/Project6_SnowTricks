<?php

namespace ST\AppBundle\Controller;

use ST\AppBundle\Entity\Trick;
use ST\AppBundle\Form\VideoEditType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class VideoController extends Controller
{

  public function editAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    
    $video = $em->getRepository('STAppBundle:Video')->find($id);

    if (null === $video) {
      throw new NotFoundHttpException("La video d'id ".$id." n'existe pas.");
    }

    $form = $this->get('form.factory')->create(VideoEditType::class, $video);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

      $slug = $video->getTrick()->getSlug();

      $em->flush();

      $request->getSession()->getFlashBag()->add('video', 'La vidéo a bien été modifiée.');

      return $this->redirectToRoute('st_app_view', array('slug' => $slug));
    }

    return $this->render('STAppBundle:Trick:editVideo.html.twig', array(
         'video' => $video,
         'form' => $form->createView(),
    ));
  }

  public function deleteAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();
   
    $video = $em->getRepository('STAppBundle:Video')->find($id);
    $slug = $video->getTrick()->getSlug();

    if(null === $video) {
      throw new NotFoundHttpException("La video d'id ".$id." n'existe pas.");
    }

    $form = $this->get('form.factory')->create();

    if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

      $em->remove($video);
      $em->flush();

      $request->getSession()->getFlashBag()->add('video', 'La video a bien été supprimée.');

      return $this->redirectToRoute('st_app_view', array('slug' => $slug));
    }

    return $this->render('STAppBundle:Trick:deleteVideo.html.twig', array(
          'video' => $video,
          'form' => $form->createView(),
    ));
  }

}
