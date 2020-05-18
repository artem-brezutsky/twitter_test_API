<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Twitter;

class TwitterController extends Controller
{

    protected $tweets = [];

    /**
     * Handle the incoming request.
     * Получить все твитты
     *
     * @param Request $request
     * @return false|JsonResponse|string
     */
    public function __invoke(Request $request)
    {

        $id = $request->input('id');
        $secret = $request->input('secret');

        /**
         * Если нету какого-то из параметров
         */
        if (!$id || !$secret) {
            return response()->json([
                'error' => 'missing parameter'
            ]);
        }

        /**
         * Если не совпадают sha1
         */
        if (sha1($id) !== $secret) {
            return response()->json([
                'error' => 'access denied'
            ]);
        }

        /**
         * Авторизация в Twitter
         */
        $connect = new TwitterOAuth(
            config('services.twitter.api_key'),
            config('services.twitter.api_key_secret'),
            config('services.twitter.access_token'),
            config('services.twitter.access_token_secret')
        );

        $twitterUsername = Twitter::firstOrFail()->userName;

        if ($twitterUsername) {
            $tweets = $connect->get('statuses/user_timeline', ['screen_name' => $twitterUsername,]);

            foreach ($tweets as $key => $tweet) {
                $hashtagsArr = [];
                $this->tweets['feed'][$key]['user'] = $tweet->user->screen_name;
                $this->tweets['feed'][$key]['tweet'] = $tweet->text;

                if ($tweet->entities->hashtags) {
                    foreach ($tweet->entities->hashtags as $hkey => $hashtag) {
                        $hashtagsArr[] = $hashtag->text;
                    }
                }
                $this->tweets['feed'][$key]['hashtag'] = $hashtagsArr;
            }
            return json_encode($this->tweets);
        }

        return response()->json();
    }
}
