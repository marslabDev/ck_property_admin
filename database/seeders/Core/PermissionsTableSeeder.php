<?php

namespace Database\Seeders\Core;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        Permission::truncate();

        $permissions = [
            [
                'id'    => 1,
                'name' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'name' => 'permission_create',
            ],
            [
                'id'    => 3,
                'name' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'name' => 'permission_show',
            ],
            [
                'id'    => 5,
                'name' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'name' => 'permission_access',
            ],
            [
                'id'    => 7,
                'name' => 'role_create',
            ],
            [
                'id'    => 8,
                'name' => 'role_edit',
            ],
            [
                'id'    => 9,
                'name' => 'role_show',
            ],
            [
                'id'    => 10,
                'name' => 'role_delete',
            ],
            [
                'id'    => 11,
                'name' => 'role_access',
            ],
            [
                'id'    => 12,
                'name' => 'user_create',
            ],
            [
                'id'    => 13,
                'name' => 'user_edit',
            ],
            [
                'id'    => 14,
                'name' => 'user_show',
            ],
            [
                'id'    => 15,
                'name' => 'user_delete',
            ],
            [
                'id'    => 16,
                'name' => 'user_access',
            ],
            [
                'id'    => 17,
                'name' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'name' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'name' => 'area_create',
            ],
            [
                'id'    => 20,
                'name' => 'area_edit',
            ],
            [
                'id'    => 21,
                'name' => 'area_show',
            ],
            [
                'id'    => 22,
                'name' => 'area_delete',
            ],
            [
                'id'    => 23,
                'name' => 'area_access',
            ],
            [
                'id'    => 24,
                'name' => 'manage_house_create',
            ],
            [
                'id'    => 25,
                'name' => 'manage_house_edit',
            ],
            [
                'id'    => 26,
                'name' => 'manage_house_show',
            ],
            [
                'id'    => 27,
                'name' => 'manage_house_delete',
            ],
            [
                'id'    => 28,
                'name' => 'manage_house_access',
            ],
            [
                'id'    => 29,
                'name' => 'payment_type_create',
            ],
            [
                'id'    => 30,
                'name' => 'payment_type_edit',
            ],
            [
                'id'    => 31,
                'name' => 'payment_type_show',
            ],
            [
                'id'    => 32,
                'name' => 'payment_type_delete',
            ],
            [
                'id'    => 33,
                'name' => 'payment_type_access',
            ],
            [
                'id'    => 34,
                'name' => 'parking_lot_create',
            ],
            [
                'id'    => 35,
                'name' => 'parking_lot_edit',
            ],
            [
                'id'    => 36,
                'name' => 'parking_lot_show',
            ],
            [
                'id'    => 37,
                'name' => 'parking_lot_delete',
            ],
            [
                'id'    => 38,
                'name' => 'parking_lot_access',
            ],
            [
                'id'    => 39,
                'name' => 'notice_create',
            ],
            [
                'id'    => 40,
                'name' => 'notice_edit',
            ],
            [
                'id'    => 41,
                'name' => 'notice_show',
            ],
            [
                'id'    => 42,
                'name' => 'notice_delete',
            ],
            [
                'id'    => 43,
                'name' => 'notice_access',
            ],
            [
                'id'    => 44,
                'name' => 'article_create',
            ],
            [
                'id'    => 45,
                'name' => 'article_edit',
            ],
            [
                'id'    => 46,
                'name' => 'article_show',
            ],
            [
                'id'    => 47,
                'name' => 'article_delete',
            ],
            [
                'id'    => 48,
                'name' => 'article_access',
            ],
            [
                'id'    => 49,
                'name' => 'my_case_create',
            ],
            [
                'id'    => 50,
                'name' => 'my_case_edit',
            ],
            [
                'id'    => 51,
                'name' => 'my_case_show',
            ],
            [
                'id'    => 52,
                'name' => 'my_case_delete',
            ],
            [
                'id'    => 53,
                'name' => 'my_case_access',
            ],
            [
                'id'    => 54,
                'name' => 'cases_category_create',
            ],
            [
                'id'    => 55,
                'name' => 'cases_category_edit',
            ],
            [
                'id'    => 56,
                'name' => 'cases_category_show',
            ],
            [
                'id'    => 57,
                'name' => 'cases_category_delete',
            ],
            [
                'id'    => 58,
                'name' => 'cases_category_access',
            ],
            [
                'id'    => 59,
                'name' => 'maintanance_create',
            ],
            [
                'id'    => 60,
                'name' => 'maintanance_edit',
            ],
            [
                'id'    => 61,
                'name' => 'maintanance_show',
            ],
            [
                'id'    => 62,
                'name' => 'maintanance_delete',
            ],
            [
                'id'    => 63,
                'name' => 'maintanance_access',
            ],
            [
                'id'    => 64,
                'name' => 'maintanance_type_create',
            ],
            [
                'id'    => 65,
                'name' => 'maintanance_type_edit',
            ],
            [
                'id'    => 66,
                'name' => 'maintanance_type_show',
            ],
            [
                'id'    => 67,
                'name' => 'maintanance_type_delete',
            ],
            [
                'id'    => 68,
                'name' => 'maintanance_type_access',
            ],
            [
                'id'    => 69,
                'name' => 'asset_management_access',
            ],
            [
                'id'    => 70,
                'name' => 'asset_category_create',
            ],
            [
                'id'    => 71,
                'name' => 'asset_category_edit',
            ],
            [
                'id'    => 72,
                'name' => 'asset_category_show',
            ],
            [
                'id'    => 73,
                'name' => 'asset_category_delete',
            ],
            [
                'id'    => 74,
                'name' => 'asset_category_access',
            ],
            [
                'id'    => 75,
                'name' => 'asset_location_create',
            ],
            [
                'id'    => 76,
                'name' => 'asset_location_edit',
            ],
            [
                'id'    => 77,
                'name' => 'asset_location_show',
            ],
            [
                'id'    => 78,
                'name' => 'asset_location_delete',
            ],
            [
                'id'    => 79,
                'name' => 'asset_location_access',
            ],
            [
                'id'    => 80,
                'name' => 'asset_status_create',
            ],
            [
                'id'    => 81,
                'name' => 'asset_status_edit',
            ],
            [
                'id'    => 82,
                'name' => 'asset_status_show',
            ],
            [
                'id'    => 83,
                'name' => 'asset_status_delete',
            ],
            [
                'id'    => 84,
                'name' => 'asset_status_access',
            ],
            [
                'id'    => 85,
                'name' => 'asset_create',
            ],
            [
                'id'    => 86,
                'name' => 'asset_edit',
            ],
            [
                'id'    => 87,
                'name' => 'asset_show',
            ],
            [
                'id'    => 88,
                'name' => 'asset_delete',
            ],
            [
                'id'    => 89,
                'name' => 'asset_access',
            ],
            [
                'id'    => 90,
                'name' => 'assets_history_access',
            ],
            [
                'id'    => 91,
                'name' => 'payment_management_access',
            ],
            [
                'id'    => 92,
                'name' => 'house_management_access',
            ],
            [
                'id'    => 93,
                'name' => 'other_access',
            ],
            [
                'id'    => 94,
                'name' => 'user_alert_create',
            ],
            [
                'id'    => 95,
                'name' => 'user_alert_show',
            ],
            [
                'id'    => 96,
                'name' => 'user_alert_delete',
            ],
            [
                'id'    => 97,
                'name' => 'user_alert_access',
            ],
            [
                'id'    => 98,
                'name' => 'expense_management_access',
            ],
            [
                'id'    => 99,
                'name' => 'expense_category_create',
            ],
            [
                'id'    => 100,
                'name' => 'expense_category_edit',
            ],
            [
                'id'    => 101,
                'name' => 'expense_category_show',
            ],
            [
                'id'    => 102,
                'name' => 'expense_category_delete',
            ],
            [
                'id'    => 103,
                'name' => 'expense_category_access',
            ],
            [
                'id'    => 104,
                'name' => 'income_category_create',
            ],
            [
                'id'    => 105,
                'name' => 'income_category_edit',
            ],
            [
                'id'    => 106,
                'name' => 'income_category_show',
            ],
            [
                'id'    => 107,
                'name' => 'income_category_delete',
            ],
            [
                'id'    => 108,
                'name' => 'income_category_access',
            ],
            [
                'id'    => 109,
                'name' => 'expense_create',
            ],
            [
                'id'    => 110,
                'name' => 'expense_edit',
            ],
            [
                'id'    => 111,
                'name' => 'expense_show',
            ],
            [
                'id'    => 112,
                'name' => 'expense_delete',
            ],
            [
                'id'    => 113,
                'name' => 'expense_access',
            ],
            [
                'id'    => 114,
                'name' => 'income_create',
            ],
            [
                'id'    => 115,
                'name' => 'income_edit',
            ],
            [
                'id'    => 116,
                'name' => 'income_show',
            ],
            [
                'id'    => 117,
                'name' => 'income_delete',
            ],
            [
                'id'    => 118,
                'name' => 'income_access',
            ],
            [
                'id'    => 119,
                'name' => 'expense_report_create',
            ],
            [
                'id'    => 120,
                'name' => 'expense_report_edit',
            ],
            [
                'id'    => 121,
                'name' => 'expense_report_show',
            ],
            [
                'id'    => 122,
                'name' => 'expense_report_delete',
            ],
            [
                'id'    => 123,
                'name' => 'expense_report_access',
            ],
            [
                'id'    => 124,
                'name' => 'payment_history_access',
            ],
            [
                'id'    => 125,
                'name' => 'task_management_access',
            ],
            [
                'id'    => 126,
                'name' => 'task_status_create',
            ],
            [
                'id'    => 127,
                'name' => 'task_status_edit',
            ],
            [
                'id'    => 128,
                'name' => 'task_status_show',
            ],
            [
                'id'    => 129,
                'name' => 'task_status_delete',
            ],
            [
                'id'    => 130,
                'name' => 'task_status_access',
            ],
            [
                'id'    => 131,
                'name' => 'task_tag_create',
            ],
            [
                'id'    => 132,
                'name' => 'task_tag_edit',
            ],
            [
                'id'    => 133,
                'name' => 'task_tag_show',
            ],
            [
                'id'    => 134,
                'name' => 'task_tag_delete',
            ],
            [
                'id'    => 135,
                'name' => 'task_tag_access',
            ],
            [
                'id'    => 136,
                'name' => 'task_create',
            ],
            [
                'id'    => 137,
                'name' => 'task_edit',
            ],
            [
                'id'    => 138,
                'name' => 'task_show',
            ],
            [
                'id'    => 139,
                'name' => 'task_delete',
            ],
            [
                'id'    => 140,
                'name' => 'task_access',
            ],
            [
                'id'    => 141,
                'name' => 'tasks_calendar_access',
            ],
            [
                'id'    => 142,
                'name' => 'time_management_access',
            ],
            [
                'id'    => 143,
                'name' => 'time_work_type_create',
            ],
            [
                'id'    => 144,
                'name' => 'time_work_type_edit',
            ],
            [
                'id'    => 145,
                'name' => 'time_work_type_show',
            ],
            [
                'id'    => 146,
                'name' => 'time_work_type_delete',
            ],
            [
                'id'    => 147,
                'name' => 'time_work_type_access',
            ],
            [
                'id'    => 148,
                'name' => 'time_project_create',
            ],
            [
                'id'    => 149,
                'name' => 'time_project_edit',
            ],
            [
                'id'    => 150,
                'name' => 'time_project_show',
            ],
            [
                'id'    => 151,
                'name' => 'time_project_delete',
            ],
            [
                'id'    => 152,
                'name' => 'time_project_access',
            ],
            [
                'id'    => 153,
                'name' => 'time_entry_create',
            ],
            [
                'id'    => 154,
                'name' => 'time_entry_edit',
            ],
            [
                'id'    => 155,
                'name' => 'time_entry_show',
            ],
            [
                'id'    => 156,
                'name' => 'time_entry_delete',
            ],
            [
                'id'    => 157,
                'name' => 'time_entry_access',
            ],
            [
                'id'    => 158,
                'name' => 'time_report_create',
            ],
            [
                'id'    => 159,
                'name' => 'time_report_edit',
            ],
            [
                'id'    => 160,
                'name' => 'time_report_show',
            ],
            [
                'id'    => 161,
                'name' => 'time_report_delete',
            ],
            [
                'id'    => 162,
                'name' => 'time_report_access',
            ],
            [
                'id'    => 163,
                'name' => 'client_management_setting_access',
            ],
            [
                'id'    => 164,
                'name' => 'currency_create',
            ],
            [
                'id'    => 165,
                'name' => 'currency_edit',
            ],
            [
                'id'    => 166,
                'name' => 'currency_show',
            ],
            [
                'id'    => 167,
                'name' => 'currency_delete',
            ],
            [
                'id'    => 168,
                'name' => 'currency_access',
            ],
            [
                'id'    => 169,
                'name' => 'transaction_type_create',
            ],
            [
                'id'    => 170,
                'name' => 'transaction_type_edit',
            ],
            [
                'id'    => 171,
                'name' => 'transaction_type_show',
            ],
            [
                'id'    => 172,
                'name' => 'transaction_type_delete',
            ],
            [
                'id'    => 173,
                'name' => 'transaction_type_access',
            ],
            [
                'id'    => 174,
                'name' => 'income_source_create',
            ],
            [
                'id'    => 175,
                'name' => 'income_source_edit',
            ],
            [
                'id'    => 176,
                'name' => 'income_source_show',
            ],
            [
                'id'    => 177,
                'name' => 'income_source_delete',
            ],
            [
                'id'    => 178,
                'name' => 'income_source_access',
            ],
            [
                'id'    => 179,
                'name' => 'client_status_create',
            ],
            [
                'id'    => 180,
                'name' => 'client_status_edit',
            ],
            [
                'id'    => 181,
                'name' => 'client_status_show',
            ],
            [
                'id'    => 182,
                'name' => 'client_status_delete',
            ],
            [
                'id'    => 183,
                'name' => 'client_status_access',
            ],
            [
                'id'    => 184,
                'name' => 'project_status_create',
            ],
            [
                'id'    => 185,
                'name' => 'project_status_edit',
            ],
            [
                'id'    => 186,
                'name' => 'project_status_show',
            ],
            [
                'id'    => 187,
                'name' => 'project_status_delete',
            ],
            [
                'id'    => 188,
                'name' => 'project_status_access',
            ],
            [
                'id'    => 189,
                'name' => 'client_management_access',
            ],
            [
                'id'    => 190,
                'name' => 'client_create',
            ],
            [
                'id'    => 191,
                'name' => 'client_edit',
            ],
            [
                'id'    => 192,
                'name' => 'client_show',
            ],
            [
                'id'    => 193,
                'name' => 'client_delete',
            ],
            [
                'id'    => 194,
                'name' => 'client_access',
            ],
            [
                'id'    => 195,
                'name' => 'project_create',
            ],
            [
                'id'    => 196,
                'name' => 'project_edit',
            ],
            [
                'id'    => 197,
                'name' => 'project_show',
            ],
            [
                'id'    => 198,
                'name' => 'project_delete',
            ],
            [
                'id'    => 199,
                'name' => 'project_access',
            ],
            [
                'id'    => 200,
                'name' => 'note_create',
            ],
            [
                'id'    => 201,
                'name' => 'note_edit',
            ],
            [
                'id'    => 202,
                'name' => 'note_show',
            ],
            [
                'id'    => 203,
                'name' => 'note_delete',
            ],
            [
                'id'    => 204,
                'name' => 'note_access',
            ],
            [
                'id'    => 205,
                'name' => 'document_create',
            ],
            [
                'id'    => 206,
                'name' => 'document_edit',
            ],
            [
                'id'    => 207,
                'name' => 'document_show',
            ],
            [
                'id'    => 208,
                'name' => 'document_delete',
            ],
            [
                'id'    => 209,
                'name' => 'document_access',
            ],
            [
                'id'    => 210,
                'name' => 'transaction_create',
            ],
            [
                'id'    => 211,
                'name' => 'transaction_show',
            ],
            [
                'id'    => 212,
                'name' => 'transaction_access',
            ],
            [
                'id'    => 213,
                'name' => 'client_report_create',
            ],
            [
                'id'    => 214,
                'name' => 'client_report_edit',
            ],
            [
                'id'    => 215,
                'name' => 'client_report_show',
            ],
            [
                'id'    => 216,
                'name' => 'client_report_delete',
            ],
            [
                'id'    => 217,
                'name' => 'client_report_access',
            ],
            [
                'id'    => 218,
                'name' => 'house_type_create',
            ],
            [
                'id'    => 219,
                'name' => 'house_type_edit',
            ],
            [
                'id'    => 220,
                'name' => 'house_type_show',
            ],
            [
                'id'    => 221,
                'name' => 'house_type_delete',
            ],
            [
                'id'    => 222,
                'name' => 'house_type_access',
            ],
            [
                'id'    => 223,
                'name' => 'manage_price_create',
            ],
            [
                'id'    => 224,
                'name' => 'manage_price_edit',
            ],
            [
                'id'    => 225,
                'name' => 'manage_price_show',
            ],
            [
                'id'    => 226,
                'name' => 'manage_price_delete',
            ],
            [
                'id'    => 227,
                'name' => 'manage_price_access',
            ],
            [
                'id'    => 228,
                'name' => 'user_detail_create',
            ],
            [
                'id'    => 229,
                'name' => 'user_detail_edit',
            ],
            [
                'id'    => 230,
                'name' => 'user_detail_show',
            ],
            [
                'id'    => 231,
                'name' => 'user_detail_delete',
            ],
            [
                'id'    => 232,
                'name' => 'user_detail_access',
            ],
            [
                'id'    => 233,
                'name' => 'user_card_mgmt_create',
            ],
            [
                'id'    => 234,
                'name' => 'user_card_mgmt_edit',
            ],
            [
                'id'    => 235,
                'name' => 'user_card_mgmt_show',
            ],
            [
                'id'    => 236,
                'name' => 'user_card_mgmt_delete',
            ],
            [
                'id'    => 237,
                'name' => 'user_card_mgmt_access',
            ],
            [
                'id'    => 238,
                'name' => 'street_create',
            ],
            [
                'id'    => 239,
                'name' => 'street_edit',
            ],
            [
                'id'    => 240,
                'name' => 'street_show',
            ],
            [
                'id'    => 241,
                'name' => 'street_delete',
            ],
            [
                'id'    => 242,
                'name' => 'street_access',
            ],
            [
                'id'    => 243,
                'name' => 'payment_plan_create',
            ],
            [
                'id'    => 244,
                'name' => 'payment_plan_edit',
            ],
            [
                'id'    => 245,
                'name' => 'payment_plan_show',
            ],
            [
                'id'    => 246,
                'name' => 'payment_plan_delete',
            ],
            [
                'id'    => 247,
                'name' => 'payment_plan_access',
            ],
            [
                'id'    => 248,
                'name' => 'transaction_management_access',
            ],
            [
                'id'    => 249,
                'name' => 'setting_access',
            ],
            [
                'id'    => 250,
                'name' => 'home_owner_transaction_access',
            ],
            [
                'id'    => 251,
                'name' => 'payment_item_create',
            ],
            [
                'id'    => 252,
                'name' => 'payment_item_edit',
            ],
            [
                'id'    => 253,
                'name' => 'payment_item_show',
            ],
            [
                'id'    => 254,
                'name' => 'payment_item_delete',
            ],
            [
                'id'    => 255,
                'name' => 'payment_item_access',
            ],
            [
                'id'    => 256,
                'name' => 'payment_charge_create',
            ],
            [
                'id'    => 257,
                'name' => 'payment_charge_edit',
            ],
            [
                'id'    => 258,
                'name' => 'payment_charge_show',
            ],
            [
                'id'    => 259,
                'name' => 'payment_charge_delete',
            ],
            [
                'id'    => 260,
                'name' => 'payment_charge_access',
            ],
            [
                'id'    => 261,
                'name' => 'house_status_create',
            ],
            [
                'id'    => 262,
                'name' => 'house_status_edit',
            ],
            [
                'id'    => 263,
                'name' => 'house_status_show',
            ],
            [
                'id'    => 264,
                'name' => 'house_status_delete',
            ],
            [
                'id'    => 265,
                'name' => 'house_status_access',
            ],
            [
                'id'    => 266,
                'name' => 'open_project_create',
            ],
            [
                'id'    => 267,
                'name' => 'open_project_edit',
            ],
            [
                'id'    => 268,
                'name' => 'open_project_show',
            ],
            [
                'id'    => 269,
                'name' => 'open_project_delete',
            ],
            [
                'id'    => 270,
                'name' => 'open_project_access',
            ],
            [
                'id'    => 271,
                'name' => 'supplier_proposal_create',
            ],
            [
                'id'    => 272,
                'name' => 'supplier_proposal_edit',
            ],
            [
                'id'    => 273,
                'name' => 'supplier_proposal_show',
            ],
            [
                'id'    => 274,
                'name' => 'supplier_proposal_delete',
            ],
            [
                'id'    => 275,
                'name' => 'supplier_proposal_access',
            ],
            [
                'id'    => 276,
                'name' => 'complaint_management_access',
            ],
            [
                'id'    => 277,
                'name' => 'complaint_create',
            ],
            [
                'id'    => 278,
                'name' => 'complaint_edit',
            ],
            [
                'id'    => 279,
                'name' => 'complaint_show',
            ],
            [
                'id'    => 280,
                'name' => 'complaint_delete',
            ],
            [
                'id'    => 281,
                'name' => 'complaint_access',
            ],
            [
                'id'    => 282,
                'name' => 'complaint_status_create',
            ],
            [
                'id'    => 283,
                'name' => 'complaint_status_edit',
            ],
            [
                'id'    => 284,
                'name' => 'complaint_status_show',
            ],
            [
                'id'    => 285,
                'name' => 'complaint_status_delete',
            ],
            [
                'id'    => 286,
                'name' => 'complaint_status_access',
            ],
            [
                'id'    => 287,
                'name' => 'case_status_create',
            ],
            [
                'id'    => 288,
                'name' => 'case_status_edit',
            ],
            [
                'id'    => 289,
                'name' => 'case_status_show',
            ],
            [
                'id'    => 290,
                'name' => 'case_status_delete',
            ],
            [
                'id'    => 291,
                'name' => 'case_status_access',
            ],
            [
                'id'    => 292,
                'name' => 'profile_password_edit',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
