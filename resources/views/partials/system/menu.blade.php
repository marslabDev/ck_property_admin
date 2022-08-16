<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand">
        <a class="c-sidebar-brand-full h5 text-center tw-pb-1" href="{{ route('system.home') }}">
            <img src="{{ asset('img/LOGO_STRAQTA_WHITE.svg') }}" alt="Straqta Logo" class="tw-px-4 tw-py-2 tw-w-1/2 tw-mx-auto" />
            <hr class="tw-bg-slate-400 tw-my-2 tw-mx-4">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route('system.home') }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">
                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('audit_log_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('system.audit-logs.index') }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.auditLog.title') }}
                </a>
            </li>
        @endcan
       
        @can('house_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/*/streets*") ? "c-show" : "" }} {{ request()->is("admin/*/parking-lots*") ? "c-show" : "" }} {{ request()->is("admin/*/house-types*") ? "c-show" : "" }} {{ request()->is("admin/*/manage-houses*") ? "c-show" : "" }} {{ request()->is("admin/*/manage-prices*") ? "c-show" : "" }} {{ request()->is("admin/*/house-statuses*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-home c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.houseManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('house_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('system.house-types.index') }}" class="c-sidebar-nav-link {{ request()->is("admin/*/house-types") || request()->is("admin/*/house-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-grip-horizontal c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.houseType.title') }}
                            </a>
                        </li>
                    @endcan
                   
                    {{-- @can('house_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.house-statuses.index', [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/*/house-statuses") || request()->is("admin/*/house-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.houseStatus.title') }}
                            </a>
                        </li>
                    @endcan --}}
                </ul>
            </li>
        @endcan

        {{-- @can('other_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/maintanances*") ? "c-show" : "" }} {{ request()->is("admin/maintanance-types*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.other.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('maintanance_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.maintanances.index', [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/maintanances") || request()->is("admin/maintanances/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-sync-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.maintanance.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('maintanance_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.maintanance-types.index', [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/maintanance-types") || request()->is("admin/maintanance-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-certificate c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.maintananceType.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan --}}

        {{-- @can('complaint_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/my-cases*") ? "c-show" : "" }} {{ request()->is("admin/complaints*") ? "c-show" : "" }} {{ request()->is("admin/case-statuses*") ? "c-show" : "" }} {{ request()->is("admin/cases-categories*") ? "c-show" : "" }} {{ request()->is("admin/complaint-statuses*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-exclamation-circle c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.complaintManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('case_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.case-statuses.index', [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/case-statuses") || request()->is("admin/case-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.caseStatus.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('cases_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.cases-categories.index', [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/cases-categories") || request()->is("admin/cases-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.casesCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('complaint_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.complaint-statuses.index', [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/complaint-statuses") || request()->is("admin/complaint-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.complaintStatus.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        @can('client_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/clients*") ? "c-show" : "" }} {{ request()->is("admin/projects*") ? "c-show" : "" }} {{ request()->is("admin/open-projects*") ? "c-show" : "" }} {{ request()->is("admin/notes*") ? "c-show" : "" }} {{ request()->is("admin/documents*") ? "c-show" : "" }} {{ request()->is("admin/supplier-proposals*") ? "c-show" : "" }} {{ request()->is("admin/transactions*") ? "c-show" : "" }} {{ request()->is("admin/client-reports*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">
                        
                    </i>
                    {{ trans('cruds.clientManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('client_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.clients.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/clients") || request()->is("admin/clients/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user-plus c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.client.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('project_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.projects.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/projects") || request()->is("admin/projects/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.project.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('open_project_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.open-projects.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/open-projects") || request()->is("admin/open-projects/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.openProject.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('note_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.notes.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/notes") || request()->is("admin/notes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-sticky-note c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.note.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('document_access')
                        <li class="c-sidebar-nav-item d-none">
                            <a href="{{ route("admin.documents.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/documents") || request()->is("admin/documents/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.document.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('supplier_proposal_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.supplier-proposals.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/supplier-proposals") || request()->is("admin/supplier-proposals/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-contract c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.supplierProposal.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('transaction_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.transactions.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/transactions") || request()->is("admin/transactions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-exchange-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.transaction.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('client_report_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.client-reports.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/client-reports") || request()->is("admin/client-reports/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-chart-line c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.clientReport.title') }}
                            </a>
                        </li>
                    @endcan

                    @can('task_management_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/task-statuses*") ? "c-show" : "" }} {{ request()->is("admin/task-tags*") ? "c-show" : "" }} {{ request()->is("admin/tasks*") ? "c-show" : "" }} {{ request()->is("admin/tasks-calendars*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.taskManagement.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('task_status_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.task-statuses.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/task-statuses") || request()->is("admin/task-statuses/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.taskStatus.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('task_tag_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.task-tags.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/task-tags") || request()->is("admin/task-tags/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.taskTag.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('task_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.tasks.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/tasks") || request()->is("admin/tasks/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.task.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('tasks_calendar_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.tasks-calendars.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/tasks-calendars") || request()->is("admin/tasks-calendars/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-calendar c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.tasksCalendar.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan

                    @can('client_management_setting_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/transaction-types*") ? "c-show" : "" }} {{ request()->is("admin/income-sources*") ? "c-show" : "" }} {{ request()->is("admin/client-statuses*") ? "c-show" : "" }} {{ request()->is("admin/project-statuses*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-cog c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.clientManagementSetting.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items">
                                @can('transaction_type_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.transaction-types.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/transaction-types") || request()->is("admin/transaction-types/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-money-check c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.transactionType.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('income_source_access d-none')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.income-sources.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/income-sources") || request()->is("admin/income-sources/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-database c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.incomeSource.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('client_status_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.client-statuses.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/client-statuses") || request()->is("admin/client-statuses/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.clientStatus.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('project_status_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.project-statuses.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/project-statuses") || request()->is("admin/project-statuses/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.projectStatus.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        @can('asset_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/asset-categories*") ? "c-show" : "" }} {{ request()->is("admin/asset-locations*") ? "c-show" : "" }} {{ request()->is("admin/asset-statuses*") ? "c-show" : "" }} {{ request()->is("admin/assets*") ? "c-show" : "" }} {{ request()->is("admin/assets-histories*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-warehouse c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.assetManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('asset_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.asset-categories.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/asset-categories") || request()->is("admin/asset-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tags c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('asset_location_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.asset-locations.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/asset-locations") || request()->is("admin/asset-locations/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-map-marker c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetLocation.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('asset_status_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.asset-statuses.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/asset-statuses") || request()->is("admin/asset-statuses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-server c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetStatus.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('asset_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.assets.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/assets") || request()->is("admin/assets/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-book c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.asset.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('assets_history_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.assets-histories.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/assets-histories") || request()->is("admin/assets-histories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-th-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.assetsHistory.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        @can('payment_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/payment-items*") ? "c-show" : "" }} {{ request()->is("admin/payment-charges*") ? "c-show" : "" }} {{ request()->is("admin/payment-plans*") ? "c-show" : "" }} {{ request()->is("admin/payment-types*") ? "c-show" : "" }} {{ request()->is("admin/payment-histories*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-money-bill-wave c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.paymentManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('payment_item_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.payment-items.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/payment-items") || request()->is("admin/payment-items/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-list-ol c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.paymentItem.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('payment_charge_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.payment-charges.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/payment-charges") || request()->is("admin/payment-charges/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-percent c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.paymentCharge.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('payment_plan_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.payment-plans.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/payment-plans") || request()->is("admin/payment-plans/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-invoice-dollar c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.paymentPlan.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('payment_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.payment-types.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/payment-types") || request()->is("admin/payment-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-credit-card c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.paymentType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('payment_history_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.payment-histories.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/payment-histories") || request()->is("admin/payment-histories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-history c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.paymentHistory.title') }}
                            </a>
                        </li>
                    @endcan

                    @can('currency_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.currencies.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/currencies") || request()->is("admin/currencies/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-money-bill c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.currency.title') }}
                            </a>
                        </li>
                    @endcan

                </ul>
            </li>
        @endcan
        
        @can('expense_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/expense-categories*") ? "c-show" : "" }} {{ request()->is("admin/income-categories*") ? "c-show" : "" }} {{ request()->is("admin/expenses*") ? "c-show" : "" }} {{ request()->is("admin/incomes*") ? "c-show" : "" }} {{ request()->is("admin/expense-reports*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-money-bill c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.expenseManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('expense_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.expense-categories.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/expense-categories") || request()->is("admin/expense-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.expenseCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('income_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.income-categories.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/income-categories") || request()->is("admin/income-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.incomeCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('expense_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.expenses.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/expenses") || request()->is("admin/expenses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-arrow-circle-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.expense.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('income_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.incomes.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/incomes") || request()->is("admin/incomes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-arrow-circle-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.income.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('expense_report_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.expense-reports.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/expense-reports") || request()->is("admin/expense-reports/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-chart-line c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.expenseReport.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        @can('time_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/time-work-types*") ? "c-show" : "" }} {{ request()->is("admin/time-projects*") ? "c-show" : "" }} {{ request()->is("admin/time-entries*") ? "c-show" : "" }} {{ request()->is("admin/time-reports*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-clock c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.timeManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('time_work_type_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.time-work-types.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/time-work-types") || request()->is("admin/time-work-types/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-th c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.timeWorkType.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('time_project_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.time-projects.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/time-projects") || request()->is("admin/time-projects/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.timeProject.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('time_entry_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.time-entries.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/time-entries") || request()->is("admin/time-entries/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.timeEntry.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('time_report_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.time-reports.index", [currentArea()]) }}" class="c-sidebar-nav-link {{ request()->is("admin/time-reports") || request()->is("admin/time-reports/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-chart-line c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.timeReport.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        @can('setting_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/currencies*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.setting.title') }}
                </a>
               
            </li>
        @endcan --}}

        @php($unread = \App\Models\QaTopic::unreadCount())
            {{-- <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.messenger.index", [currentArea()]) }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "c-active" : "" }} c-sidebar-nav-link">
                    <i class="c-sidebar-nav-icon fa-fw fa fa-envelope">

                    </i>
                    <span>{{ trans('global.messages') }}</span>
                    @if($unread > 0)
                        <strong>( {{ $unread }} )</strong>
                    @endif

                </a>
            </li> --}}
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>