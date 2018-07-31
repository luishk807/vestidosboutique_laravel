<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;


use App\vestidosBrands as Brands;
use App\vestidosCategories as Categories;
use App\vestidosProducts as Products;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

        if ($exception instanceof ModelNotFoundException) 
        {
            $exception = new NotFoundHttpException($exception->getMessage(), $exception);
        }
        if ($this->isHttpException($exception)) 
        {   
            $data=[];
            $data["brands"]=Brands::all();
            $data["categories"]=Categories::all();
            $data["page_title"]="Error Page";
            $statusCode = $exception->getStatusCode();
            switch($statusCode){
                case '404': return response()->view('errors.missing',$data, 404);
                case '403': return response()->view('errors.missing',$data, 403);
            }
        }


        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
       if(strrpos($request->path(),"admin")===0){
            return $request->expectsJson()?response()->json(['message' => $exception->getMessage()], 401):redirect()->guest(route('admin_show_login'))->with("msg","Please Sign In");
       }else{
            return $request->expectsJson()?response()->json(['message' => $exception->getMessage()], 401):redirect()->guest(route('login_page'))->with("msg","Please Sign In");
       }
    }
}
