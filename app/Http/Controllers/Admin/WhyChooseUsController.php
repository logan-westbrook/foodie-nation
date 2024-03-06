<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\WhyChooseUsDataTable;
use App\Http\Controllers\AbstractController;
use App\Http\Requests\Admin\WhyChooseUsRequest;
use App\Models\SectionTitle;
use App\Models\WhyChooseUs;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WhyChooseUsController extends AbstractController
{
    public const string ROUTE = 'admin.why-choose-us.index';

    /**
     * Display a listing of the resource.
     */
    public function index(WhyChooseUsDataTable $dataTable)
    {
        $titles = SectionTitle::fetchSectionTitles();

        return $dataTable->render('admin.why-choose-us.index', compact('titles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.why-choose-us.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WhyChooseUsRequest $request): RedirectResponse
    {
        WhyChooseUs::create($request->validated());

        return $this->redirectSuccess(
            'Created Why Choose Us Item Successfully',
            self::ROUTE
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $whyChooseUs = WhyChooseUs::findOrFail($id);

        return view('admin.why-choose-us.edit', compact('whyChooseUs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        WhyChooseUsRequest $request,
        string $id
    ): RedirectResponse {
        WhyChooseUs::findOrFail($id)->update($request->validated());

        return $this->redirectSuccess(
            'Why Choose Us Item Edit Successful',
            self::ROUTE
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateTitles(Request $request): RedirectResponse
    {
        $request->validate([
            'why_choose_top_title' => [ 'max:100' ],
            'why_choose_main_title' => [ 'max:200' ],
            'why_choose_sub_title' => [ 'max:500' ],
        ]);

        SectionTitle::updateTitlesFromRequest($request);
        toastr()->success('Updated Successfully');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        return $this->delete($id);
    }

    protected static function deleteEntity(string $id): void
    {
        WhyChooseUs::findOrFail($id)->delete();
    }
}
