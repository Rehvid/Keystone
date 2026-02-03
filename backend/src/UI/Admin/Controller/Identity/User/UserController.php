<?php

declare(strict_types=1);

namespace Keystone\UI\Admin\Controller\Identity\User;

use Keystone\Shared\Application\Enum\StatusPayload;
use Keystone\Shared\Application\Factory\AppPayloadFactory;
use Keystone\Shared\Application\Response\AppPayload;
use Keystone\Shared\Infrastructure\Http\Response\ApiResponse;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route(path: 'users', name: 'users_')]
final class UserController extends AbstractController
{
    #[Route(path: '/logout', name: 'logout', methods: ['POST'])]
    #[OA\Post(
        description: 'Clears authentication cookies and logs out the user',
        summary: 'Logout user',
        security: [
            ['adminJwtCookiePayload' => [], 'adminJwtCookieSignature' => []],
        ],
        tags: ['Admin / Identity'],
    )]
    #[OA\Response(
        response: 200,
        description: 'Successfully logged out',
        content: new OA\JsonContent(
            ref: new Model(type: AppPayload::class),
            example: [
                'status' => StatusPayload::SUCCESS_EMPTY,
                'meta' => [
                    'timestamp' => '2026-02-03T12:00:00+01:00',
                    'requestId' => '019c2173-9dbc-7c6d-b244-d29699fd595e',
                ],
            ],
        ),
    )]
    #[OA\Response(ref: '#/components/responses/AdminUnauthorized', response: 401)]
    public function logout(AppPayloadFactory $factory, ParameterBagInterface $parameterBag): Response
    {
        /** @var string $payloadCookieName */
        $payloadCookieName = $parameterBag->get('identity.admin.jwt_cookie_payload_name');
        /** @var string $signatureCookieName */
        $signatureCookieName = $parameterBag->get('identity.admin.jwt_cookie_signature_name');

        $response = new ApiResponse($factory->successEmpty());
        $response->headers->clearCookie($payloadCookieName);
        $response->headers->clearCookie($signatureCookieName);

        return $response;
    }
}
