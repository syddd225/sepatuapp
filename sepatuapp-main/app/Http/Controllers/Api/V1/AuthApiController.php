<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;

/**
 * AuthApiController
 * 
 * Mengatur autentikasi API pengguna
 * - Registrasi pengguna baru
 * - Login dan generate token
 * - Logout dan hapus token
 * - Profil pengguna
 */
class AuthApiController extends Controller
{
    /**
     * Registrasi pengguna baru
     * 
     * POST /api/v1/auth/register
     * 
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            // Validasi sudah dilakukan di RegisterRequest
            $validated = $request->validated();

            // Buat user baru
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // Generate token
            $token = $user->createToken('auth-token')->plainTextToken;

            Log::info('User berhasil terdaftar', ['user_id' => $user->id]);

            return response()->json([
                'success' => true,
                'message' => 'Pendaftaran berhasil',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                    ],
                    'token' => $token,
                    'token_type' => 'Bearer',
                ]
            ], 201);
        } catch (Exception $e) {
            Log::error('Gagal mendaftarkan user', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal melakukan pendaftaran',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Login pengguna
     * 
     * POST /api/v1/auth/login
     * 
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();

            // Cari user berdasarkan email
            $user = User::where('email', $validated['email'])->first();

            // Validasi password
            if (!$user || !Hash::check($validated['password'], $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email atau password salah'
                ], 401);
            }

            // Hapus token lama jika ada
            $user->tokens()->delete();

            // Generate token baru
            $token = $user->createToken('auth-token')->plainTextToken;

            Log::info('User berhasil login', ['user_id' => $user->id]);

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                    ],
                    'token' => $token,
                    'token_type' => 'Bearer',
                ]
            ], 200);
        } catch (Exception $e) {
            Log::error('Gagal login', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal melakukan login',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Logout pengguna
     * 
     * POST /api/v1/auth/logout
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        try {
            // Hapus token saat ini
            $request->user()->currentAccessToken()->delete();

            Log::info('User berhasil logout', ['user_id' => $request->user()->id]);

            return response()->json([
                'success' => true,
                'message' => 'Logout berhasil'
            ], 200);
        } catch (Exception $e) {
            Log::error('Gagal logout', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal melakukan logout',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Dapatkan profil pengguna yang login
     * 
     * GET /api/v1/user
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function profile(Request $request): JsonResponse
    {
        try {
            $user = $request->user();

            return response()->json([
                'success' => true,
                'message' => 'Profil pengguna',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'created_at' => $user->created_at,
                        'updated_at' => $user->updated_at,
                    ]
                ]
            ], 200);
        } catch (Exception $e) {
            Log::error('Gagal mengambil profil', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil profil',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update profil pengguna
     * 
     * PUT /api/v1/user
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function updateProfile(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'email' => 'sometimes|required|email|unique:users,email,' . $request->user()->id,
            ]);

            $user = $request->user();
            $user->update($validated);

            Log::info('Profil pengguna berhasil diupdate', ['user_id' => $user->id]);

            return response()->json([
                'success' => true,
                'message' => 'Profil berhasil diupdate',
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'updated_at' => $user->updated_at,
                    ]
                ]
            ], 200);
        } catch (Exception $e) {
            Log::error('Gagal update profil', ['error' => $e->getMessage()]);
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate profil',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
