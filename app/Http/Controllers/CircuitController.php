<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHolidayRequest;
use App\Models\Demande;
use App\Models\Habilete;
use App\Models\IndexTraitement;
use App\Models\PointEnrolement;
use App\Models\PublicHoliday;
use App\Models\Service;
use Exception;
use Illuminate\Http\Request;

class CircuitController extends Controller
{
    public function index()
    {

        $services = Service::get();
        $allHabiletes = Habilete::all();
        $service_array = [];

        if ($services) {
            foreach ($services as $service) {
                $habiletes = $service->habiletes;
                $habiletes = is_array($habiletes) ? $habiletes : (is_null($habiletes) ? [] : json_decode($habiletes, true));
                $outputArray = [];
                foreach ($habiletes as $item) {
                    $outputArray[] = json_decode($item);
                }

                $habiletes = $outputArray;

                $habiletes_array = [];

                if (count($habiletes) > 0) {
                    foreach ($habiletes as $id) {
                        $habilete = Habilete::whereIn('id', $id)->get();
                        $habiletes_array[] = $habilete;
                    }
                }

                $service_data = [];
                $service_data['id'] = $service->id;
                $service_data['name'] = $service->name;
                $service_data['habiletes'] = $habiletes_array;

                $service_array[] = $service_data;
            }
        }

        $circuits = $service_array;
        return view('admin.workflow.circuit', compact('circuits', 'allHabiletes'));
    }

    public function update(Request $request,  $id)
    {
        try {
            $service = Service::find($id);

            if ($service) {

                // Get Old habiletes
                $oldLabiletes = $service->habiletes;
                $oldLabiletes = is_array($oldLabiletes) ? $oldLabiletes : (is_null($oldLabiletes) ? [] : json_decode($oldLabiletes, true));

                $oldOutputArray = [];

                foreach ($oldLabiletes as $item) {
                    $oldOutputArray[] = array_map('intval', json_decode($item, true));
                }

                $oldLabiletes = $oldOutputArray;
                // End Get Old habiletes


                $habiletes = [];
                $habiletes = array_merge($habiletes, $request->all());

                // Filter the array to get the key-value pairs with keys starting with circuit_select_
                $filteredArray = [];

                foreach ($habiletes as $key => $value) {
                    if (strpos($key, 'circuit_select_') === 0) {
                        $filteredArray[$key] = $value;
                    }
                }

                $habilete_values = [];
                $newHabiletes = [];
                foreach ($filteredArray as $key => $value) {
                    $habilete_values[] = json_encode($value);
                    $newHabiletes[] = $value;
                }

                // Mise à jour de l'index de traitement
                if (count($newHabiletes) > 0) {
                    foreach ($newHabiletes as $key => $value) {
                        $hab = array_map('intval', $value);
                        if (count($hab) > 0) {
                            foreach ($hab as $key2 => $value2) {
                                $indexT = IndexTraitement::where('habilete_id', $value2)->first();
                                if ($indexT) {
                                    if (isset($oldLabiletes[$key]) && isset($oldLabiletes[$key][$key2])) {
                                        if ($indexT) {
                                            $indexT->habilete_id = $oldLabiletes[$key][$key2];
                                            $indexT->save();
                                        }
                                    } else {
                                        $demande = Demande::find($indexT->id_demande);
                                        if ($demande) {
                                            $demande->habilete_position = 0;
                                            $demande->status_demande = "RESETTED";
                                            $demande->save();
                                        }
                                        $indexT->delete();
                                    }
                                }
                            }
                        }
                    }
                }

                $service->habiletes = $habilete_values;
                $service->save();

                return redirect()->back()->with('admin.workflow.circuit')->with('success_message', 'Le Circuit a été mis à jour');
            } else {
                return redirect()->back()->with('admin.workflow.circuit')->with('error_message', 'Echec de la misse à jour');
            }
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function destroy($id)
    {

        try {
            $service = Service::find($id);
            $service->habiletes = json_encode([]);
            $service->save();
            return redirect()->back()->with('admin.workflow.circuit')->with('success_message', 'Le Circuit a été supprimé avec succes');
        } catch (Exception $e) {
            return redirect()->back()->with('admin.workflow.circuit')->with('error_message', 'Erreur de suppression');
        }
    }

    public function add($id)
    {

        $service = Service::find($id);
        $allHabiletes = Habilete::all();
        $service_array = [];

        if ($service) {
            $habiletes = $service->habiletes;
            $habiletes = is_array($habiletes) ? $habiletes : (is_null($habiletes) ? [] : json_decode($habiletes, true));
            $outputArray = [];
            foreach ($habiletes as $item) {
                $outputArray[] = json_decode($item);
            }

            $habiletes = $outputArray;

            $habiletes_array = [];

            if (count($habiletes) > 0) {
                foreach ($habiletes as $id) {
                    $habilete = Habilete::whereIn('id', $id)->get();
                    $habiletes_array[] = $habilete;
                }
            }

            $service_data = [];
            $service_data['id'] = $service->id;
            $service_data['name'] = $service->name;
            $service_data['habiletes'] = $habiletes_array;

            $service_array[] = $service_data;
        }

        $circuit = current($service_array);

        return view('admin.workflow.circuit-add', compact('circuit', 'allHabiletes'));
    }
}
