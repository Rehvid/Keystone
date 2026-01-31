<?php

declare(strict_types=1);

namespace Keystone\UI\Admin\Controller\Identity\User;

use Keystone\Shared\Application\Factory\AppPayloadFactory;
use Keystone\Shared\Infrastructure\Http\Response\ApiResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: 'users', name: 'users_')]
final class UserController extends AbstractController
{
    #[Route(path: '/logout', name: 'logout', methods: ['POST'])]
    public function logout(AppPayloadFactory $factory, ParameterBagInterface $parameterBag): Response
    {
        /** @var string $payloadCookieName */
        $payloadCookieName = $parameterBag->get('identity.admin.jwt_cookie_payload_name');
        /** @var string $signatureCookieName */
        $signatureCookieName = $parameterBag->get('identity.admin.jwt_cookie_payload_signature_name');

        $response = new ApiResponse($factory->successEmpty());
        $response->headers->clearCookie($payloadCookieName);
        $response->headers->clearCookie($signatureCookieName);

        return $response;
    }
}
