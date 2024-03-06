<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SectionTitle;
use App\Models\Slider;
use App\Models\WhyChooseUs;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index(): View
    {
        $sliders = Slider::where('status', 1)->get();
        $titles = SectionTitle::fetchSectionTitles();
        $whyChooseUs = WhyChooseUs::where('status', 1)->get();

        return view(
            'frontend.home.index',
            compact('sliders', 'titles', 'whyChooseUs')
        );
    }
}
