<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\OtherSetting;use Illuminate\Http\Request;

class OthersController extends Controller
{
    public function termsCondition()
    {
        $termsCondition = OtherSetting::where('category', 'terms_condition')->first();
        return view('user.pages.termsCondition.termsCondition', compact('termsCondition'));
    }

    public function privacyPolicy()
    {
        $privacyPolicy = OtherSetting::where('category', 'privacy_policy')->first();
        return view('user.pages.privacyPolicy.privacyPolicy', compact('privacyPolicy'));
    }

    public function returnPolicy()
    {
        $returnPolicy = OtherSetting::where('category', 'return_policy')->first();
        return view('user.pages.returnPolicy.returnPolicy', compact('returnPolicy'));
    }

    public function FAQ()
    {
        $faq = OtherSetting::where('category', 'faq')->first();
        return view('user.pages.faq.faq', compact('faq'));
    }

    public function aboutUs()
    {
        $aboutUs = OtherSetting::where('category', 'about')->first();
        return view('user.pages.about.about', compact('aboutUs'));
    }
}
