<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Ibu;
use App\Models\User;
use App\Models\Posyandu;
use App\Models\Pendamping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		return view('auth.login');
	}

	public function bayiBaruLahir()
	{
		return view('dashboard.bayi_baru_lahir');
	}
	public function pelayananDokter()
	{
		return view('dashboard.pelayanan_dokter');
	}

	public function pelayananKehamilan()
	{
		return view('dashboard.pelayanan_kehamilan');
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return view('auth.register', [
			'posyandu' => Posyandu::all(),
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$rules = [
			'nama_ibu' => 'required|string|max:255',
			'id_posyandu' => 'required|exists:posyandu,id_posyandu',
			'nik_ibu' => 'nullable|string|unique:ibu,nik',
			'nomor_jkn_ibu' => 'nullable|string|unique:ibu,no_jkn',
			'faskes_tk_1_ibu' => 'nullable|string|max:255',
			'faskes_rujukan_ibu' => 'nullable|string|max:255',
			'pembiayaan_ibu' => 'nullable|string|max:255',
			'golongan_darah_ibu' => 'nullable|string|max:10',
			'tempat_lahir_ibu' => 'nullable|string|max:255',
			'tanggal_lahir_ibu' => 'nullable|date',
			'pendidikan_ibu' => 'nullable|string|max:255',
			'pekerjaan_ibu' => 'nullable|string|max:255',
			'alamat_rumah_ibu' => 'nullable|string|max:255',
			'no_handphone_ibu' => 'required|numeric|unique:users,no_hp',

			'nama_suami' => 'nullable|string|max:255',
			'nik_suami' => 'nullable|string|unique:pendamping,nik',
			'nomor_jkn_suami' => 'nullable|string|unique:pendamping,nomor_jkn',
			'faskes_tk_1_suami' => 'nullable|string|max:255',
			'faskes_rujukan_suami' => 'nullable|string|max:255',
			'pembiayaan_suami' => 'nullable|string|max:255',
			'golongan_darah_suami' => 'nullable|string|max:10',
			'tempat_lahir_suami' => 'nullable|string|max:255',
			'tanggal_lahir_suami' => 'nullable|date',
			'pendidikan_suami' => 'nullable|string|max:255',
			'pekerjaan_suami' => 'nullable|string|max:255',
			'alamat_rumah_suami' => 'nullable|string|max:255',
			'no_handphone_suami' => 'nullable|numeric|unique:pendamping,no_hp',

			'puskesmas_domisili' => 'nullable|string|max:255',
			'no_register_kohort_ibu' => 'nullable|string|unique:ibu,no_register_kohort',
			'password' => 'required|string|min:8|confirmed',
		];

		$messages = [
			'nama_ibu.required' => 'Nama ibu wajib diisi.',
			'nik_ibu.unique' => 'NIK ibu sudah digunakan.',
			'nomor_jkn_ibu.unique' => 'Nomor JKN ibu sudah digunakan.',
			'id_posyandu.required' => 'Posyandu wajib dipilih.',
			'id_posyandu.exists' => 'Posyandu yang dipilih tidak valid.',
			'no_handphone_ibu.required' => 'No handphone ibu wajib diisi.',
			'no_handphone_ibu.unique' => 'No handphone ibu sudah digunakan.',
			'puskesmas_domisili.required' => 'Puskesmas domisili wajib diisi.',
			'no_register_kohort_ibu.required' => 'No Register Kohort Ibu wajib diisi.',
			'no_register_kohort_ibu.unique' => 'No Register Kohort Ibu sudah digunakan.',
			'password.required' => 'Password wajib diisi.',
			'password.min' => 'Password minimal 8 karakter.',
			'password.confirmed' => 'Konfirmasi password tidak sesuai.',
		];

		$validator = Validator::make($request->all(), $rules, $messages);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput();
		}

		DB::beginTransaction();

		try {
			// Create User
			$user = User::create([
				'nama' => $request->input('nama_ibu'),
				'no_hp' => $request->input('no_handphone_ibu'),
				'password' => Hash::make($request->input('password')),
			]);

			// Create Ibu
			$ibu = Ibu::create([
				'id_user' => $user->id_user,
				'nik' => $request->input('nik_ibu'),
				'no_jkn' => $request->input('nomor_jkn_ibu'),
				'faskes_tk_1' => $request->input('faskes_tk_1_ibu'),
				'faskes_rujukan' => $request->input('faskes_rujukan_ibu'),
				'pembiayaan' => $request->input('pembiayaan_ibu'),
				'golongan_darah' => $request->input('golongan_darah_ibu'),
				'tempat_lahir' => $request->input('tempat_lahir_ibu'),
				'tanggal_lahir' => $request->input('tanggal_lahir_ibu'),
				'pendidikan' => $request->input('pendidikan_ibu'),
				'pekerjaan' => $request->input('pekerjaan_ibu'),
				'alamat' => $request->input('alamat_rumah_ibu'),
				'puskesmas_domisili' => $request->input('puskesmas_domisili'),
				'no_register_kohort' => $request->input('no_register_kohort_ibu'),
				'id_posyandu' => $request->input('id_posyandu'),
			]);

			// Create Pendamping if provided
			if ($request->has('nama_suami')) {
				Pendamping::create([
					'id_ibu' => $ibu->id_ibu,
					'nama' => $request->input('nama_suami'),
					'nik' => $request->input('nik_suami'),
					'nomor_jkn' => $request->input('nomor_jkn_suami'),
					'faskes_tk_1' => $request->input('faskes_tk_1_suami'),
					'faskes_rujukan' => $request->input('faskes_rujukan_suami'),
					'pembiayaan' => $request->input('pembiayaan_suami'),
					'golongan_darah' => $request->input('golongan_darah_suami'),
					'tempat_lahir' => $request->input('tempat_lahir_suami'),
					'tanggal_lahir' => $request->input('tanggal_lahir_suami'),
					'pendidikan' => $request->input('pendidikan_suami'),
					'pekerjaan' => $request->input('pekerjaan_suami'),
					'alamat' => $request->input('alamat_rumah_suami'),
					'no_hp' => $request->input('no_handphone_suami'),
				]);
			}

			DB::commit();

			return redirect()->back()->with(
				'toast',
				[
					'type' => 'success',
					'message' => 'Pendaftaran berhasil dilakukan!'
				]
			);
		} catch (\Exception $e) {
			DB::rollBack();
			
			Log::error('Registration Error: ' . $e->getMessage());
			
			return back()->withErrors([
				'loginError' => 'Pendaftaran gagal: ' . $e->getMessage(), 
			])->with('toast', [
				'message' => 'Pendaftaran gagal: ' . $e->getMessage(),
				'type' => 'error'
			])->withInput();
		}
		
	}

	/**
	 * Display the specified resource.
	 */
	public function auth(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'no_hp' => 'required|string',
			'password' => 'required|string',
		], [
			'no_hp.required' => 'Nomor Handphone harus diisi.',
			'password.required' => 'Password harus diisi.',
		]);

		if ($validator->fails()) {
			return back()->withErrors($validator)->withInput();
		}

		$credentials = $request->only('no_hp', 'password');

		if (Auth::attempt($credentials)) {
			$request->session()->regenerate();

			$user = Auth::user();
			$userRole = $user->role;

			$loginTime = Carbon::now();
			$request->session()->put([
				'login_time' => $loginTime->toDateTimeString(),
				'nama' => $user->nama,
				'id_user' => $user->id_user,
				'no_hp' => $user->no_hp,
				'role' => $user->role,
				'created_at' => $user->created_at,
			]);

			if ($userRole === 'admin' || $userRole === 'user' || $userRole === 'super_admin') {
				return redirect()->intended('dashboard')->with('toast', [
					'message' => 'Login berhasil!',
					'type' => 'success'
				]);
			}

			return back()->with('toast', [
				'message' => 'Login gagal, role pengguna tidak dikenali.',
				'type' => 'error'
			])->withInput();
		}

		return back()->withErrors([
			'loginError' => 'Nomor Handphone atau password salah.',
		])->with('toast', [
			'message' => 'Nomor Handphone atau password salah.',
			'type' => 'error'
		])->withInput();
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function logout(Request $request)
	{
		Auth::logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();

		return redirect()->route('login')->with('toast', [
			'message' => 'Logout berhasil!',
			'type' => 'success'
		]);;
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		//
	}
}
