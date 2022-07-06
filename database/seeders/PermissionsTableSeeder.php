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
                'title' => 'my_case_create',
            ],
            [
                'id'    => 50,
                'title' => 'my_case_edit',
            ],
            [
                'id'    => 51,
                'title' => 'my_case_show',
            ],
            [
                'id'    => 52,
                'title' => 'my_case_delete',
            ],
            [
                'id'    => 53,
                'title' => 'my_case_access',
            ],
            [
                'id'    => 54,
                'title' => 'cases_category_create',
            ],
            [
                'id'    => 55,
                'title' => 'cases_category_edit',
            ],
            [
                'id'    => 56,
                'title' => 'cases_category_show',
            ],
            [
                'id'    => 57,
                'title' => 'cases_category_delete',
            ],
            [
                'id'    => 58,
                'title' => 'cases_category_access',
            ],
            [
                'id'    => 59,
                'title' => 'maintanance_create',
            ],
            [
                'id'    => 60,
                'title' => 'maintanance_edit',
            ],
            [
                'id'    => 61,
                'title' => 'maintanance_show',
            ],
            [
                'id'    => 62,
                'title' => 'maintanance_delete',
            ],
            [
                'id'    => 63,
                'title' => 'maintanance_access',
            ],
            [
                'id'    => 64,
                'title' => 'maintanance_type_create',
            ],
            [
                'id'    => 65,
                'title' => 'maintanance_type_edit',
            ],
            [
                'id'    => 66,
                'title' => 'maintanance_type_show',
            ],
            [
                'id'    => 67,
                'title' => 'maintanance_type_delete',
            ],
            [
                'id'    => 68,
                'title' => 'maintanance_type_access',
            ],
            [
                'id'    => 69,
                'title' => 'asset_management_access',
            ],
            [
                'id'    => 70,
                'title' => 'asset_category_create',
            ],
            [
                'id'    => 71,
                'title' => 'asset_category_edit',
            ],
            [
                'id'    => 72,
                'title' => 'asset_category_show',
            ],
            [
                'id'    => 73,
                'title' => 'asset_category_delete',
            ],
            [
                'id'    => 74,
                'title' => 'asset_category_access',
            ],
            [
                'id'    => 75,
                'title' => 'asset_location_create',
            ],
            [
                'id'    => 76,
                'title' => 'asset_location_edit',
            ],
            [
                'id'    => 77,
                'title' => 'asset_location_show',
            ],
            [
                'id'    => 78,
                'title' => 'asset_location_delete',
            ],
            [
                'id'    => 79,
                'title' => 'asset_location_access',
            ],
            [
                'id'    => 80,
                'title' => 'asset_status_create',
            ],
            [
                'id'    => 81,
                'title' => 'asset_status_edit',
            ],
            [
                'id'    => 82,
                'title' => 'asset_status_show',
            ],
            [
                'id'    => 83,
                'title' => 'asset_status_delete',
            ],
            [
                'id'    => 84,
                'title' => 'asset_status_access',
            ],
            [
                'id'    => 85,
                'title' => 'asset_create',
            ],
            [
                'id'    => 86,
                'title' => 'asset_edit',
            ],
            [
                'id'    => 87,
                'title' => 'asset_show',
            ],
            [
                'id'    => 88,
                'title' => 'asset_delete',
            ],
            [
                'id'    => 89,
                'title' => 'asset_access',
            ],
            [
                'id'    => 90,
                'title' => 'assets_history_access',
            ],
            [
                'id'    => 91,
                'title' => 'payment_management_access',
            ],
            [
                'id'    => 92,
                'title' => 'house_management_access',
            ],
            [
                'id'    => 93,
                'title' => 'other_access',
            ],
            [
                'id'    => 94,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 95,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 96,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 97,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 98,
                'title' => 'expense_management_access',
            ],
            [
                'id'    => 99,
                'title' => 'expense_category_create',
            ],
            [
                'id'    => 100,
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => 101,
                'title' => 'expense_category_show',
            ],
            [
                'id'    => 102,
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => 103,
                'title' => 'expense_category_access',
            ],
            [
                'id'    => 104,
                'title' => 'income_category_create',
            ],
            [
                'id'    => 105,
                'title' => 'income_category_edit',
            ],
            [
                'id'    => 106,
                'title' => 'income_category_show',
            ],
            [
                'id'    => 107,
                'title' => 'income_category_delete',
            ],
            [
                'id'    => 108,
                'title' => 'income_category_access',
            ],
            [
                'id'    => 109,
                'title' => 'expense_create',
            ],
            [
                'id'    => 110,
                'title' => 'expense_edit',
            ],
            [
                'id'    => 111,
                'title' => 'expense_show',
            ],
            [
                'id'    => 112,
                'title' => 'expense_delete',
            ],
            [
                'id'    => 113,
                'title' => 'expense_access',
            ],
            [
                'id'    => 114,
                'title' => 'income_create',
            ],
            [
                'id'    => 115,
                'title' => 'income_edit',
            ],
            [
                'id'    => 116,
                'title' => 'income_show',
            ],
            [
                'id'    => 117,
                'title' => 'income_delete',
            ],
            [
                'id'    => 118,
                'title' => 'income_access',
            ],
            [
                'id'    => 119,
                'title' => 'expense_report_create',
            ],
            [
                'id'    => 120,
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => 121,
                'title' => 'expense_report_show',
            ],
            [
                'id'    => 122,
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => 123,
                'title' => 'expense_report_access',
            ],
            [
                'id'    => 124,
                'title' => 'payment_history_create',
            ],
            [
                'id'    => 125,
                'title' => 'payment_history_edit',
            ],
            [
                'id'    => 126,
                'title' => 'payment_history_show',
            ],
            [
                'id'    => 127,
                'title' => 'payment_history_delete',
            ],
            [
                'id'    => 128,
                'title' => 'payment_history_access',
            ],
            [
                'id'    => 129,
                'title' => 'complaint_system_create',
            ],
            [
                'id'    => 130,
                'title' => 'complaint_system_edit',
            ],
            [
                'id'    => 131,
                'title' => 'complaint_system_show',
            ],
            [
                'id'    => 132,
                'title' => 'complaint_system_delete',
            ],
            [
                'id'    => 133,
                'title' => 'complaint_system_access',
            ],
            [
                'id'    => 134,
                'title' => 'task_management_access',
            ],
            [
                'id'    => 135,
                'title' => 'task_status_create',
            ],
            [
                'id'    => 136,
                'title' => 'task_status_edit',
            ],
            [
                'id'    => 137,
                'title' => 'task_status_show',
            ],
            [
                'id'    => 138,
                'title' => 'task_status_delete',
            ],
            [
                'id'    => 139,
                'title' => 'task_status_access',
            ],
            [
                'id'    => 140,
                'title' => 'task_tag_create',
            ],
            [
                'id'    => 141,
                'title' => 'task_tag_edit',
            ],
            [
                'id'    => 142,
                'title' => 'task_tag_show',
            ],
            [
                'id'    => 143,
                'title' => 'task_tag_delete',
            ],
            [
                'id'    => 144,
                'title' => 'task_tag_access',
            ],
            [
                'id'    => 145,
                'title' => 'task_create',
            ],
            [
                'id'    => 146,
                'title' => 'task_edit',
            ],
            [
                'id'    => 147,
                'title' => 'task_show',
            ],
            [
                'id'    => 148,
                'title' => 'task_delete',
            ],
            [
                'id'    => 149,
                'title' => 'task_access',
            ],
            [
                'id'    => 150,
                'title' => 'tasks_calendar_access',
            ],
            [
                'id'    => 151,
                'title' => 'time_management_access',
            ],
            [
                'id'    => 152,
                'title' => 'time_work_type_create',
            ],
            [
                'id'    => 153,
                'title' => 'time_work_type_edit',
            ],
            [
                'id'    => 154,
                'title' => 'time_work_type_show',
            ],
            [
                'id'    => 155,
                'title' => 'time_work_type_delete',
            ],
            [
                'id'    => 156,
                'title' => 'time_work_type_access',
            ],
            [
                'id'    => 157,
                'title' => 'time_project_create',
            ],
            [
                'id'    => 158,
                'title' => 'time_project_edit',
            ],
            [
                'id'    => 159,
                'title' => 'time_project_show',
            ],
            [
                'id'    => 160,
                'title' => 'time_project_delete',
            ],
            [
                'id'    => 161,
                'title' => 'time_project_access',
            ],
            [
                'id'    => 162,
                'title' => 'time_entry_create',
            ],
            [
                'id'    => 163,
                'title' => 'time_entry_edit',
            ],
            [
                'id'    => 164,
                'title' => 'time_entry_show',
            ],
            [
                'id'    => 165,
                'title' => 'time_entry_delete',
            ],
            [
                'id'    => 166,
                'title' => 'time_entry_access',
            ],
            [
                'id'    => 167,
                'title' => 'time_report_create',
            ],
            [
                'id'    => 168,
                'title' => 'time_report_edit',
            ],
            [
                'id'    => 169,
                'title' => 'time_report_show',
            ],
            [
                'id'    => 170,
                'title' => 'time_report_delete',
            ],
            [
                'id'    => 171,
                'title' => 'time_report_access',
            ],
            [
                'id'    => 172,
                'title' => 'client_management_setting_access',
            ],
            [
                'id'    => 173,
                'title' => 'currency_create',
            ],
            [
                'id'    => 174,
                'title' => 'currency_edit',
            ],
            [
                'id'    => 175,
                'title' => 'currency_show',
            ],
            [
                'id'    => 176,
                'title' => 'currency_delete',
            ],
            [
                'id'    => 177,
                'title' => 'currency_access',
            ],
            [
                'id'    => 178,
                'title' => 'transaction_type_create',
            ],
            [
                'id'    => 179,
                'title' => 'transaction_type_edit',
            ],
            [
                'id'    => 180,
                'title' => 'transaction_type_show',
            ],
            [
                'id'    => 181,
                'title' => 'transaction_type_delete',
            ],
            [
                'id'    => 182,
                'title' => 'transaction_type_access',
            ],
            [
                'id'    => 183,
                'title' => 'income_source_create',
            ],
            [
                'id'    => 184,
                'title' => 'income_source_edit',
            ],
            [
                'id'    => 185,
                'title' => 'income_source_show',
            ],
            [
                'id'    => 186,
                'title' => 'income_source_delete',
            ],
            [
                'id'    => 187,
                'title' => 'income_source_access',
            ],
            [
                'id'    => 188,
                'title' => 'client_status_create',
            ],
            [
                'id'    => 189,
                'title' => 'client_status_edit',
            ],
            [
                'id'    => 190,
                'title' => 'client_status_show',
            ],
            [
                'id'    => 191,
                'title' => 'client_status_delete',
            ],
            [
                'id'    => 192,
                'title' => 'client_status_access',
            ],
            [
                'id'    => 193,
                'title' => 'project_status_create',
            ],
            [
                'id'    => 194,
                'title' => 'project_status_edit',
            ],
            [
                'id'    => 195,
                'title' => 'project_status_show',
            ],
            [
                'id'    => 196,
                'title' => 'project_status_delete',
            ],
            [
                'id'    => 197,
                'title' => 'project_status_access',
            ],
            [
                'id'    => 198,
                'title' => 'client_management_access',
            ],
            [
                'id'    => 199,
                'title' => 'client_create',
            ],
            [
                'id'    => 200,
                'title' => 'client_edit',
            ],
            [
                'id'    => 201,
                'title' => 'client_show',
            ],
            [
                'id'    => 202,
                'title' => 'client_delete',
            ],
            [
                'id'    => 203,
                'title' => 'client_access',
            ],
            [
                'id'    => 204,
                'title' => 'project_create',
            ],
            [
                'id'    => 205,
                'title' => 'project_edit',
            ],
            [
                'id'    => 206,
                'title' => 'project_show',
            ],
            [
                'id'    => 207,
                'title' => 'project_delete',
            ],
            [
                'id'    => 208,
                'title' => 'project_access',
            ],
            [
                'id'    => 209,
                'title' => 'note_create',
            ],
            [
                'id'    => 210,
                'title' => 'note_edit',
            ],
            [
                'id'    => 211,
                'title' => 'note_show',
            ],
            [
                'id'    => 212,
                'title' => 'note_delete',
            ],
            [
                'id'    => 213,
                'title' => 'note_access',
            ],
            [
                'id'    => 214,
                'title' => 'document_create',
            ],
            [
                'id'    => 215,
                'title' => 'document_edit',
            ],
            [
                'id'    => 216,
                'title' => 'document_show',
            ],
            [
                'id'    => 217,
                'title' => 'document_delete',
            ],
            [
                'id'    => 218,
                'title' => 'document_access',
            ],
            [
                'id'    => 219,
                'title' => 'transaction_create',
            ],
            [
                'id'    => 220,
                'title' => 'transaction_edit',
            ],
            [
                'id'    => 221,
                'title' => 'transaction_show',
            ],
            [
                'id'    => 222,
                'title' => 'transaction_delete',
            ],
            [
                'id'    => 223,
                'title' => 'transaction_access',
            ],
            [
                'id'    => 224,
                'title' => 'client_report_create',
            ],
            [
                'id'    => 225,
                'title' => 'client_report_edit',
            ],
            [
                'id'    => 226,
                'title' => 'client_report_show',
            ],
            [
                'id'    => 227,
                'title' => 'client_report_delete',
            ],
            [
                'id'    => 228,
                'title' => 'client_report_access',
            ],
            [
                'id'    => 229,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 230,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 231,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 232,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 233,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 234,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 235,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 236,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 237,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 238,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 239,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 240,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 241,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 242,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 243,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 244,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 245,
                'title' => 'house_type_create',
            ],
            [
                'id'    => 246,
                'title' => 'house_type_edit',
            ],
            [
                'id'    => 247,
                'title' => 'house_type_show',
            ],
            [
                'id'    => 248,
                'title' => 'house_type_delete',
            ],
            [
                'id'    => 249,
                'title' => 'house_type_access',
            ],
            [
                'id'    => 250,
                'title' => 'manage_price_create',
            ],
            [
                'id'    => 251,
                'title' => 'manage_price_edit',
            ],
            [
                'id'    => 252,
                'title' => 'manage_price_show',
            ],
            [
                'id'    => 253,
                'title' => 'manage_price_delete',
            ],
            [
                'id'    => 254,
                'title' => 'manage_price_access',
            ],
            [
                'id'    => 255,
                'title' => 'user_detail_create',
            ],
            [
                'id'    => 256,
                'title' => 'user_detail_edit',
            ],
            [
                'id'    => 257,
                'title' => 'user_detail_show',
            ],
            [
                'id'    => 258,
                'title' => 'user_detail_delete',
            ],
            [
                'id'    => 259,
                'title' => 'user_detail_access',
            ],
            [
                'id'    => 260,
                'title' => 'user_card_mgmt_create',
            ],
            [
                'id'    => 261,
                'title' => 'user_card_mgmt_edit',
            ],
            [
                'id'    => 262,
                'title' => 'user_card_mgmt_show',
            ],
            [
                'id'    => 263,
                'title' => 'user_card_mgmt_delete',
            ],
            [
                'id'    => 264,
                'title' => 'user_card_mgmt_access',
            ],
            [
                'id'    => 265,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
