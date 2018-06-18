<?php

namespace ST\UserBundle\Controller;

use ST\UserBundle\Entity\User;
use ST\UserBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends Controller
{
  public function loginAction(Request $request)
  {
    // Si le visiteur est déjà identifié, on le redirige vers l'accueil
    if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
      return $this->redirectToRoute('st_app_home');
    }

    // Le service authentication_utils permet de récupérer le nom d'utilisateur
    // et l'erreur dans le cas où le formulaire a déjà été soumis mais était invalide
    // (mauvais mot de passe par exemple)
    $authenticationUtils = $this->get('security.authentication_utils');

    return $this->render('STUserBundle:Security:login.html.twig', array(
      'last_username' => $authenticationUtils->getLastUsername(),
      'error'         => $authenticationUtils->getLastAuthenticationError(),
    ));
  }

  public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
  {
    $user = new User();

    $form = $this->createForm(UserType::class, $user);

    if($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

      $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
      $user->setPassword($password);

      $em = $this->getDoctrine()->getManager();
      $em->persist($user);
      $em->flush();

      $request->getSession()->getFlashBag()->add('message', 'Votre compte a bien été enregistré, vous pouvez désormais vous connecter.');

      return $this->redirectToRoute('st_app_home');
    }

    return $this->render('STUserBundle:Security:register.html.twig', array(
        'form' => $form->createView(),
    ));
  }

  public function profileAction()
  {
    return $this->render('STUserBundle:Security:profile.html.twig');

  }
}
