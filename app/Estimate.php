<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    protected $fillable = ['estimate_id', '	opportunity_id', 'email', 'telephone', 'busID', 'vehicle_licence', 'date', 'service_type', 'make', 'model', 'service_option', 'service_item_spec', 'manufacturer', 'material_qty', 'material_cost', 'labour_qty', 'labour_cost', 'other_qty', 'other_cost', 'total_cost', 'service_note', 'mileage', 'chassis_no', 'location', 'file', 'update_by', 'created_at', 'updated_at', 'material_qty2', 'material_qty3','material_qty4','material_qty5','material_qty6','material_qty7','material_qty8','material_qty9','material_qty10', 'labour_qty2','labour_qty3','labour_qty4','labour_qty5','labour_qty6','labour_qty7','labour_qty8','labour_qty9','labour_qty10', 'material_cost2', 'material_cost3','material_cost4','material_cost5','material_cost6','material_cost7','material_cost8','material_cost9','material_cost10', 'labour_cost2','labour_cost3','labour_cost4','labour_cost5','labour_cost6','labour_cost7','labour_cost8','labour_cost9','labour_cost10', 'labour_hour', 'labour_rate', 'manufacturer2', 'manufacturer3', 'service_item_spec2', 'service_item_spec3', 'estimate', 'work_order', 'diagnostics', 'maintenance', 'inventory_list', 'inventory_amount', 'inventory_note', 'inventory_list2', 'inventory_amount2', 'inventory_note2', 'inventory_list3', 'inventory_amount3', 'inventory_note3', 'technician', 'technician_payment'];

    protected $table = "estimate";
}
