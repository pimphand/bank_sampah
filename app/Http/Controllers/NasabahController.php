<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class NasabahController extends Controller
{

    protected $role;
    protected $admin;
    protected $cre;
    public function __construct()
    {
        $this->role = 'nasabah';
        if (request()->routeIs('admin.index') || request()->routeIs('admin.store')) {
            $this->role = 'admin';
        }
        $this->admin = request()->routeIs('admin.index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.nasabah.index', [
            "nasabah" => User::where('role', $this->role ?? "nasabah")->get(),
            "role" => $this->role,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validate([
            "nama" => 'required',
            "username" => ['required', Rule::unique('users')],
            "email" => 'required', Rule::unique('users'),
            "password" => 'required',
            "no_hp" => 'required',
            "alamat" => 'required',
        ], [
            "nama.required" => "Nama tidak boleh kosong.",
            "username.required" => "Username tidak boleh kosong.",
            "email.required" => "Email tidak boleh kosong.",
            "password.required" => "Password tidak boleh kosong.",
            "no_hp.required" => "No telepon tidak boleh kosong.",
            "alamat.required" => "Alamat tidak boleh kosong.",
        ]);

        $data['role'] = $this->role;
        $data['password'] = Hash::make($request->password);
        $data = User::create($data);
        return back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->validated();
        $user = User::find($id);

        $data['password'] = $request->password ? Hash::make($request->password) : $user->password;

        $user->update($data);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return User::destroy($id);
    }

    public function saldo(Request $request, $id)
    {
        $user  = User::find($id);
        $user->saldo = $request->saldo;
        $user->save();

        return back();
    }
}
