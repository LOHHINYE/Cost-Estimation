<?php

namespace App\Http\Controllers;

use App\Models\roles;
use App\Models\company_profit;
use App\Models\events;
use App\Models\hotels;
use App\Models\infrastructures;
use App\Models\marketings;
use App\Models\services;
use App\Models\transportations;
use Illuminate\Http\Request;

class manageRolesController extends Controller
{
    public function index()
    {
        $roles = roles::all();
        $events = events::all();
        $service = services::all();
        $hotel = hotels::all();
        $transportation = transportations::all();
        $infras = infrastructures::all();
        $market = marketings::all();
        $company = company_profit::first(); // get the first record
        return view('managerole', compact('roles', 'company', 'events', 'service', 'hotel', 'transportation', 'infras', 'market'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        roles::create($input);
        return redirect('roles')->withSuccess('Roles Addedd!');
    }

    public function edit($roles_ID)
    {
        $data = roles::find($roles_ID);
        return view('Maintances.Editroles')->with('roles', $data);
    }


    public function update(Request $request, $roles_ID)
    {
        $role = roles::find($roles_ID);
        $input = $request->all();
        $role->update($input);
        return redirect('roles')->withSuccess('Roles Updated!');
    }

    public function destroy($roles_ID)
    {
        try {
            roles::destroy($roles_ID);
            return redirect('roles')->with('info', 'Roles Deleted!');
        } catch (\Throwable $e) {
            return redirect('roles')->back()->with('message', $e->getMessage());
        }
    }

    public function update_company_profit(Request $request)
    {
        $company = company_profit::first();
        $company->company_profit = $request->input('profit');
        $company->otherFactor = $request->input('factor');
        $company->factor_1 = $request->input('factor_1');
        $company->factor_2 = $request->input('factor_2');
        $company->factor_3 = $request->input('factor_3');
        $company->factor_4 = $request->input('factor_4');
        $company->factor_5 = $request->input('factor_5');
        $company->factor_6 = $request->input('factor_6');
        $company->factor_7 = $request->input('factor_7');
        $company->save();
        return redirect('roles')->with('success', 'Data updated successfully.');
    }

    public function edit_services($id)
    {
        $data = services::find($id);
        return view('Maintances.EditServices')->with('services', $data);
    }

    public function update_services(Request $request, $id)
    {
        $ser = services::find($id);
        $input = $request->all();
        $ser->update($input);
        return redirect('roles')->withSuccess('Services Updated!');
    }

    public function service_store(Request $request)
    {
        $service = new services();
        $service->service_desc = $request->input('service');
        $service->save();

        return redirect('roles')->withSuccess('Services Addedd!');
    }

    public function service_destroy($id)
    {
        try {
            services::destroy($id);
            return redirect('roles')->with('info', 'Services Deleted!');
        } catch (\Throwable $e) {
            return redirect('roles')->back()->with('message', $e->getMessage());
        }
    }

    public function service_update(Request $request, $id)
    {
        $lec = services::find($id);
        $input = $request->all();
        $lec->update($input);
        return redirect('roles')->withSuccess('Roles Updated!');
    }

    public function edit_market($id)
    {
        $data = marketings::find($id);
        return view('Maintances.EditMarketing')->with('market', $data);
    }

    public function update_market(Request $request, $id)
    {
        $market = marketings::find($id);
        $input = $request->all();
        $market->update($input);
        return redirect('roles')->withSuccess('Marketing Updated!');
    }

    public function marketing_store(Request $request)
    {
        $market = new marketings();
        $market->marketing_desc = $request->input('marketing');
        $market->save();

        return redirect('roles')->withSuccess('Marketing Addedd!');
    }

    public function marketing_destroy($id)
    {
        try {
            marketings::destroy($id);
            return redirect('roles')->with('info', 'Marketing Deleted!');
        } catch (\Throwable $e) {
            return redirect('roles')->back()->with('message', $e->getMessage());
        }
    }

    public function edit_infrastructures($id)
    {
        $data = infrastructures::find($id);
        return view('Maintances.EditInfrastructure')->with('infras', $data);
    }

    public function update_infrastructures(Request $request, $id)
    {
        $infra = infrastructures::find($id);
        $input = $request->all();
        $infra->update($input);
        return redirect('roles')->withSuccess('Infrastructures Updated!');
    }

    public function infrastructure_store(Request $request)
    {
        $infrastructure = new infrastructures();
        $infrastructure->infrastructure_desc = $request->input('infrastructure');
        $infrastructure->save();

        return redirect('roles')->withSuccess('Infrastructure Addedd!');
    }

    public function infrastructure_destroy($id)
    {
        try {
            infrastructures::destroy($id);
            return redirect('roles')->with('info', 'Infrastructure Deleted!');
        } catch (\Throwable $e) {
            return redirect('roles')->back()->with('message', $e->getMessage());
        }
    }

    public function create_transportation()
    {
        return view('Maintances.AddTransportation');
    }

    public function edit_transportation($id)
    {
        $data = transportations::find($id);
        return view('Maintances.EditTransportation')->with('trans', $data);
    }

    public function update_transportation(Request $request, $id)
    {
        $trans = transportations::find($id);
        $input = $request->all();
        $trans->update($input);
        return redirect('roles')->withSuccess('Transportations Updated!');
    }

    public function transportation_store(Request $request)
    {
        $trans = new transportations();
        $trans->transportation_desc = $request->input('transportation');
        $trans->save();

        return redirect('roles')->withSuccess('Transportations Addedd!');
    }

    public function transportation_destroy($id)
    {
        try {
            transportations::destroy($id);
            return redirect('roles')->with('info', 'Transportations Deleted!');
        } catch (\Throwable $e) {
            return redirect('roles')->back()->with('message', $e->getMessage());
        }
    }

    public function create_hotel()
    {
        return view('Maintances.AddHotel');
    }

    public function edit_hotel($id)
    {
        $data = hotels::find($id);
        return view('Maintances.EditHotel')->with('hotels', $data);
    }

    public function update_hotel(Request $request, $id)
    {
        $hotel = hotels::find($id);
        $input = $request->all();
        $hotel->update($input);
        return redirect('roles')->withSuccess('Hotels Updated!');
    }

    public function hotel_store(Request $request)
    {
        $hotel = new hotels();
        $hotel->hotel_desc = $request->input('hotel');
        $hotel->save();

        return redirect('roles')->withSuccess('Hotel Addedd!');
    }

    public function hotel_destroy($id)
    {
        try {
            hotels::destroy($id);
            return redirect('roles')->with('info', 'Hotels Deleted!');
        } catch (\Throwable $e) {
            return redirect('roles')->back()->with('message', $e->getMessage());
        }
    }

    public function create_event()
    {
        return view('Maintances.AddEvent');
    }

    public function edit_event($id)
    {
        $data = events::find($id);
        return view('Maintances.EditEvent')->with('events', $data);
    }

    public function update_event(Request $request, $id)
    {
        $event = events::find($id);
        $input = $request->all();
        $event->update($input);
        return redirect('roles')->withSuccess('Event Updated!');
    }

    public function event_store(Request $request)
    {
        $event = new events();
        $event->event_desc = $request->input('event');
        $event->save();

        return redirect('roles')->withSuccess('Event Addedd!');
    }

    public function event_destroy($id)
    {
        try {
            events::destroy($id);
            return redirect('roles')->with('info', 'Event Deleted!');
        } catch (\Throwable $e) {
            return redirect('roles')->back()->with('message', $e->getMessage());
        }
    }

}
