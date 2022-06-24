<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCasesCategoryRequest;
use App\Http\Requests\UpdateCasesCategoryRequest;
use App\Http\Resources\Admin\CasesCategoryResource;
use App\Models\CasesCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CasesCategoryApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cases_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CasesCategoryResource(CasesCategory::all());
    }

    public function store(StoreCasesCategoryRequest $request)
    {
        $casesCategory = CasesCategory::create($request->all());

        return (new CasesCategoryResource($casesCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CasesCategory $casesCategory)
    {
        abort_if(Gate::denies('cases_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CasesCategoryResource($casesCategory);
    }

    public function update(UpdateCasesCategoryRequest $request, CasesCategory $casesCategory)
    {
        $casesCategory->update($request->all());

        return (new CasesCategoryResource($casesCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CasesCategory $casesCategory)
    {
        abort_if(Gate::denies('cases_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $casesCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
