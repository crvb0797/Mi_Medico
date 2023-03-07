<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Specialty;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = User::doctors()->paginate(10);
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialties = Specialty::all();
        return view('doctors.create', compact('specialties'));
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

        $user = User::create(
            $request->only('name', 'email', 'DPI', 'address', 'phone') + ['role' => 'doctor', 'password' => bcrypt($request->input('password'))]
        );

        $user->specialties()->attach($request->input('specialties'));

        /* $doctor = new User;

        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->phone = $request->phone;
        $doctor->DPI = $request->DPI;
        $doctor->address = $request->address;
        $doctor->role = 'doctor';
        $doctor->password = bcrypt($request->input('password'));
        $doctor->specialty_id = $doctor->specialties()->attach($request->specialties);


        $doctor->save(); */



        $notification = 'El médico se registro correctamente';
        return redirect('/medicos')->with(compact('notification'));
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
    public function edit($id)
    {
        $doctor = User::doctors()->findOrFail($id);
        $specialties = Specialty::all();
        $specialty_ids = $doctor->specialties()->pluck('specialties.id');
        return view('doctors.edit', compact('doctor', 'specialties', 'specialty_ids'));
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
        $user = User::doctors()->findOrFail($id);

        $data = $request->only('name', 'email', 'DPI', 'address', 'phone');
        $password = $request->input('password');


        if ($password) {
            $data['password'] = bcrypt($password);
        }
        $user->fill($data);
        $user->save();

        $user->specialties()->sync($request->specialties);


        $notification = 'El médico se actualizo correctamente';
        return redirect('/medicos')->with(compact('notification'));
    }

    public function destroy(string $id)
    {
        $user = User::doctors()->findOrFail($id);
        $doctorName = $user->name;

        $user->delete();

        $notification = "El médico $doctorName se elimino correctamente";

        return redirect('/medicos')->with(compact('notification'));
    }
}
