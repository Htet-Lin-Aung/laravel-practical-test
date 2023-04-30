<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use Illuminate\Database\QueryException;

class AuthController extends Controller
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {   
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
            
            $data = new UserResource($user);

            return response()->json([
                'data' => $data,
            ],Response::HTTP_OK);

        } catch (QueryException $e) {
            // Handle any database query exceptions here
            abort(Response::HTTP_INTERNAL_SERVER_ERROR,"An error occurred while creating a user.");

        } catch (\Exception $e) {
            // Handle any other exceptions here
            abort(Response::HTTP_INTERNAL_SERVER_ERROR,"Internal server error.");
        }
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (!Auth::attempt($credentials)) {
                return response()->json(['message' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
            }

            $user = Auth::user();

            $data = new UserResource($user);

            return response()->json([
                'data' => $data,
                'access_token' => $user->createToken('auth_token')->plainTextToken,
                'token_type' => 'Bearer',
            ],Response::HTTP_OK);
        } catch (\Exception $e) {
            // Handle any other exceptions here
            abort(Response::HTTP_INTERNAL_SERVER_ERROR,"Internal server error.");
        }
    }

    /**
     * Logout api
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        try {
            auth()->user()->tokens()->delete();

            return response()->json([
                'message' => 'You have successfully logged out.'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            // Handle any other exceptions here
            abort(Response::HTTP_INTERNAL_SERVER_ERROR,"An error occurred while logging out.");
        }
    }

}
