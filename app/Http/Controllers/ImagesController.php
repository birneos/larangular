<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use Illuminate\Support\Facades\Response;

use Closure;

class ImagesController extends Controller
{
    //to protect all Images Routes we are using middleware
    public function __construct()
    {
       
        //protect all Images Routes
       // $this->middleware('jwt.auth');

        //protect specific Routes
        $this->middleware('jwt.auth', ['except' => ['index', 'show']]);

      //  $this->middleware('jwt.auth', ['except' => ['index','store','refresh']]);
     
 
        

    }

   

    public function refresh()
    {
        $current_token  = JWTAuth::getToken();
        $token          = JWTAuth::refresh($current_token);
        $response->headers->set('Authorization', 'Bearer '.$token);

        return response()->json(compact('token'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $images = Image::all();
        // $response = Response::json($images,200);
        // return $response;

        //or alternative
         $images = Image::all();
        
        return $images;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         if ((!$request->title) || (!$request->thumbnail) || (!$request->imageLink)) {

        $response = Response::json([
            'message' => 'Please enter all required fields'
        ], 422);
        return $response;
    }

    $image = new Image(array(
        'thumbnail' => trim($request->thumbnail),
        'imageLink' => trim($request->imageLink),
        'title' => trim($request->title),
        'description' => trim($request->description),
        'user_id' => 1
    ));
    $image->save();

    $message = 'Your image has been added successfully';

    $response = Response::json([
        'message' => $message,
        'data' => $image,
    ], 201);

    return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = Image::find($id);

        if(!$image){
        return Response::json([
            'error' => [
                'message' => "Cannot find the image."
            ]
        ], 404);
    }

    return Response::json($image, 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if ((!$request->title) || (!$request->thumbnail) || (!$request->imageLink)) {

        $response = Response::json([
            'message' => 'Please enter all required fields'
        ], 422);
        return $response;
    }

    $image = Image::find($request->id);

    if(!$image){
        return Response::json([
            'error' => [
                'message' => "Cannot find the image."
            ]
        ], 404);
    }

    $image->thumbnail = trim($request->thumbnail);
    $image->imageLink = trim($request->imageLink);
    $image->title = trim($request->title);
    $image->description = trim($request->description);
    $image->save();

    $message = 'Your image has been updated successfully';

    $response = Response::json([
        'message' => $message,
        'data' => $image,
    ], 201);

    return $response;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $image = Image::find($id);

        if(!$image){
            return Response::json([
                'error' => [
                    'message' => "Cannot find the image."
                ]
            ], 404);
        }

         $image->delete();

         $message = 'Your image has been deleted successfully';

         $response = Response::json([
             'message' => $message,
         ], 201);

         return $response;

    }

    public function handle($request, Closure $next)
    {
        // caching the next action
        $response = $next($request);

        try
        {
            if (! $user = JWTAuth::parseToken()->authenticate() )
            {
                return ApiHelpers::ApiResponse(101, null);
            }
        }
        catch (TokenExpiredException $e)
        {
            // If the token is expired, then it will be refreshed and added to the headers
            try
            {
                $refreshed = JWTAuth::refresh(JWTAuth::getToken());
                $response->header('Authorization', 'Bearer ' . $refreshed);
            }
            catch (JWTException $e)
            {
                return ApiHelpers::ApiResponse(103, null);
            }
            $user = JWTAuth::setToken($refreshed)->toUser();
        }
        catch (JWTException $e)
        {
            return ApiHelpers::ApiResponse(101, null);
        }

        // Login the user instance for global usage
        Auth::login($user, false);

        return $response;
    }
}
