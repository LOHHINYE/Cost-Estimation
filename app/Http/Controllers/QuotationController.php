<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\roles;
use App\Models\costs;
use App\Models\role_cost;
use Illuminate\Support\Facades\DB;
use App\Models\company_profit;
use App\Models\event_costs;
use App\Models\quotation_history;
use Illuminate\Support\Facades\Validator;
use App\Models\events;
use App\Models\hotel_costs;
use App\Models\services;
use App\Models\hotels;
use App\Models\infrastructure_costs;
use App\Models\transportations;
use App\Models\infrastructures;
use App\Models\marketing_costs;
use App\Models\marketings;
use App\Models\service_costs;
use App\Models\transportation_costs;
use Carbon\Carbon;

class QuotationController extends Controller
{
    public function costestimation()
    {
        $default_roles = roles::all()->take(3);
        $company_profit = company_profit::findOrFail(1);
        $roles = roles::all();
        $costs = costs::orderBy('created_at', 'desc')->get();
        $event = events::all();
        $service = services::all();
        $hotel = hotels::all();
        $transportation = transportations::all();
        $infrastructure = infrastructures::all();
        $marketing = marketings::all();
        return view('costestimation', compact('roles', 'default_roles', 'company_profit', 'costs', 'event', 'service', 'hotel', 'transportation', 'infrastructure', 'marketing'));
    }



