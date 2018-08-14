<?php

namespace App\Http\Controllers;

/**
 * Class LanguageController.
 */
class LanguageController extends Controller
{
    /**
     * @param $locale
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke($locale)
    {
        if (array_key_exists($locale, config('locale.languages'))) {
            // $locale_history = \Cookie::get('locale_history');

            session()->put('locale', $locale);
            \Cookie::queue(\Cookie::make('locale_history', $locale, 1051200));

            // session()->put('locale', $locale);
            
        }

        return redirect()->back();
    }
}
