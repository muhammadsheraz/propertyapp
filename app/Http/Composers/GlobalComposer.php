<?php

namespace App\Http\Composers;
use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

use App\Models\Auth\User;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;

use Illuminate\View\View;

/**
 * Class GlobalComposer.
 */
class GlobalComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose(View $view)
    {
        global $request;

        ## CMS Pages
        $sql = "SELECT * FROM pages WHERE 1 = 1";
        $pages_rs = DB::select($sql);
        
        if (!empty($pages_rs)) {
            foreach ($pages_rs as $page) {
                $pages[$page->slug] = $page;
            }
        }

        $unreadNotifications = !empty(auth()->user()->unreadNotifications) ? auth()->user()->unreadNotifications : []; 

        $uri = $request->path();
        $request_input = $request->all();

        $top_cities_sql = 'SELECT count(p.id) AS property_count, p.city_id AS city_id, c.city_name AS city_name
                        FROM properties p
                        LEFT JOIN cities c
                        ON p.city_id = c.id 
                        GROUP BY p.city_id
                        ORDER BY property_count DESC
                        LIMIT 0,3';
        
        $top_cities = DB::select($top_cities_sql);

        $property_types_sql = 'SELECT * FROM property_types WHERE status="' . config('app.active'). '"';
        
        $property_types = DB::select($property_types_sql);

        $messages = [];

        if (!empty(auth()->user()->id)) {
            if (auth()->user()->hasRole('broker')) {
                $broker_id = auth()->user()->id;
                $messages = $this->getUnreadMessages($broker_id);
            } 
        }

        $locale_history = \Cookie::get('locale_history');

        if (!empty($locale_history)) {
            session()->put('locale', $locale_history);
        } else {
            $locale = session()->get('locale');
            \Cookie::queue(\Cookie::make('locale_history', $locale, 1051200));
        }   
        
        ## Setting Localization
        // setlocale(LC_ALL, 'ar.utf8');
        setlocale(LC_ALL, app()->getLocale() . '.utf8');
        // setlocale(LC_ALL, 'ru_AE.utf8');
        // setlocale(LC_ALL, 'ar_AE.utf8');
        // setlocale(LC_ALL, 'ar_AE.utf8');
        // setlocale(LC_ALL, 'ar_AE.utf8');


        $view
        ->with('pages', $pages)
        ->with('current_uri', $uri)
        ->with('request_input', $request_input)
        ->with('property_types', $property_types)
        ->with('logged_in_user', auth()->user())
        ->with('top_cities', $top_cities)
        ->with('local_lang', app()->getLocale())
        ->with('messages', $messages)
        ->with('notifications', $unreadNotifications);
    }

    private function getUnreadMessages($broker_id) {
        $messages = [];
        $threads = Thread::forUserWithNewMessages($broker_id)->latest('updated_at')->get();

        if (!$threads->isEmpty()) {
            foreach ($threads as $thread) {
                foreach ($thread->userUnreadMessages($broker_id) as $message) {
                    $message->user_data = User::find($message->user_id)->only('id','fullname','email','phone_no','mobile_no','broker_no', 'customer_no', 'avatar_location');
                    $messages[] = $message;
                }
            }
        }

        return array_reverse($messages);
    }    
}
