<?php

namespace App\Http\Controllers;

use App\Http\Requests\SessionRequest;
use App\Http\Requests\UploadRequest;
use App\Service\SessionService;
use Illuminate\Http\JsonResponse;

class SessionController extends Controller
{
    use ResponseController;

    private SessionService $sessionService;

    public function __construct(SessionService $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    public function list(): JsonResponse
    {
        $sessions = $this->sessionService->getSessions();

        return $this->response($sessions);
    }

    public function create(SessionRequest $request): JsonResponse
    {
        $session = $this->sessionService->verifySession($request);

        return $this->response($session);
    }

    public function delete(int $identifier): JsonResponse
    {
        $session = $this->sessionService->deleteSession($identifier);

        return $this->response($session);
    }

    public function upload(UploadRequest $request): JsonResponse
    {
        $session = $this->sessionService->uploadSessions($request);

        return $this->response($session);
    }
}
