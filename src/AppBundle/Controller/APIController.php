<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


/**
 * @Route("api")
 */
class APIController extends Controller {
    /**
     * @Route("/login", name="app_api_login")
     * @Method("POST")
     */
    public function loginAction(Request $request) {
        $user = $this->get('fos_user.user_manager')->findUserByUsername($request->request->get('username'));
        if ($user && $this->get('security.password_encoder')->isPasswordValid($user, $request->request->get('password'))) {
            $objectNormalizer = new ObjectNormalizer();
            $objectNormalizer->setCircularReferenceHandler(function ($object) {
                return $object->getId();
            });
            $serializer = new Serializer([new DateTimeNormalizer(), $objectNormalizer]);
            return new JsonResponse($serializer->normalize($user));
        }
        return new Response(null, Response::HTTP_UNAUTHORIZED);
    }
    /**
     * @Route("/register", name="app_api_register")
     * @Method("POST")
     */
    public function registerAction(Request $request) {
        $userManager = $this->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $user->setEnabled(1);
        $user->setNom($request->request->get('nom'));
        $user->setUsername($request->request->get('username'));
        $user->setPlainPassword($request->request->get('password'));
        $user->setEmail($request->request->get('email'));
        $user->setRoles(array('ELEVE'));

        // Add The Rest ...
        $userManager->updateUser($user);
        $serializer = new Serializer([new DateTimeNormalizer(), new ObjectNormalizer]);
        return new JsonResponse($serializer->normalize($user));
    }
}
