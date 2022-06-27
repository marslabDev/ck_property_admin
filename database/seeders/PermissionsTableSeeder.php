<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'area_create',
            ],
            [
                'id'    => 20,
                'title' => 'area_edit',
            ],
            [
                'id'    => 21,
                'title' => 'area_show',
            ],
            [
                'id'    => 22,
                'title' => 'area_delete',
            ],
            [
                'id'    => 23,
                'title' => 'area_access',
            ],
            [
                'id'    => 24,
                'title' => 'manage_house_create',
            ],
            [
                'id'    => 25,
                'title' => 'manage_house_edit',
            ],
            [
                'id'    => 26,
                'title' => 'manage_house_show',
            ],
            [
                'id'    => 27,
                'title' => 'manage_house_delete',
            ],
            [
                'id'    => 28,
                'title' => 'manage_house_access',
            ],
            [
                'id'    => 29,
                'title' => 'payment_type_create',
            ],
            [
                'id'    => 30,
                'title' => 'payment_type_edit',
            ],
            [
                'id'    => 31,
                'title' => 'payment_type_show',
            ],
            [
                'id'    => 32,
                'title' => 'payment_type_delete',
            ],
            [
                'id'    => 33,
                'title' => 'payment_type_access',
            ],
            [
                'id'    => 34,
                'title' => 'parking_lot_create',
            ],
            [
                'id'    => 35,
                'title' => 'parking_lot_edit',
            ],
            [
                'id'    => 36,
                'title' => 'parking_lot_show',
            ],
            [
                'id'    => 37,
                'title' => 'parking_lot_delete',
            ],
            [
                'id'    => 38,
                'title' => 'parking_lot_access',
            ],
            [
                'id'    => 39,
                'title' => 'notice_create',
            ],
            [
                'id'    => 40,
                'title' => 'notice_edit',
            ],
            [
                'id'    => 41,
                'title' => 'notice_show',
            ],
            [
                'id'    => 42,
                'title' => 'notice_delete',
            ],
            [
                'id'    => 43,
                'title' => 'notice_access',
            ],
            [
                'id'    => 44,
                'title' => 'article_create',
            ],
            [
                'id'    => 45,
                'title' => 'article_edit',
            ],
            [
                'id'    => 46,
                'title' => 'article_show',
            ],
            [
                'id'    => 47,
                'title' => 'article_delete',
            ],
            [
                'id'    => 48,
                'title' => 'article_access',
            ],
            [
                'id'    => 49,
                'title' => 'supplier_access',
            ],
            [
                'id'    => 50,
                'title' => 'product_create',
            ],
            [
                'id'    => 51,
                'title' => 'product_edit',
            ],
            [
                'id'    => 52,
                'title' => 'product_show',
            ],
            [
                'id'    => 53,
                'title' => 'product_delete',
            ],
            [
                'id'    => 54,
                'title' => 'product_access',
            ],
            [
                'id'    => 55,
                'title' => 'service_create',
            ],
            [
                'id'    => 56,
                'title' => 'service_edit',
            ],
            [
                'id'    => 57,
                'title' => 'service_show',
            ],
            [
                'id'    => 58,
                'title' => 'service_delete',
            ],
            [
                'id'    => 59,
                'title' => 'service_access',
            ],
            [
                'id'    => 60,
                'title' => 'my_case_create',
            ],
            [
                'id'    => 61,
                'title' => 'my_case_edit',
            ],
            [
                'id'    => 62,
                'title' => 'my_case_show',
            ],
            [
                'id'    => 63,
                'title' => 'my_case_delete',
            ],
            [
                'id'    => 64,
                'title' => 'my_case_access',
            ],
            [
                'id'    => 65,
                'title' => 'cases_category_create',
            ],
            [
                'id'    => 66,
                'title' => 'cases_category_edit',
            ],
            [
                'id'    => 67,
                'title' => 'cases_category_show',
            ],
            [
                'id'    => 68,
                'title' => 'cases_category_delete',
            ],
            [
                'id'    => 69,
                'title' => 'cases_category_access',
            ],
            [
                'id'    => 70,
                'title' => 'maintanance_create',
            ],
            [
                'id'    => 71,
                'title' => 'maintanance_edit',
            ],
            [
                'id'    => 72,
                'title' => 'maintanance_show',
            ],
            [
                'id'    => 73,
                'title' => 'maintanance_delete',
            ],
            [
                'id'    => 74,
                'title' => 'maintanance_access',
            ],
            [
                'id'    => 75,
                'title' => 'maintanance_type_create',
            ],
            [
                'id'    => 76,
                'title' => 'maintanance_type_edit',
            ],
            [
                'id'    => 77,
                'title' => 'maintanance_type_show',
            ],
            [
                'id'    => 78,
                'title' => 'maintanance_type_delete',
            ],
            [
                'id'    => 79,
                'title' => 'maintanance_type_access',
            ],
            [
                'id'    => 80,
                'title' => 'asset_management_access',
            ],
            [
                'id'    => 81,
                'title' => 'asset_category_create',
            ],
            [
                'id'    => 82,
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => 83,
                'title' => 'asset_category_show',
            ],
            [
                'id'    => 84,
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => 85,
                'title' => 'asset_category_access',
            ],
            [
                'id'    => 86,
                'title' => 'asset_location_create',
            ],
            [
                'id'    => 87,
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => 88,
                'title' => 'asset_location_show',
            ],
            [
                'id'    => 89,
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => 90,
                'title' => 'asset_location_access',
            ],
            [
                'id'    => 91,
                'title' => 'asset_status_create',
            ],
            [
                'id'    => 92,
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => 93,
                'title' => 'asset_status_show',
            ],
            [
                'id'    => 94,
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => 95,
                'title' => 'asset_status_access',
            ],
            [
                'id'    => 96,
                'title' => 'asset_create',
            ],
            [
                'id'    => 97,
                'title' => 'asset_edit',
            ],
            [
                'id'    => 98,
                'title' => 'asset_show',
            ],
            [
                'id'    => 99,
                'title' => 'asset_delete',
            ],
            [
                'id'    => 100,
                'title' => 'asset_access',
            ],
            [
                'id'    => 101,
                'title' => 'assets_history_access',
            ],
            [
                'id'    => 102,
                'title' => 'payment_management_access',
            ],
            [
                'id'    => 103,
                'title' => 'house_management_access',
            ],
            [
                'id'    => 104,
                'title' => 'other_access',
            ],
            [
                'id'    => 105,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 106,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 107,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 108,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 109,
                'title' => 'expense_management_access',
            ],
            [
                'id'    => 110,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 111,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 112,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 113,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 114,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 115,
                'title' => 'income_category_create',
            ],
            [
                'id'    => 116,
                'title' => 'income_category_edit',
            ],
            [
                'id'    => 117,
                'title' => 'income_category_show',
            ],
            [
                'id'    => 118,
                'title' => 'income_category_delete',
            ],
            [
                'id'    => 119,
                'title' => 'income_category_access',
            ],
            [
                'id'    => 120,
                'title' => 'expense_create',
            ],
            [
                'id'    => 121,
                'title' => 'expense_edit',
            ],
            [
                'id'    => 122,
                'title' => 'expense_show',
            ],
            [
                'id'    => 123,
                'title' => 'expense_delete',
            ],
            [
                'id'    => 124,
                'title' => 'expense_access',
            ],
            [
                'id'    => 125,
                'title' => 'income_create',
            ],
            [
                'id'    => 126,
                'title' => 'income_edit',
            ],
            [
                'id'    => 127,
                'title' => 'income_show',
            ],
            [
                'id'    => 128,
                'title' => 'income_delete',
            ],
            [
                'id'    => 129,
                'title' => 'income_access',
            ],
            [
                'id'    => 130,
                'title' => 'expense_report_create',
            ],
            [
                'id'    => 131,
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => 132,
                'title' => 'expense_report_show',
            ],
            [
                'id'    => 133,
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => 134,
                'title' => 'expense_report_access',
            ],
            [
                'id'    => 135,
                'title' => 'payment_history_create',
            ],
            [
                'id'    => 136,
                'title' => 'payment_history_edit',
            ],
            [
                'id'    => 137,
                'title' => 'payment_history_show',
            ],
            [
                'id'    => 138,
                'title' => 'payment_history_delete',
            ],
            [
                'id'    => 139,
                'title' => 'payment_history_access',
            ],
            [
                'id'    => 140,
                'title' => 'complaint_system_create',
            ],
            [
                'id'    => 141,
                'title' => 'complaint_system_edit',
            ],
            [
                'id'    => 142,
                'title' => 'complaint_system_show',
            ],
            [
                'id'    => 143,
                'title' => 'complaint_system_delete',
            ],
            [
                'id'    => 144,
                'title' => 'complaint_system_access',
            ],
            [
                'id'    => 145,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 146,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 147,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 148,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 149,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 150,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 151,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 152,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 153,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 154,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 155,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 156,
                'title' => 'task_create',
            ],
            [
                'id'    => 157,
                'title' => 'task_edit',
            ],
            [
                'id'    => 158,
                'title' => 'task_show',
            ],
            [
                'id'    => 159,
                'title' => 'task_delete',
            ],
            [
                'id'    => 160,
                'title' => 'task_access',
            ],
            [
                'id'    => 161,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 162,
                'title' => 'time_management_access',
            ],
            [
                'id'    => 163,
                'title' => 'time_work_type_create',
            ],
            [
                'id'    => 164,
                'title' => 'time_work_type_edit',
            ],
            [
                'id'    => 165,
                'title' => 'time_work_type_show',
            ],
            [
                'id'    => 166,
                'title' => 'time_work_type_delete',
            ],
            [
                'id'    => 167,
                'title' => 'time_work_type_access',
            ],
            [
                'id'    => 168,
                'title' => 'time_project_create',
            ],
            [
                'id'    => 169,
                'title' => 'time_project_edit',
            ],
            [
                'id'    => 170,
                'title' => 'time_project_show',
            ],
            [
                'id'    => 171,
                'title' => 'time_project_delete',
            ],
            [
                'id'    => 172,
                'title' => 'time_project_access',
            ],
            [
                'id'    => 173,
                'title' => 'time_entry_create',
            ],
            [
                'id'    => 174,
                'title' => 'time_entry_edit',
            ],
            [
                'id'    => 175,
                'title' => 'time_entry_show',
            ],
            [
                'id'    => 176,
                'title' => 'time_entry_delete',
            ],
            [
                'id'    => 177,
                'title' => 'time_entry_access',
            ],
            [
                'id'    => 178,
                'title' => 'time_report_create',
            ],
            [
                'id'    => 179,
                'title' => 'time_report_edit',
            ],
            [
                'id'    => 180,
                'title' => 'time_report_show',
            ],
            [
                'id'    => 181,
                'title' => 'time_report_delete',
            ],
            [
                'id'    => 182,
                'title' => 'time_report_access',
            ],
            [
                'id'    => 183,
                'title' => 'client_management_setting_access',
            ],
            [
                'id'    => 184,
                'title' => 'currency_create',
            ],
            [
                'id'    => 185,
                'title' => 'currency_edit',
            ],
            [
                'id'    => 186,
                'title' => 'currency_show',
            ],
            [
                'id'    => 187,
                'title' => 'currency_delete',
            ],
            [
                'id'    => 188,
                'title' => 'currency_access',
            ],
            [
                'id'    => 189,
                'title' => 'transaction_type_create',
            ],
            [
                'id'    => 190,
                'title' => 'transaction_type_edit',
            ],
            [
                'id'    => 191,
                'title' => 'transaction_type_show',
            ],
            [
                'id'    => 192,
                'title' => 'transaction_type_delete',
            ],
            [
                'id'    => 193,
                'title' => 'transaction_type_access',
            ],
            [
                'id'    => 194,
                'title' => 'income_source_create',
            ],
            [
                'id'    => 195,
                'title' => 'income_source_edit',
            ],
            [
                'id'    => 196,
                'title' => 'income_source_show',
            ],
            [
                'id'    => 197,
                'title' => 'income_source_delete',
            ],
            [
                'id'    => 198,
                'title' => 'income_source_access',
            ],
            [
                'id'    => 199,
                'title' => 'client_status_create',
            ],
            [
                'id'    => 200,
                'title' => 'client_status_edit',
            ],
            [
                'id'    => 201,
                'title' => 'client_status_show',
            ],
            [
                'id'    => 202,
                'title' => 'client_status_delete',
            ],
            [
                'id'    => 203,
                'title' => 'client_status_access',
            ],
            [
                'id'    => 204,
                'title' => 'project_status_create',
            ],
            [
                'id'    => 205,
                'title' => 'project_status_edit',
            ],
            [
                'id'    => 206,
                'title' => 'project_status_show',
            ],
            [
                'id'    => 207,
                'title' => 'project_status_delete',
            ],
            [
                'id'    => 208,
                'title' => 'project_status_access',
            ],
            [
                'id'    => 209,
                'title' => 'client_management_access',
            ],
            [
                'id'    => 210,
                'title' => 'client_create',
            ],
            [
                'id'    => 211,
                'title' => 'client_edit',
            ],
            [
                'id'    => 212,
                'title' => 'client_show',
            ],
            [
                'id'    => 213,
                'title' => 'client_delete',
            ],
            [
                'id'    => 214,
                'title' => 'client_access',
            ],
            [
                'id'    => 215,
                'title' => 'project_create',
            ],
            [
                'id'    => 216,
                'title' => 'project_edit',
            ],
            [
                'id'    => 217,
                'title' => 'project_show',
            ],
            [
                'id'    => 218,
                'title' => 'project_delete',
            ],
            [
                'id'    => 219,
                'title' => 'project_access',
            ],
            [
                'id'    => 220,
                'title' => 'note_create',
            ],
            [
                'id'    => 221,
                'title' => 'note_edit',
            ],
            [
                'id'    => 222,
                'title' => 'note_show',
            ],
            [
                'id'    => 223,
                'title' => 'note_delete',
            ],
            [
                'id'    => 224,
                'title' => 'note_access',
            ],
            [
                'id'    => 225,
                'title' => 'document_create',
            ],
            [
                'id'    => 226,
                'title' => 'document_edit',
            ],
            [
                'id'    => 227,
                'title' => 'document_show',
            ],
            [
                'id'    => 228,
                'title' => 'document_delete',
            ],
            [
                'id'    => 229,
                'title' => 'document_access',
            ],
            [
                'id'    => 230,
                'title' => 'transaction_create',
            ],
            [
                'id'    => 231,
                'title' => 'transaction_edit',
            ],
            [
                'id'    => 232,
                'title' => 'transaction_show',
            ],
            [
                'id'    => 233,
                'title' => 'transaction_delete',
            ],
            [
                'id'    => 234,
                'title' => 'transaction_access',
            ],
            [
                'id'    => 235,
                'title' => 'client_report_create',
            ],
            [
                'id'    => 236,
                'title' => 'client_report_edit',
            ],
            [
                'id'    => 237,
                'title' => 'client_report_show',
            ],
            [
                'id'    => 238,
                'title' => 'client_report_delete',
            ],
            [
                'id'    => 239,
                'title' => 'client_report_access',
            ],
            [
                'id'    => 240,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
