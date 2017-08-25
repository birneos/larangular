<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TicketFormRequest;
use App\Ticket;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //read all Ticket from databse and  compact() method to convert the result to an array, and pass it to the view
        $tickets = Ticket::all();
        return view('tickets.index', compact('tickets'));

        //alternatively
        //     return view('tickets.index')->with('tickets', $tickets);
        // or
        //     return view('tickets.index', ['tickets'=> $tickets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketFormRequest $request)
    {
        $slug = uniqid();
        
        $ticket = new Ticket(array(
        'title' => $request->get('title'),
        'content' => $request->get('content'),
        'slug' => $slug
        ));

    //save data in database
    $ticket->save();

    $werbung = "Dies ist  einfach nur Werbung";
    //after save data redirect with a message
    return redirect('/contact')->with('status', 'Your ticket has been created! Its unique id is: '.$slug);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($slug)
    {
        //get First Element or throw ModelNotFoundException if no entry
         $ticket = Ticket::whereSlug($slug)->firstOrFail();
         
        // alternatively you can use this without exception if no entry
         $ticket = Ticket::whereSlug($slug)->first();

        return view('tickets.show', compact('ticket'));
        
    }


/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function destroy($slug)
    {
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
        $ticket->delete();

        return redirect('/tickets')->with('status', 'The ticket '.$slug.' has been deleted!');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $ticket = Ticket::whereSlug($slug)->firstOrFail();
        return view('tickets.edit', compact('ticket'));
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( $slug, TicketFormRequest $request)
    {
         $ticket = Ticket::whereSlug($slug)->firstOrFail();
         $ticket->title = $request->get('title');
         $ticket->content = $request->get('content');

        //checkbox selected or not
         if($request->get('status') != null) {
                $ticket->status = 0;
         } else {
                 $ticket->status = 1;
         }
        
        $ticket->save();

        return redirect(action('TicketsController@index', $ticket->slug))->with('status', 'The ticket '.$slug.' has been updated!');
    }

    


}
