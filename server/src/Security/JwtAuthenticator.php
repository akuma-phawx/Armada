<?php

namespace App\Security;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Firebase\JWT\JWT;
use App\Entity\User;

class JwtAuthenticator extends AbstractGuardAuthenticator
{
    private $em;
    private $params;

    public function __construct(EntityManagerInterface $em, ContainerBagInterface $params)
    {
        $this->em = $em;
        $this->params = $params;
    }

    /*
    Whenever a user wants to access a URL or resources that need authentication, but the authentication details were not sent, this method will run. In return, we must return a Response object with a 401 status code.
    */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        $data = [
            'message' => 'Authentication Required'
        ];
        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    /*
    This method checks whether the current request supports the authentication or not. As you may know, JWT is using the Authorization header to transfer the token between server and client.
    If return false, authentication will be skipped.
    */
    public function supports(Request $request)
    {
        return $request->headers->has('Authorization');
    }

    /*
    This method returns the value of the Authorization header which is the token we return when user login.
    public 
    */
    public function getCredentials(Request $request)
    {
        return $request->headers->get('Authorization');
    }

    /*
    This method is responsible to validate JWT Token and authenticate the user by the credentials’ value which is returned from the getCredential method and it must return a User entity object or AuthenticationException.
    */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        try {
            $credentials = str_replace('Bearer ', '', $credentials);
            $jwt = (array) JWT::decode(
                $credentials,
                $this->params->get('jwt_secret'),
                ['HS256']
            );
            return $this->em->getRepository(User::class)
                ->findOneBy([
                    'email' => $jwt['user'],
                ]);
        } catch (\Exception $exception) {
            throw new AuthenticationException($exception->getMessage());
        }
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new JsonResponse([
            'message' => $exception->getMessage()
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        return;
    }

    public function supportsRememberMe()
    {
        return false;
    }
}
