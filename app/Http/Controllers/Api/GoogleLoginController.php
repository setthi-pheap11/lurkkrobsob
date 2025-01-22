<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Exception;

class GoogleLoginController extends Controller
{
    /**
     * Handle the Google login process via a POST request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function googleLogin(Request $request): JsonResponse
    {
        // Validate that the access_token is provided
        $request->validate([
            'access_token' => 'required|string',
        ]);

        try {
            // Validate the Google token by calling Google API
            $googleValidationUrl = "https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token=" . $request->access_token;
            $googleResponse = Http::get($googleValidationUrl);

            if ($googleResponse->failed()) {
                return $this->sendErrorResponse('Invalid Google access token provided', 400);
            }

            $googleUserData = $googleResponse->json();

            // Find a user with the same google_id or email
            $existingUser = User::where('google_id', $googleUserData['id'])
                ->orWhere('email', $googleUserData['email'])
                ->first();

            if ($existingUser) {
                // Update google_id if not set
                if (!$existingUser->google_id) {
                    $existingUser->update([
                        'google_id' => $googleUserData['id'],
                    ]);
                }

                // Log the user in
                Auth::login($existingUser);

                // Generate token using Sanctum
                $token = $existingUser->createToken('GoogleLoginToken')->plainTextToken;

                // Return success response with token
                return $this->sendSuccessResponse('Login successful', 'ok', $token);
            } else {
                // Create a new user with data retrieved from Google
                $newUser = User::create([
                    'google_id' => $googleUserData['id'] ?? null,
                    'name' => $googleUserData['name'] ?? 'Google User',
                    'first_name' => $googleUserData['given_name'] ?? null,
                    'last_name' => $googleUserData['family_name'] ?? null,
                    'image' => $googleUserData['picture'] ?? null,
                    'email' => $googleUserData['email'] ?? null,
                    'password' => bcrypt('default'),
                ]);

                // Log the new user in
                Auth::login($newUser);

                // Generate token using Sanctum
                $token = $newUser->createToken('GoogleLoginToken')->plainTextToken;

                // Return success response with token
                return $this->sendSuccessResponse('Create Login successful', 'ok', $token);
            }
        } catch (Exception $e) {
            return $this->sendErrorResponse('Unable to login using Google. Please try again.', 500, $e->getMessage());
        }
    }

    /**
     * Format the success response structure.
     *
     * @param string $message
     * @param string $status
     * @param string $token
     * @return JsonResponse
     */
    private function sendSuccessResponse(string $message, string $status, string $token): JsonResponse
    {
        return response()->json([
            'status' => '200',
            'status_code' => $status,
            'message' => $message,
            'data' => [
                'token' => $token,
            ],
        ], 200);
    }

    /**
     * Format the error response structure.
     *
     * @param string $error
     * @param int $statusCode
     * @param string|null $details
     * @return JsonResponse
     */
    private function sendErrorResponse(string $error, int $statusCode, string $details = null): JsonResponse
    {
        $response = [
            'status' => (string) $statusCode,
            'status_code' => 'error',
            'message' => $error,
        ];

        if ($details) {
            $response['details'] = $details;
        }

        return response()->json($response, $statusCode);
    }
}
