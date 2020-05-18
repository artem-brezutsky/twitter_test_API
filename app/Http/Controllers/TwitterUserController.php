<?php

namespace App\Http\Controllers;

use App\Twitter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TwitterUserController extends Controller
{
    /**
     * Добавление пользователя
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addTwitterUserName(Request $request): JsonResponse
    {
        $id = $request->input('id');
        $user = $request->input('user');
        $secret = $request->input('secret');

        /*
         * Есди нету какого либо из параметров
         */
        if (!$id || !$user || !$secret) {
            return response()->json([
                'error' => 'missing parameter'
            ]);
        }

        /*
         * Проверка security layer
         * если sha1(id,user) = request.secret
         * то доступ разрешен
         */
        if (sha1($id . $user) === $secret) {
            $userList = Twitter::all();
            if ($userList->isEmpty()) {
                $twitterUser = new Twitter([
                    'userName' => $user
                ]);
                $twitterUser->save();

                return response()->json();
            }

            return response()->json([
                'error' => 'user is already added'
            ]);

        }

        return response()->json([
            'error' => 'access denied'
        ]);
    }

    /**
     * Удаление пользователя
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function removeTwitterUserName(Request $request): JsonResponse
    {
        $id = $request->input('id');
        $user = $request->input('user');
        $secret = $request->input('secret');

        if (!$id || !$user || !$secret) {
            return response()->json([
                'error' => 'missing parameter'
            ]);
        }
        /*
         * Проверка security layer
         * если sha1(id,user) = request.secret
         * то доступ разрешен
         */
        if ($user !== Twitter::firstOrFail()->userName) {
            return response()->json([
                'error' => 'internal error'
            ]);
        }
        if (sha1($id . $user) === $secret) {
            $userList = Twitter::all();
            if ($userList->isEmpty()) {
                return response()->json([
                    'error' => 'user not added'
                ]);
            }

            $twitterUser = Twitter::all();
            Twitter::destroy($twitterUser->first()->id);

            return response()->json();

        }

        return response()->json([
            'error' => 'access denied'
        ]);
    }
}
