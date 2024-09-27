<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Lista de excepciones que no se reportan.
     *
     * @var array
     */
    protected $dontReport = [
        // Puedes listar aquí las excepciones que no quieres que se reporten
    ];

    /**
     * Lista de las entradas que no se incluirán en el log.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Reportar o registrar una excepción.
     *
     * @param  \Throwable  $exception
     * @return void
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Renderizar una excepción en una respuesta HTTP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }

    /**
     * Manejar excepciones de autenticación.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        // Si la solicitud espera una respuesta JSON, devolvemos un error 401
        if ($request->expectsJson()) {
            return response()->json(['error' => 'No autenticado.'], 401);
        }

        // Si no es una petición API, redirige a la página de inicio de sesión
        return redirect()->guest(route('login'));
    }
}
