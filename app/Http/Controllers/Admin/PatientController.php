<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = User::patients()->paginate(10);
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'DPI' => 'required|digits:13',
            'address' => 'nullable|min:6',
            'phone' => 'required',
        ];

        $messages = [
            'name.required' => 'El campo nombre es obligatorio',
            'name.min' => 'El campo nombre debe tener más de 3 caracteres',

            'email.required' => 'El campo correo electrónico es obligatorio',
            'email.email' => 'Ingrese un correo electrónico valido',

            'DPI.required' => 'El campo DPI es obligatorio',
            'DPI.digits' => 'El campo DPI debe contener 13 digitos',

            'address.min' => 'El campo address debe contener más de 6 caracteres',

            'phone.required' => 'El campo teléfono/móvil es obligatorio',

        ];
        $this->validate($request, $rules, $messages);

        $patient = new User;

        $patient->name = $request->name;
        $patient->email = $request->email;
        $patient->phone = $request->phone;
        $patient->DPI = $request->DPI;
        $patient->address = $request->address;
        $patient->role = 'paciente';
        $patient->password = bcrypt($request->input('password'));

        $patient->save();



        $notification = 'El paciente se registro correctamente';
        return redirect('/pacientes')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $patient = User::patients()->findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'DPI' => 'required|digits:13',
            'address' => 'nullable|min:6',
            'phone' => 'required',
        ];

        $messages = [
            'name.required' => 'El campo nombre es obligatorio',
            'name.min' => 'El campo nombre debe tener más de 3 caracteres',

            'email.required' => 'El campo correo electrónico es obligatorio',
            'email.email' => 'Ingrese un correo electrónico valido',

            'DPI.required' => 'El campo DPI es obligatorio',
            'DPI.digits' => 'El campo DPI debe contener 13 digitos',

            'address.min' => 'El campo address debe contener más de 6 caracteres',

            'phone.required' => 'El campo teléfono/móvil es obligatorio',

        ];
        $this->validate($request, $rules, $messages);
        $user = User::patients()->findOrFail($id);

        $data = $request->only('name', 'email', 'DPI', 'address', 'phone');
        $password = $request->input('password');


        if ($password) {
            $data['password'] = bcrypt($password);
        }
        $user->fill($data);
        $user->save();



        $notification = 'El paciente se actualizo correctamente';
        return redirect('/pacientes')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::patients()->findOrFail($id);
        $patientName = $user->name;

        $user->delete();

        $notification = "El paciente $patientName se elimino correctamente";

        return redirect('/medicos')->with(compact('notification'));
    }
}
