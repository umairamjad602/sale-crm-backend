<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Auth\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User as ThisModel;
use Exception;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    const COLLECTION_NAME = 'user';
    const ACCOUNT_REGISTERED = 'Registration successfullt';
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(ThisModel $model)
    {
        $this->model_ = $model;
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function register(RegisterRequest $request) {
        try {
            $this->model_->first_name = $request->first_name;
            $this->model_->last_name = $request->last_name;
            $this->model_->email = $request->email;
            $this->model_->password = Hash::make($request->password);
            $this->model_->confirm_password = Hash::make($request->confirm_password);
            $this->model_->mobile = $request->mobile;
            if ($this->model_->save()) {
                return $this->HttpOk([['message' => AuthController::ACCOUNT_REGISTERED]]);
            }
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($token = $this->guard()->attempt($credentials)) {
            return $this->respondWithToken($token);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json($this->guard()->user());
    }

    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        return Auth::guard('api');
    }

    // public function me() {
    //     try {
    //         return $this->HttpOk(['user' => $this->CurrentUserData()]);
    //     } catch (Exception $ex) {
    //         return $this->serverError($ex);
    //     }
    // }

}
