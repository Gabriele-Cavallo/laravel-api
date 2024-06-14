<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContact;


class LeadController extends Controller
{
    public function store(Request $request) {
        $data = $request->all();

        // Valido i dati
        $validator = Validator::make($data,
         [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'message' => 'required',
            'accepted_tc' => 'required|boolean|accepted'
        ],
        [
            'accepted_tc.required' => 'You must accept terms and conditions',
            'accepted_tc.accepted' => 'You must accept terms and conditions',
        ]);

        // Se ci sono errori torno la risposta di errore
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        // Altrimenti salvo nel db il lead
        $newLead = new Lead();
        $newLead->fill($data);
        $newLead->save();

        // Invio la mail
        Mail::to('admin@boolpress.com')->send(new NewContact($newLead));

        // Dopo aver salvato i dati correttamente torno il messaggio di successo
        return response()->json([
            'success' => true
        ]);
    }
}
