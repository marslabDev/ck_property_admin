<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCasesCategoryRequest;
use App\Http\Requests\StoreCasesCategoryRequest;
use App\Http\Requests\UpdateCasesCategoryRequest;
use App\Models\CasesCategory;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CasesCategoryController extends Controller
{
    use CsvImportTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('cases_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CasesCategory::with(['created_by'])->select(sprintf('%s.*', (new CasesCategory())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'cases_category_show';
                $editGate = 'cases_category_edit';
                $deleteGate = 'cases_category_delete';
                $crudRoutePart = 'cases-categories';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $users = User::get();

        return view('admin.casesCategories.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('cases_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.casesCategories.create');
    }

    public function store(StoreCasesCategoryRequest $request)
    {
        $casesCategory = CasesCategory::create($request->all());

        return redirect()->route('admin.cases-categories.index');
    }

    public function edit(CasesCategory $casesCategory)
    {
        abort_if(Gate::denies('cases_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $casesCategory->load('created_by');

        return view('admin.casesCategories.edit', compact('casesCategory'));
    }

    public function update(UpdateCasesCategoryRequest $request, CasesCategory $casesCategory)
    {
        $casesCategory->update($request->all());

        return redirect()->route('admin.cases-categories.index');
    }

    public function show(CasesCategory $casesCategory)
    {
        abort_if(Gate::denies('cases_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $casesCategory->load('created_by');

        return view('admin.casesCategories.show', compact('casesCategory'));
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
