<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Response;

class UsersController extends Controller
{

    public function __construct()
    {
        // $this->middleware('jwt.auth');

         //protect specific Routes
        $this->middleware('jwt.auth', ['except' => ['index', 'store']]);
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
        $users= User::all();
        $response = Response::json($users,200);
        return $response;
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
        if ((!$request->email) || (!$request->name) || (!$request->password)) {

        $response = Response::json([
            'message' => 'Please enter all required fields'
        ], 422);
        return $response;
         }


         $user = new User(array(
        'email' => trim($request->email),
        'name' => trim($request->name),
        'password' => bcrypt($request->password),
         ));
    
        $user->save();

        $message = 'The user has been created successfully';

        $response = Response::json([
            'message' => $message,
            'data' => $user,
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
