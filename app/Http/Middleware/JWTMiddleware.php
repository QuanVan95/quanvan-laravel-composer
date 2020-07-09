<?php


namespace App\Http\Middleware;


use App\Helpers\ResponseFormat;
use Closure;
use Firebase\JWT\JWT;

class JWTMiddleware
{
    const ERROR_CODE = 0;
    public function handle($request, Closure $next)
    {
        if (empty($request->header('Authorization'))) {
            return ResponseFormat::response(self::ERROR_CODE, 'Empty authorization header', '', 401);
        }
        $token = trim($request->bearerToken());

        if (!$token) {
            return ResponseFormat::response(self::ERROR_CODE, 'Token does not exist', '', 401);
        }

        try {
            $token_data = JWT::decode($token, config('jwt.JWT_SECRET'), ['HS256']);
            if (!empty($token_data->exp)) { #Check if token is expired
                $now = time();
                $is_expired = $token_data->exp - $now;

                if ($is_expired < 0) {
                    return ResponseFormat::response(self::ERROR_CODE, 'Token is expired', '', 401);
                }else {
                    return $next($request);
                }
            }
        } catch (\Exception $e) {
            return ResponseFormat::response(self::ERROR_CODE, 'Invalid token', '', 401);
        }

        return $next($request);
    }
}
