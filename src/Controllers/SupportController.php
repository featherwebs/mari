<?php

namespace Featherwebs\Mari\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Featherwebs\Mari\Requests\StoreTicket;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SupportController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    try {
      $client = new Client([
        'base_uri' => env('SUPPORT_API_URL'),
        'timeout'  => 2.0,
      ]);
      $url    = "support/ticket?api_token=" . env('SUPPORT_TOKEN');

      $response = $client->request("GET", $url);
      $tickets  = json_decode($response->getBody());
    } catch (Exception $e) {
      return abort(500);
    }

    return view('featherwebs::admin.support.index', compact('tickets'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    try {
      $client = new Client([
        'base_uri' => env('SUPPORT_API_URL'),
        'timeout'  => 2.0,
      ]);

      if (request()->has('success')) {
        return redirect()->route('admin.support.index')->with('success', 'Ticket has been created successfully.');
      }

      if (request()->has('error')) {
        return redirect()->route('admin.support.index')->with('error', 'Ticket could not be created.');
      }

      $url         = "support/ticket-types?api_token=" . env('SUPPORT_TOKEN');
      $response    = $client->request("GET", $url);
      $ticketTypes = json_decode($response->getBody());
      $priorities  = [ 'HIGH', 'NORMAL', 'LOW' ];
      $statuses    = [ 'PENDING', 'OPEN', 'REJECTED', 'RESOLVED', 'CLOSED' => 'CLOSED' ];
    } catch (Exception $e) {
      return abort(500);
    }

    return view('featherwebs::admin.support.create', compact('ticketTypes', 'priorities', 'statuses'));
  }

  /**
   * Display the specified resource.
   *
   * @param  string $slug
   * @return \Illuminate\Http\Response
   */
  public function show($slug)
  {
    try {
      $client   = new Client([
        'base_uri' => env('SUPPORT_API_URL'),
        'timeout'  => 2.0,
      ]);
      $url      = "support/ticket/" . $slug . "?api_token=" . env('SUPPORT_TOKEN');
      $response = $client->request("GET", $url);
      $ticket   = json_decode($response->getBody());
    } catch (Exception $e) {
      return abort(500);
    }

    return view('featherwebs::admin.support.show', compact('ticket'));
  }

  /**
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function messageCreate($slug)
  {
    if (request()->has('success')) {
      return redirect()->route('admin.support.show', $slug)->with('success', 'Message has been created successfully.');
    }

    if (request()->has('error')) {
      return redirect()->route('admin.support.show', $slug)->with('error', 'Message could not be created.');
    }

    return view('featherwebs::admin.support.messageCreate', compact('slug'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
