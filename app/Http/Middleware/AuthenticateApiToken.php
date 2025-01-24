<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Token;
class AuthenticateApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Obtener el token del encabezado de la solicitud
         $token = $request->header('Authorization');
         // Si campo Autorization esta vacio, se envia un mensaje de error
         if (empty($token)) {
            return response()->json(['error' => 'Token no proporcionado'], 401);
         }
         // Verificar si el token existe en la base de datos
         $tokenDB = Token::where('token', $token)->first();
         // Si el token existe, verificar si ha expirado
         if ($tokenDB && $tokenDB->expires_at > now()) {
            // Si el token no ha expirado, agregar el token a la solicitud
            $request->merge(['token' => $tokenDB->token]);
            // Continuar con la solicitud
            return $next($request);
            }
        // Si el token no existe o ha expirado, devolver un error
        return response()->json(['error' => 'Token no válido'], 401);

    }
}
