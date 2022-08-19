<?php

namespace Database\Seeders\SupplierManager;

use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 95,
                'name' => 'user_alert_show',
            ],
            [
                'id'    => 130,
                'name' => 'task_management_access',
            ],
            [
                'id'    => 131,
                'name' => 'task_status_create',
            ],
            [
                'id'    => 132,
                'name' => 'task_status_edit',
            ],
            [
                'id'    => 133,
                'name' => 'task_status_show',
            ],
            [
                'id'    => 134,
                'name' => 'task_status_delete',
            ],
            [
                'id'    => 135,
                'name' => 'task_status_access',
            ],
            [
                'id'    => 136,
                'name' => 'task_tag_create',
            ],
            [
                'id'    => 137,
                'name' => 'task_tag_edit',
            ],
            [
                'id'    => 138,
                'name' => 'task_tag_show',
            ],
            [
                'id'    => 139,
                'name' => 'task_tag_delete',
            ],
            [
                'id'    => 140,
                'name' => 'task_tag_access',
            ],
            [
                'id'    => 141,
                'name' => 'task_create',
            ],
            [
                'id'    => 142,
                'name' => 'task_edit',
            ],
            [
                'id'    => 143,
                'name' => 'task_show',
            ],
            [
                'id'    => 144,
                'name' => 'task_delete',
            ],
            [
                'id'    => 145,
                'name' => 'task_access',
            ],
            [
                'id'    => 146,
                'name' => 'tasks_calendar_access',
            ],
            [
                'id'    => 168,
                'name' => 'client_management_setting_access',
            ],
            [
                'id'    => 169,
                'name' => 'currency_create',
            ],
            [
                'id'    => 170,
                'name' => 'currency_edit',
            ],
            [
                'id'    => 171,
                'name' => 'currency_show',
            ],
            [
                'id'    => 172,
                'name' => 'currency_delete',
            ],
            [
                'id'    => 173,
                'name' => 'currency_access',
            ],
            [
                'id'    => 174,
                'name' => 'transaction_type_create',
            ],
            [
                'id'    => 175,
                'name' => 'transaction_type_edit',
            ],
            [
                'id'    => 176,
                'name' => 'transaction_type_show',
            ],
            [
                'id'    => 177,
                'name' => 'transaction_type_delete',
            ],
            [
                'id'    => 178,
                'name' => 'transaction_type_access',
            ],
            [
                'id'    => 179,
                'name' => 'income_source_create',
            ],
            [
                'id'    => 180,
                'name' => 'income_source_edit',
            ],
            [
                'id'    => 181,
                'name' => 'income_source_show',
            ],
            [
                'id'    => 182,
                'name' => 'income_source_delete',
            ],
            [
                'id'    => 183,
                'name' => 'income_source_access',
            ],
            [
                'id'    => 184,
                'name' => 'client_status_create',
            ],
            [
                'id'    => 185,
                'name' => 'client_status_edit',
            ],
            [
                'id'    => 186,
                'name' => 'client_status_show',
            ],
            [
                'id'    => 187,
                'name' => 'client_status_delete',
            ],
            [
                'id'    => 188,
                'name' => 'client_status_access',
            ],
            [
                'id'    => 189,
                'name' => 'project_status_create',
            ],
            [
                'id'    => 190,
                'name' => 'project_status_edit',
            ],
            [
                'id'    => 191,
                'name' => 'project_status_show',
            ],
            [
                'id'    => 192,
                'name' => 'project_status_delete',
            ],
            [
                'id'    => 193,
                'name' => 'project_status_access',
            ],
            [
                'id'    => 194,
                'name' => 'client_management_access',
            ],
            [
                'id'    => 195,
                'name' => 'client_create',
            ],
            [
                'id'    => 196,
                'name' => 'client_edit',
            ],
            [
                'id'    => 197,
                'name' => 'client_show',
            ],
            [
                'id'    => 198,
                'name' => 'client_delete',
            ],
            [
                'id'    => 199,
                'name' => 'client_access',
            ],
            [
                'id'    => 200,
                'name' => 'project_create',
            ],
            [
                'id'    => 201,
                'name' => 'project_edit',
            ],
            [
                'id'    => 202,
                'name' => 'project_show',
            ],
            [
                'id'    => 203,
                'name' => 'project_delete',
            ],
            [
                'id'    => 204,
                'name' => 'project_access',
            ],
            [
                'id'    => 205,
                'name' => 'note_create',
            ],
            [
                'id'    => 206,
                'name' => 'note_edit',
            ],
            [
                'id'    => 207,
                'name' => 'note_show',
            ],
            [
                'id'    => 208,
                'name' => 'note_delete',
            ],
            [
                'id'    => 209,
                'name' => 'note_access',
            ],
            [
                'id'    => 210,
                'name' => 'document_create',
            ],
            [
                'id'    => 211,
                'name' => 'document_edit',
            ],
            [
                'id'    => 212,
                'name' => 'document_show',
            ],
            [
                'id'    => 213,
                'name' => 'document_delete',
            ],
            [
                'id'    => 214,
                'name' => 'document_access',
            ],
            [
                'id'    => 215,
                'name' => 'transaction_create',
            ],
            [
                'id'    => 216,
                'name' => 'transaction_show',
            ],
            [
                'id'    => 217,
                'name' => 'transaction_access',
            ],
            [
                'id'    => 218,
                'name' => 'client_report_create',
            ],
            [
                'id'    => 219,
                'name' => 'client_report_edit',
            ],
            [
                'id'    => 220,
                'name' => 'client_report_show',
            ],
            [
                'id'    => 221,
                'name' => 'client_report_delete',
            ],
            [
                'id'    => 222,
                'name' => 'client_report_access',
            ],
            [
                'id'    => 287,
                'name' => 'open_project_create',
            ],
            [
                'id'    => 288,
                'name' => 'open_project_edit',
            ],
            [
                'id'    => 289,
                'name' => 'open_project_show',
            ],
            [
                'id'    => 290,
                'name' => 'open_project_delete',
            ],
            [
                'id'    => 291,
                'name' => 'open_project_access',
            ],
            [
                'id'    => 292,
                'name' => 'supplier_proposal_create',
            ],
            [
                'id'    => 293,
                'name' => 'supplier_proposal_edit',
            ],
            [
                'id'    => 294,
                'name' => 'supplier_proposal_show',
            ],
            [
                'id'    => 295,
                'name' => 'supplier_proposal_delete',
            ],
            [
                'id'    => 296,
                'name' => 'supplier_proposal_access',
            ],
            [
                'id'    => 297,
                'name' => 'profile_password_edit',
            ],
        ];

        Role::findById(4)->syncPermissions(array_column($permissions, 'name'));
    }
}
