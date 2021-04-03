<?php

namespace App\Service;

use App\Models\Message;
use App\Models\Session;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageService
{
    use ReturnService;

    /**
     * @var Message
     */
    private Message $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function createMessage(Session $session, Request $request): array
    {
        DB::beginTransaction();

        try {
            if ($request->has('messages')) {
                $message = $session->messages()->createMany($request->messages);
            } else {
                $message = $session->messages()->create([
                    'content' => $request->message,
                ]);
            }

            $result = $message instanceof Collection || $message instanceof Model;

            throw_if(!$result, \Exception::class, 'Não foi possível registrar a messagem!', 500);

            DB::commit();

            return $this->returnData(true, 'Messagem registrada com sucesso!', $message, 201);
        } catch (\Throwable $e) {
            DB::rollBack();

            return $this->returnData(false, $e->getMessage(), null, $e->getCode());
        }
    }
}
