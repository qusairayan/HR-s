<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConvertHtmlToJson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


     public function handle(Request $request, Closure $next)
     {
         // Get the response from the next middleware or controller
         $response = $next($request);
 
         // Check if the response is an HTML error
         if ($response->isServerError() && $request->wantsJson()) {
             // Convert the HTML error to JSON
             $jsonResponse = [
                 'error' => [
                     'message' => 'Internal Server Error',
                     'status_code' => 500,
                 ],
             ];
 
             // Replace the original response with the JSON response
             $response->setContent($jsonResponse);
 
             // Set the content type to JSON
             $response->header('Content-Type', 'application/json');
         }
 
         return $response;
     }

    // public function handle(Request $request, Closure $next): Response
    // {
        
    //     return $next($request);
    // }
}
