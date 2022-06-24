<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCasesCategoryRequest;
use App\Http\Requests\StoreCasesCategoryRequest;
use App\Http\Requests\UpdateCasesCategoryRequest;
use App\Models\CasesCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CasesCategoryController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('cases_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $casesCategories = CasesCategory::all();

        return view('frontend.casesCategories.index', compact('casesCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('cases_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.casesCategories.create');
    }

    public function store(StoreCasesCategoryRequest $request)
    {
        $casesCategory = CasesCategory::create($request->all());

        return redirect()->route('frontend.cases-categories.index');
    }

    public function edit(CasesCategory $casesCategory)
    {
        abort_if(Gate::denies('cases_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.casesCategories.edit', compact('casesCategory'));
    }

    public function update(UpdateCasesCategoryRequest $request, CasesCategory $casesCategory)
    {
        $casesCategory->update($request->all());

        return redirect()->route('frontend.cases-categories.index');
    }

    public function show(CasesCategory $casesCategory)
    {
        abort_if(Gate::denies('cases_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.casesCategories.show', compact('casesCategory'));
    }

    public function destroy(CasesCategory $casesCategory)
    {
        abort_if(Gate::denies('cases_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $casesCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyCasesCategoryRequest $request)
    {
        CasesCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
