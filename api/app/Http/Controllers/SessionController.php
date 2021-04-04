<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionRequest;
use App\Http\Requests\UploadRequest;
use App\Service\SessionService;
use Illuminate\Http\JsonResponse;

/**
 * Class SessionController
 * @package App\Http\Controllers
 */
class SessionController extends Controller
{
    use ResponseController;

    /**
     * @var SessionService
     */
    private SessionService $sessionService;

    /**
     * SessionController constructor.
     * @param SessionService $sessionService
     */
    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    /**
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        $sessions = $this->sessionService->getSessions();

        return $this->response($sessions);
    }

    /**
     * @param SessionRequest $request
     * @return JsonResponse
     */
    public function create(SessionRequest $request): JsonResponse
    {
        $session = $this->sessionService->verifySession($request);

        return $this->response($session);
    }

    /**
     * @param int $identifier
     * @return JsonResponse
     */
    public function delete(int $identifier): JsonResponse
    {
        $session = $this->sessionService->deleteSession($identifier);

        return $this->response($session);
    }

    /**
     * @param UploadRequest $request
     * @return JsonResponse
     */
    public function upload(UploadRequest $request): JsonResponse
    {
        $session = $this->sessionService->uploadSessions($request);

        return $this->response($session);
    }
}
