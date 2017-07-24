<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 23/07/17
 * Time: 19:09
 */
namespace AppBundle\Security;


use ConsumerBundle\Entity\Consumer;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use JMS\Serializer\Serializer;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class FacebookUserProvider implements UserProviderInterface

{
    private $client;
    private $serializer;
    private $doctrine;

    public function __construct(Client $client, Serializer $serializer, $doctrine)
    {
        $this->client = $client;
        $this->serializer = $serializer;
        $this->doctrine = $doctrine;
    }


    public function loadUserByUsername($username)
    {
        if (!isset($username) || $username === NULL){
            throw new BadCredentialsException('Vous devez vous identifer sur cette API.');
        }
        $url = 'https://graph.facebook.com/me?access_token='.$username;

        try{
            $response = $this->client->get($url);
        } catch (RequestException $e){
            throw new BadCredentialsException('Impossible de récupérer vos informations depuis Facebook.');
        }

        $res = $response->getBody()->getContents();
        $userData = $this->serializer->deserialize($res, 'array', 'json');

        if (!$userData) {
            throw new BadCredentialsException('Impossible de récupérer vos informations depuis Facebook.');
        }

        $repo = $this->doctrine->getManager()->getRepository('ConsumerBundle:Consumer');
        $consumer = $repo->findOneBy(['facebookId' => $userData['id']]);

        return $consumer;
    }

    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException();
        }

        return $user;
    }

    public function supportsClass($class)
    {
        return 'ConsumerBundle\Entity\Consumer' === $class;
    }
}
