<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyIncomeSourceRequest;
use App\Http\Requests\StoreIncomeSourceRequest;
use App\Http\Requests\UpdateIncomeSourceRequest;
use App\Models\IncomeSource;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IncomeSourceController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('income_source_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incomeSources = IncomeSource::with(['created_by'])->get();

        $users = User::get();

        return view('frontend.incomeSources.index', compact('incomeSources', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('income_source_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.incomeSources.create');
    }

    public function store(StoreIncomeSourceRequest $request)
    {
        $incomeSource = IncomeSource::create($request->all());

        return redirect()->route('frontend.income-sources.index');
    }

    public function edit(IncomeSource $incomeSource)
    {
        abort_if(Gate::denies('income_source_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incomeSource->load('created_by');

        return view('frontend.incomeSources.edit', compact('incomeSource'));
    }

    public function update(UpdateIncomeSourceRequest $request, IncomeSource $incomeSource)
    {
        $incomeSource->update($request->all());

        return redirect()->route('frontend.income-sources.index');
    }

    public function show(IncomeSource $incomeSource)
    {
        abort_if(Gate::denies('income_source_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incomeSource->load('created_by');

        return view('frontend.incomeSources.show', compact('incomeSource'));
    }

    public function destroy(IncomeSource $incomeSource)
    {
        abort_if(Gate::denies('income_source_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incomeSource->delete();

        return back();
    }

    public function massDestroy(MassDestroyIncomeSourceRequest $request)
    {
        IncomeSource::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
