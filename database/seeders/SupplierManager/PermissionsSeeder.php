<?php

namespace Database\Seeders\SupplierManager;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 95,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 130,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 131,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 132,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 133,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 134,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 135,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 136,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 137,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 138,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 139,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 140,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 141,
                'title' => 'task_create',
            ],
            [
                'id'    => 142,
                'title' => 'task_edit',
            ],
            [
                'id'    => 143,
                'title' => 'task_show',
            ],
            [
                'id'    => 144,
                'title' => 'task_delete',
            ],
            [
                'id'    => 145,
                'title' => 'task_access',
            ],
            [
                'id'    => 146,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 168,
                'title' => 'client_management_setting_access',
            ],
            [
                'id'    => 169,
                'title' => 'currency_create',
            ],
            [
                'id'    => 170,
                'title' => 'currency_edit',
            ],
            [
                'id'    => 171,
                'title' => 'currency_show',
            ],
            [
                'id'    => 172,
                'title' => 'currency_delete',
            ],
            [
                'id'    => 173,
                'title' => 'currency_access',
            ],
            [
                'id'    => 174,
                'title' => 'transaction_type_create',
            ],
            [
                'id'    => 175,
                'title' => 'transaction_type_edit',
            ],
            [
                'id'    => 176,
                'title' => 'transaction_type_show',
            ],
            [
                'id'    => 177,
                'title' => 'transaction_type_delete',
            ],
            [
                'id'    => 178,
                'title' => 'transaction_type_access',
            ],
            [
                'id'    => 179,
                'title' => 'income_source_create',
            ],
            [
                'id'    => 180,
                'title' => 'income_source_edit',
            ],
            [
                'id'    => 181,
                'title' => 'income_source_show',
            ],
            [
                'id'    => 182,
                'title' => 'income_source_delete',
            ],
            [
                'id'    => 183,
                'title' => 'income_source_access',
            ],
            [
                'id'    => 184,
                'title' => 'client_status_create',
            ],
            [
                'id'    => 185,
                'title' => 'client_status_edit',
            ],
            [
                'id'    => 186,
                'title' => 'client_status_show',
            ],
            [
                'id'    => 187,
                'title' => 'client_status_delete',
            ],
            [
                'id'    => 188,
                'title' => 'client_status_access',
            ],
            [
                'id'    => 189,
                'title' => 'project_status_create',
            ],
            [
                'id'    => 190,
                'title' => 'project_status_edit',
            ],
            [
                'id'    => 191,
                'title' => 'project_status_show',
            ],
            [
                'id'    => 192,
                'title' => 'project_status_delete',
            ],
            [
                'id'    => 193,
                'title' => 'project_status_access',
            ],
            [
                'id'    => 194,
                'title' => 'client_management_access',
            ],
            [
                'id'    => 195,
                'title' => 'client_create',
            ],
            [
                'id'    => 196,
                'title' => 'client_edit',
            ],
            [
                'id'    => 197,
                'title' => 'client_show',
            ],
            [
                'id'    => 198,
                'title' => 'client_delete',
            ],
            [
                'id'    => 199,
                'title' => 'client_access',
            ],
            [
                'id'    => 200,
                'title' => 'project_create',
            ],
            [
                'id'    => 201,
                'title' => 'project_edit',
            ],
            [
                'id'    => 202,
                'title' => 'project_show',
            ],
            [
                'id'    => 203,
                'title' => 'project_delete',
            ],
            [
                'id'    => 204,
                'title' => 'project_access',
            ],
            [
                'id'    => 205,
                'title' => 'note_create',
            ],
            [
                'id'    => 206,
                'title' => 'note_edit',
            ],
            [
                'id'    => 207,
                'title' => 'note_show',
            ],
            [
                'id'    => 208,
                'title' => 'note_delete',
            ],
            [
                'id'    => 209,
                'title' => 'note_access',
            ],
            [
                'id'    => 210,
                'title' => 'document_create',
            ],
            [
                'id'    => 211,
                'title' => 'document_edit',
            ],
            [
                'id'    => 212,
                'title' => 'document_show',
            ],
            [
                'id'    => 213,
                'title' => 'document_delete',
            ],
            [
                'id'    => 214,
                'title' => 'document_access',
            ],
            [
                'id'    => 215,
                'title' => 'transaction_create',
            ],
            [
                'id'    => 216,
                'title' => 'transaction_show',
            ],
            [
                'id'    => 217,
                'title' => 'transaction_access',
            ],
            [
                'id'    => 218,
                'title' => 'client_report_create',
            ],
            [
                'id'    => 219,
                'title' => 'client_report_edit',
            ],
            [
                'id'    => 220,
                'title' => 'client_report_show',
            ],
            [
                'id'    => 221,
                'title' => 'client_report_delete',
            ],
            [
                'id'    => 222,
                'title' => 'client_report_access',
            ],
            [
                'id'    => 287,
                'title' => 'open_project_create',
            ],
            [
                'id'    => 288,
                'title' => 'open_project_edit',
            ],
            [
                'id'    => 289,
                'title' => 'open_project_show',
            ],
            [
                'id'    => 290,
                'title' => 'open_project_delete',
            ],
            [
                'id'    => 291,
                'title' => 'open_project_access',
            ],
            [
                'id'    => 292,
                'title' => 'supplier_proposal_create',
            ],
            [
                'id'    => 293,
                'title' => 'supplier_proposal_edit',
            ],
            [
                'id'    => 294,
                'title' => 'supplier_proposal_show',
            ],
            [
                'id'    => 295,
                'title' => 'supplier_proposal_delete',
            ],
            [
                'id'    => 296,
                'title' => 'supplier_proposal_access',
            ],
            [
                'id'    => 297,
                'title' => 'profile_password_edit',
            ],
        ];

        Role::findOrFail(3)->permissions()->sync(array_column($permissions, 'id'));
    }
}