    public function cost_estimation_save(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'Profile' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'sst' => 'required|numeric',
            'totalcost' => 'required|numeric',
            'factorRate' => 'required|numeric',
            'subtotal' => 'required|numeric',
            'subtotal_service' => 'required|numeric',
            'subtotal_event' => 'required|numeric',
            'subtotal_hotel' => 'required|numeric',
            'subtotal_transportation' => 'required|numeric',
            'subtotal_infrastructure' => 'required|numeric',
            'subtotal_marketing' => 'required|numeric',

            'role.*.role' => 'required|string|max:255',
            'role.*.salary_per_day' => 'required|numeric',
            'role.*.qty' => 'required|numeric',
            'role.*.day' => 'required|numeric',

            'services.*.services' => 'required|string|max:255',
            'services.*.pax' => 'required|numeric',
            'services.*.day' => 'required|numeric',
            'services.*.cost' => 'required|numeric',

            'event.*.event' => 'required|string|max:255',
            'event.*.pax' => 'required|numeric',
            'event.*.day' => 'required|numeric',
            'event.*.cost' => 'required|numeric',

            'hotel.*.hotel' => 'required|string|max:255',
            'hotel.*.pax' => 'required|numeric',
            'hotel.*.day' => 'required|numeric',
            'hotel.*.cost' => 'required|numeric',

            'transportation.*.transportation' => 'required|string|max:255',
            'transportation.*.pax' => 'required|numeric',
            'transportation.*.trip' => 'required|numeric',
            'transportation.*.cost' => 'required|numeric',

            'infrastructure.*.infrastructure' => 'required|string|max:255',
            'infrastructure.*.item' => 'required|numeric',
            'infrastructure.*.year' => 'required|numeric',
            'infrastructure.*.cost' => 'required|numeric',

            'marketing.*.marketing' => 'required|string|max:255',
            'marketing.*.item' => 'required|numeric',
            'marketing.*.cost' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ]);
        }

        // Create a new Cost record
        $cost = new costs();
        $cost->company_name = $request->input('company_name');
        $cost->Profile = $request->input('Profile');
        $cost->size = $request->input('size');
        $cost->sst = $request->input('sst');
        $cost->factorRate = $request->input('factorRate');
        $cost->totalcost = $request->input('total_esti');
        $cost->created_at = Carbon::now()->timezone('Asia/Kuala_Lumpur');

        $cost->role_sub = $request->input('subtotal');
        $cost->service_sub = $request->input('subtotal_service');
        $cost->event_sub = $request->input('subtotal_event');
        $cost->hotel_sub = $request->input('subtotal_hotel');
        $cost->trans_sub = $request->input('subtotal_transportation');
        $cost->infras_sub = $request->input('subtotal_infrastructure');
        $cost->market_sub = $request->input('subtotal_marketing');
        if ($request->has('monthCheckbox')) {
            $cost->is_checked = 1;
        }else{
            $cost->is_checked = 0;
        }
        $cost->save();

        $quotation_history = new quotation_history();
        $quotation_history->quotation_id = $cost->id; // Set quotation_id to the id of the $cost object
        $previous_total_cost = number_format($request->input('totalcost'),2);
        $quotation_history->previous_total_cost = $previous_total_cost;
        $previous_total_estimation = number_format($request->input('total_esti'),2);
        $quotation_history->previous_total_estimation = $previous_total_estimation;
        $quotation_history->created_at = Carbon::now()->timezone('Asia/Kuala_Lumpur');
        $quotation_history->save();

        // Create marketing records for each role in the request data
        $marketing = $request->input('marketing');
        if ($marketing) {
            foreach ($marketing as $marketingData) {
                $marketing_cost = new marketing_costs();
                $marketing_cost->marketings = $marketingData['marketing'];
                $marketing_cost->item = $marketingData['item'];
                $marketing_cost->cost = $marketingData['cost'];
                $marketing_cost->total = $marketingData['cost'] * $marketingData['item'];
                $marketing_cost->remark = $marketingData['remark'];
                $marketing_cost->cost_id = $cost->id;
                $marketing_cost->save();
            }
        }

        // Create infrastructure records for each role in the request data
        $infrastructure = $request->input('infrastructure');
        if($infrastructure){
            foreach ($infrastructure as $infrastructureData) {
                $infrastructure_cost = new infrastructure_costs();
                $infrastructure_cost->infrastructures = $infrastructureData['infrastructure'];
                $infrastructure_cost->item = $infrastructureData['item'];
                $infrastructure_cost->year = $infrastructureData['year'];
                $infrastructure_cost->cost = $infrastructureData['cost'];
                $infrastructure_cost->total = $infrastructureData['cost'] * $infrastructureData['item'] * $infrastructureData['year'];
                $infrastructure_cost->remark = $infrastructureData['remark'];
                $infrastructure_cost->cost_id = $cost->id;
                $infrastructure_cost->save();
            }
        }

        // Create Transportation records for each role in the request data
        $transportation = $request->input('transportation');
        if($transportation){
            foreach ($transportation as $transportationData) {
                $transportation_cost = new transportation_costs();
                $transportation_cost->transportations = $transportationData['transportation'];
                $transportation_cost->pax = $transportationData['pax'];
                $transportation_cost->trip = $transportationData['trip'];
                $transportation_cost->cost = $transportationData['cost'];
                $transportation_cost->total = $transportationData['cost'] * $transportationData['pax'] * $transportationData['trip'];
                $transportation_cost->remark = $transportationData['remark'];
                $transportation_cost->cost_id = $cost->id;
                $transportation_cost->save();
            }
        }

        // Create Hotel records for each role in the request data
        $hotel = $request->input('hotel');
        if($hotel){
            foreach ($hotel as $hotelData) {
                $hotel_cost = new hotel_costs();
                $hotel_cost->hotel = $hotelData['hotel'];
                $hotel_cost->pax = $hotelData['pax'];
                $hotel_cost->night = $hotelData['day'];
                $hotel_cost->cost = $hotelData['cost'];
                $hotel_cost->total = $hotelData['cost'] * $hotelData['pax'] * $hotelData['day'];
                $hotel_cost->remark = $hotelData['remark'];
                $hotel_cost->cost_id = $cost->id;
                $hotel_cost->save();
            }
        }

        // Create Event records for each role in the request data
        $event = $request->input('event');
        if($event){
            foreach ($event as $eventData) {
                $event_cost = new event_costs();
                $event_cost->events = $eventData['event'];
                $event_cost->pax = $eventData['pax'];
                $event_cost->day = $eventData['day'];
                $event_cost->cost = $eventData['cost'];
                $event_cost->total = $eventData['cost'] * $eventData['pax'] * $eventData['day'];
                $event_cost->remark = $eventData['remark'];
                $event_cost->cost_id = $cost->id;
                $event_cost->save();
            }
        }

        // Create Services records for each role in the request data
        $services = $request->input('services');
        if($services){
            foreach ($services as $servicesData) {
                $service_cost = new service_costs();
                $service_cost->services = $servicesData['services'];
                $service_cost->pax = $servicesData['pax'];
                $service_cost->day = $servicesData['day'];
                $service_cost->cost = $servicesData['cost'];
                $service_cost->total = $servicesData['cost'] * $servicesData['day'] * $servicesData['pax'];
                $service_cost->remark = $servicesData['remark'];
                $service_cost->cost_id = $cost->id;
                $service_cost->save();
            }
        }

        // Create Role records for each role in the request data
        $role = $request->input('role');
        if($role){
            foreach ($request->input('role') as $roleData) {
                $role_cost = new role_cost();
                $role_cost->role = $roleData['role'];
                $role_cost->salary_per_day = $roleData['salary_per_day'];
                $role_cost->qty = $roleData['qty'];
                $role_cost->day = $roleData['day'];
                $role_cost->total = $roleData['salary_per_day'] * $roleData['qty'] * $roleData['day'];
                $role_cost->cost_id = $cost->id;
                $role_cost->save();
            }
        }

        return redirect()->route('costestimation');
    }


    public function cost_estimation_update(Request $request, $id)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string|max:255',
            'Profile' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'sst' => 'required|numeric',
            'totalcost' => 'required|numeric',
            'subtotal' => 'required|numeric',
            'subtotal_service' => 'required|numeric',
            'subtotal_event' => 'required|numeric',
            'subtotal_hotel' => 'required|numeric',
            'subtotal_transportation' => 'required|numeric',
            'subtotal_infrastructure' => 'required|numeric',
            'subtotal_marketing' => 'required|numeric',

            'role.*.role' => 'required|string|max:255',
            'role.*.salary_per_day' => 'required|numeric',
            'role.*.qty' => 'required|numeric',
            'role.*.day' => 'required|numeric',

            'services.*.services' => 'required|string|max:255',
            'services.*.pax' => 'required|numeric',
            'services.*.day' => 'required|numeric',
            'services.*.cost' => 'required|numeric',

            'event.*.event' => 'required|string|max:255',
            'event.*.pax' => 'required|numeric',
            'event.*.day' => 'required|numeric',
            'event.*.cost' => 'required|numeric',

            'hotel.*.hotel' => 'required|string|max:255',
            'hotel.*.pax' => 'required|numeric',
            'hotel.*.day' => 'required|numeric',
            'hotel.*.cost' => 'required|numeric',

            'transportation.*.transportation' => 'required|string|max:255',
            'transportation.*.pax' => 'required|numeric',
            'transportation.*.trip' => 'required|numeric',
            'transportation.*.cost' => 'required|numeric',

            'infrastructure.*.infrastructure' => 'required|string|max:255',
            'infrastructure.*.item' => 'required|numeric',
            'infrastructure.*.year' => 'required|numeric',
            'infrastructure.*.cost' => 'required|numeric',

            'marketing.*.marketing' => 'required|string|max:255',
            'marketing.*.item' => 'required|numeric',
            'marketing.*.cost' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $validator->errors(),
            ]);
        }

        // Find the existing Cost record
        $cost = costs::find($id);

        // Update the Cost record with the request data
        $cost->company_name = $request->input('company_name');
        $cost->Profile = $request->input('Profile');
        $cost->size = $request->input('size');
        $cost->sst = $request->input('sst');
        $cost->totalcost = $request->input('total_esti');
        $cost->role_sub = $request->input('subtotal');
        $cost->service_sub = $request->input('subtotal_service');
        $cost->event_sub = $request->input('subtotal_event');
        $cost->hotel_sub = $request->input('subtotal_hotel');
        $cost->trans_sub = $request->input('subtotal_transportation');
        $cost->infras_sub = $request->input('subtotal_infrastructure');
        $cost->market_sub = $request->input('subtotal_marketing');
        if ($request->has('monthCheckbox')) {
            $cost->is_checked = 1;
        }else{
            $cost->is_checked = 0;
        }
        $cost->save();

        // Delete existing records for Cost record
        $role_cost = role_cost::where('cost_id', $id)->delete();
        $service_cost = service_costs::where('cost_id', $id)->delete();
        $event_cost = event_costs::where('cost_id', $id)->delete();
        $hotel_cost = hotel_costs::where('cost_id', $id)->delete();
        $infrastructure_cost = infrastructure_costs::where('cost_id', $id)->delete();
        $marketing_cost = marketing_costs::where('cost_id', $id)->delete();
        $transportation_cost = transportation_costs::where('cost_id', $id)->delete();

        $quotation_history = new quotation_history();
        $quotation_history->quotation_id = $cost->id; // Set quotation_id to the id of the $cost object
        $previous_total_cost = number_format($request->input('totalcost'),2);
        $quotation_history->previous_total_cost = $previous_total_cost;
        $previous_total_estimation = number_format($request->input('total_esti'),2);
        $quotation_history->previous_total_estimation = $previous_total_estimation;
        $quotation_history->save();

        // Create marketing records for each role in the request data
        $marketing = $request->input('marketing');
        if ($marketing) {
            foreach ($marketing as $marketingData) {
                $marketing_cost = new marketing_costs();
                $marketing_cost->marketings = $marketingData['marketing'];
                $marketing_cost->item = $marketingData['item'];
                $marketing_cost->cost = $marketingData['cost'];
                $marketing_cost->total = $marketingData['cost'] * $marketingData['item'];
                $marketing_cost->remark = $marketingData['remark'];
                $marketing_cost->cost_id = $cost->id;
                $marketing_cost->save();
            }
        }

        // Create infrastructure records for each role in the request data
        $infrastructure = $request->input('infrastructure');
        if($infrastructure){
            foreach ($infrastructure as $infrastructureData) {
                $infrastructure_cost = new infrastructure_costs();
                $infrastructure_cost->infrastructures = $infrastructureData['infrastructure'];
                $infrastructure_cost->item = $infrastructureData['item'];
                $infrastructure_cost->year = $infrastructureData['year'];
                $infrastructure_cost->cost = $infrastructureData['cost'];
                $infrastructure_cost->total = $infrastructureData['cost'] * $infrastructureData['item'] * $infrastructureData['year'];
                $infrastructure_cost->remark = $infrastructureData['remark'];
                $infrastructure_cost->cost_id = $cost->id;
                $infrastructure_cost->save();
            }
        }

        // Create Transportation records for each role in the request data
        $transportation = $request->input('transportation');
        if($transportation){
            foreach ($transportation as $transportationData) {
                $transportation_cost = new transportation_costs();
                $transportation_cost->transportations = $transportationData['transportation'];
                $transportation_cost->pax = $transportationData['pax'];
                $transportation_cost->trip = $transportationData['trip'];
                $transportation_cost->cost = $transportationData['cost'];
                $transportation_cost->total = $transportationData['cost'] * $transportationData['pax'] * $transportationData['trip'];
                $transportation_cost->remark = $transportationData['remark'];
                $transportation_cost->cost_id = $cost->id;
                $transportation_cost->save();
            }
        }

        // Create Hotel records for each role in the request data
        $hotel = $request->input('hotel');
        if($hotel){
            foreach ($hotel as $hotelData) {
                $hotel_cost = new hotel_costs();
                $hotel_cost->hotel = $hotelData['hotel'];
                $hotel_cost->pax = $hotelData['pax'];
                $hotel_cost->night = $hotelData['day'];
                $hotel_cost->cost = $hotelData['cost'];
                $hotel_cost->total = $hotelData['cost'] * $hotelData['pax'] * $hotelData['day'];
                $hotel_cost->remark = $hotelData['remark'];
                $hotel_cost->cost_id = $cost->id;
                $hotel_cost->save();
            }
        }

        // Create Event records for each role in the request data
        $event = $request->input('event');
        if($event){
            foreach ($event as $eventData) {
                $event_cost = new event_costs();
                $event_cost->events = $eventData['event'];
                $event_cost->pax = $eventData['pax'];
                $event_cost->day = $eventData['day'];
                $event_cost->cost = $eventData['cost'];
                $event_cost->total = $eventData['cost'] * $eventData['pax'] * $eventData['day'];
                $event_cost->remark = $eventData['remark'];
                $event_cost->cost_id = $cost->id;
                $event_cost->save();
            }
        }

        // Create Services records for each role in the request data
        $services = $request->input('services');
        if($services){
            foreach ($services as $servicesData) {
                $service_cost = new service_costs();
                $service_cost->services = $servicesData['services'];
                $service_cost->pax = $servicesData['pax'];
                $service_cost->day = $servicesData['day'];
                $service_cost->cost = $servicesData['cost'] ;
                $service_cost->total = $servicesData['cost'] * $servicesData['pax'] * $servicesData['day'];
                $service_cost->remark = $servicesData['remark'];
                $service_cost->cost_id = $cost->id;
                $service_cost->save();
            }
        }

        // Create Role records for each role in the request data
        $role = $request->input('role');
        if($role){
            foreach ($request->input('role') as $roleData) {
                $role_cost = new role_cost();
                $role_cost->role = $roleData['role'];
                $role_cost->salary_per_day = $roleData['salary_per_day'];
                $role_cost->qty = $roleData['qty'];
                $role_cost->day = $roleData['day'];
                $role_cost->total = $roleData['salary_per_day'] * $roleData['qty'] * $roleData['day'];
                $role_cost->cost_id = $cost->id;
                $role_cost->save();
            }
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            costs::destroy($id);
            return redirect('costestimation')->with('info', 'Quotation Deleted!');
        } catch (\Throwable $e) {
            return redirect('costestimation')->back()->with('message', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $cost = costs::find($id);
        $roles = roles::all();
        $service = services::all();
        $event = events::all();
        $hotel = hotels::all();
        $transportation = transportations::all();
        $infrastructure = infrastructures::all();
        $marketing = marketings::all();
        $role_cost = role_cost::where('cost_id', $id)->get();
        $event_cost = event_costs::where('cost_id', $id)->get();
        $hotel_cost = hotel_costs::where('cost_id', $id)->get();
        $service_cost = service_costs::where('cost_id', $id)->get();
        $trans_cost = transportation_costs::where('cost_id', $id)->get();
        $infras_cost = infrastructure_costs::where('cost_id', $id)->get();
        $market_cost = marketing_costs::where('cost_id', $id)->get();
        $company_profit = company_profit::findOrFail(1);
        $quotation_history = quotation_history::where('quotation_id', $id)->get();

        return view('editquotation', compact(
            'cost',
            'roles',
            'service',
            'event',
            'hotel',
            'transportation',
            'infrastructure',
            'marketing',
            'role_cost',
            'company_profit',
            'quotation_history',
            'event_cost',
            'hotel_cost',
            'service_cost',
            'trans_cost',
            'market_cost',
            'infras_cost',
        ));
    }

    public function role_costs()
    {
        return $this->hasMany('App\Models\role_cost');
    }

    public function service_costs()
    {
        return $this->hasMany('App\Models\service_costs');
    }

    public function event_costs()
    {
        return $this->hasMany('App\Models\event_costs');
    }

    public function hotel_costs()
    {
        return $this->hasMany('App\Models\hotel_costs');
    }

    public function infrastructure_costs()
    {
        return $this->hasMany('App\Models\infrastructure_costs');
    }

    public function marketing_costs()
    {
        return $this->hasMany('App\Models\marketing_costs');
    }

    public function transportation_costs()
    {
        return $this->hasMany('App\Models\transportation_costs');
    }
}
