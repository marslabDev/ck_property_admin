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
                'title' => 'payment_history_access',
            ],
            [
                'id'    => 125,
                'title' => 'complaint_system_create',
            ],
            [
                'id'    => 126,
                'title' => 'complaint_system_edit',
            ],
            [
                'id'    => 127,
                'title' => 'complaint_system_show',
            ],
            [
                'id'    => 128,
                'title' => 'complaint_system_delete',
            ],
            [
                'id'    => 129,
                'title' => 'complaint_system_access',
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
                'id'    => 147,
                'title' => 'time_management_access',
            ],
            [
                'id'    => 148,
                'title' => 'time_work_type_create',
            ],
            [
                'id'    => 149,
                'title' => 'time_work_type_edit',
            ],
            [
                'id'    => 150,
                'title' => 'time_work_type_show',
            ],
            [
                'id'    => 151,
                'title' => 'time_work_type_delete',
            ],
            [
                'id'    => 152,
                'title' => 'time_work_type_access',
            ],
            [
                'id'    => 153,
                'title' => 'time_project_create',
            ],
            [
                'id'    => 154,
                'title' => 'time_project_edit',
            ],
            [
                'id'    => 155,
                'title' => 'time_project_show',
            ],
            [
                'id'    => 156,
                'title' => 'time_project_delete',
            ],
            [
                'id'    => 157,
                'title' => 'time_project_access',
            ],
            [
                'id'    => 158,
                'title' => 'time_entry_create',
            ],
            [
                'id'    => 159,
                'title' => 'time_entry_edit',
            ],
            [
                'id'    => 160,
                'title' => 'time_entry_show',
            ],
            [
                'id'    => 161,
                'title' => 'time_entry_delete',
            ],
            [
                'id'    => 162,
                'title' => 'time_entry_access',
            ],
            [
                'id'    => 163,
                'title' => 'time_report_create',
            ],
            [
                'id'    => 164,
                'title' => 'time_report_edit',
            ],
            [
                'id'    => 165,
                'title' => 'time_report_show',
            ],
            [
                'id'    => 166,
                'title' => 'time_report_delete',
            ],
            [
                'id'    => 167,
                'title' => 'time_report_access',
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
                'title' => 'transaction_edit',
            ],
            [
                'id'    => 217,
                'title' => 'transaction_show',
            ],
            [
                'id'    => 218,
                'title' => 'transaction_delete',
            ],
            [
                'id'    => 219,
                'title' => 'transaction_access',
            ],
            [
                'id'    => 220,
                'title' => 'client_report_create',
            ],
            [
                'id'    => 221,
                'title' => 'client_report_edit',
            ],
            [
                'id'    => 222,
                'title' => 'client_report_show',
            ],
            [
                'id'    => 223,
                'title' => 'client_report_delete',
            ],
            [
                'id'    => 224,
                'title' => 'client_report_access',
            ],
            [
                'id'    => 225,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 226,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 227,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 228,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 229,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 230,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 231,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 232,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 233,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 234,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 235,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 236,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 237,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 238,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 239,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 240,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 241,
                'title' => 'house_type_create',
            ],
            [
                'id'    => 242,
                'title' => 'house_type_edit',
            ],
            [
                'id'    => 243,
                'title' => 'house_type_show',
            ],
            [
                'id'    => 244,
                'title' => 'house_type_delete',
            ],
            [
                'id'    => 245,
                'title' => 'house_type_access',
            ],
            [
                'id'    => 246,
                'title' => 'manage_price_create',
            ],
            [
                'id'    => 247,
                'title' => 'manage_price_edit',
            ],
            [
                'id'    => 248,
                'title' => 'manage_price_show',
            ],
            [
                'id'    => 249,
                'title' => 'manage_price_delete',
            ],
            [
                'id'    => 250,
                'title' => 'manage_price_access',
            ],
            [
                'id'    => 251,
                'title' => 'user_detail_create',
            ],
            [
                'id'    => 252,
                'title' => 'user_detail_edit',
            ],
            [
                'id'    => 253,
                'title' => 'user_detail_show',
            ],
            [
                'id'    => 254,
                'title' => 'user_detail_delete',
            ],
            [
                'id'    => 255,
                'title' => 'user_detail_access',
            ],
            [
                'id'    => 256,
                'title' => 'user_card_mgmt_create',
            ],
            [
                'id'    => 257,
                'title' => 'user_card_mgmt_edit',
            ],
            [
                'id'    => 258,
                'title' => 'user_card_mgmt_show',
            ],
            [
                'id'    => 259,
                'title' => 'user_card_mgmt_delete',
            ],
            [
                'id'    => 260,
                'title' => 'user_card_mgmt_access',
            ],
            [
                'id'    => 261,
                'title' => 'street_create',
            ],
            [
                'id'    => 262,
                'title' => 'street_edit',
            ],
            [
                'id'    => 263,
                'title' => 'street_show',
            ],
            [
                'id'    => 264,
                'title' => 'street_delete',
            ],
            [
                'id'    => 265,
                'title' => 'street_access',
            ],
            [
                'id'    => 266,
                'title' => 'payment_plan_create',
            ],
            [
                'id'    => 267,
                'title' => 'payment_plan_edit',
            ],
            [
                'id'    => 268,
                'title' => 'payment_plan_show',
            ],
            [
                'id'    => 269,
                'title' => 'payment_plan_delete',
            ],
            [
                'id'    => 270,
                'title' => 'payment_plan_access',
            ],
            [
                'id'    => 271,
                'title' => 'transaction_management_access',
            ],
            [
                'id'    => 272,
                'title' => 'setting_access',
            ],
            [
                'id'    => 273,
                'title' => 'home_owner_transaction_create',
            ],
            [
                'id'    => 274,
                'title' => 'home_owner_transaction_edit',
            ],
            [
                'id'    => 275,
                'title' => 'home_owner_transaction_show',
            ],
            [
                'id'    => 276,
                'title' => 'home_owner_transaction_delete',
            ],
            [
                'id'    => 277,
                'title' => 'home_owner_transaction_access',
            ],
            [
                'id'    => 278,
                'title' => 'payment_item_create',
            ],
            [
                'id'    => 279,
                'title' => 'payment_item_edit',
            ],
            [
                'id'    => 280,
                'title' => 'payment_item_show',
            ],
            [
                'id'    => 281,
                'title' => 'payment_item_delete',
            ],
            [
                'id'    => 282,
                'title' => 'payment_item_access',
            ],
            [
                'id'    => 283,
                'title' => 'payment_charge_create',
            ],
            [
                'id'    => 284,
                'title' => 'payment_charge_edit',
            ],
            [
                'id'    => 285,
                'title' => 'payment_charge_show',
            ],
            [
                'id'    => 286,
                'title' => 'payment_charge_delete',
            ],
            [
                'id'    => 287,
                'title' => 'payment_charge_access',
            ],
            [
                'id'    => 288,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
