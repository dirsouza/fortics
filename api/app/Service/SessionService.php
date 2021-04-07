<?php

namespace App\Service;

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

/**
 * Class SessionService
 * @package App\Service
 */
class SessionService
{
    use ReturnService;

    /**
     * @var Session
     */
    private Session $session;
    /**
     * @var MessageService
     */
    private MessageService $messageService;

    /**
     * SessionService constructor.
     * @param Session $session
     * @param MessageService $messageService
     */
    public function __construct(Session $session, MessageService $messageService)
    {
        $this->session = $session;
        $this->messageService = $messageService;
    }

    /**
     * @return array
     */
    public function getSessions(): array
    {
        try {
            $sessions = $this->session->with('messages')->allSessions()->get();

            throw_if(!$sessions->count(), \Exception::class, 'Nenhuma conversa encontrada!', 404);

            return $this->returnData(true, 'Conversas encontradas!', $sessions, 200);
        } catch (\Throwable $e) {
            return $this->returnData(false, $e->getMessage(), null, $e->getCode());
        }
    }

    /**
     * @param int $identifier
     * @return array
     */
    public function getSessionByIdentifier(int $identifier): array
    {
        try {
            $session = $this->session->findByIdentifier($identifier)->first();

            throw_if(!$session, \Exception::class, 'Nenhuma conversa encontrada!', 404);

            return $this->returnData(true, 'Conversa encontrada!', $session, 200);
        } catch (\Throwable $e) {
            return $this->returnData(false, $e->getMessage(), null, $e->getCode());
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function verifySession(Request $request): array
    {
        $session = $this->getSessionByIdentifier($request->contact_identifier);

        if ($session['success']) {
            $sessionData = $this->session->find($session['data']['id']);

            return $this->updateSession($sessionData, $request);
        }

        return $this->createSession($request);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function createSession(Request $request): array
    {
        DB::beginTransaction();

        try {
            $session = $this->session->create([
                'name'                  => $request->name,
                'platform_type'         => $request->platform_type,
                'contact_identifier'    => $request->contact_identifier,
            ]);

            throw_if(!$session->exists(), \Exception::class, 'Não foi possível registrar a conversa!', 500);

            $message = $this->messageService->createMessage($session, $request);

            throw_if(!$message['success'], \Exception::class, $message['message'], $message['code']);

            DB::commit();

            $session->message = $message['data'];

            return $this->returnData(true, 'Conversa registrada com sucesso!', $session, 201);
        } catch (\Throwable $e) {
            DB::rollBack();

            return $this->returnData(false, $e->getMessage(), null, $e->getCode());
        }
    }

    /**
     * @param Session $session
     * @param Request $request
     * @return array
     */
    public function updateSession(Session $session, Request $request): array
    {
        try {
            $message = $this->messageService->createMessage($session, $request);

            $session->message = $message['data'];

            return $this->returnData(true, 'Conversa registrada com sucesso!', $session, 201);
        } catch (\Throwable $e) {
            return $this->returnData(false, $e->getMessage(), null, $e->getCode());
        }
    }

    /**
     * @param int $identifier
     * @return array
     */
    public function deleteSession(int $identifier): array
    {
        DB::beginTransaction();

        try {
            $session = $this->session->findByIdentifier($identifier)->delete();

            throw_if(!$session, \Exception::class, 'Não foi possível excluir a conversa!', 500);

            DB::commit();

            return $this->returnData(true, 'Conversa excluída com sucesso!', null, 200);
        } catch (\Throwable $e) {
            DB::rollBack();

            return $this->returnData(false, $e->getMessage(), null, $e->getCode());
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function uploadSessions(Request $request): array
    {
        DB::beginTransaction();

        try {
            foreach ($this->genIteratorSessions($request) as $session) {
                $this->verifySession(new Request($session));
            }

            DB::commit();

            return $this->returnData(true, 'Importação concluída com sucesso!', null, 200);
        } catch (\Throwable $e) {
            DB::rollBack();

            return $this->returnData(false, $e->getMessage(), null, $e->getCode());
        }
    }

    /**
     * @param Request $request
     * @return \Generator
     */
    private function genIteratorSessions(Request $request)
    {
        foreach (json_decode($request->file, true) as $session) {
            $collectSession = collect($session)->except(['_id', 'messages']);
            $collectMessages = collect($session['messages'])->map(function ($message) {
                $message['date'] = Date::create($message['date']);
                return $message;
            });

            $collectSession['messages'] = $collectMessages;

            yield $collectSession->toArray();
        }
    }
}
