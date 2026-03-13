<?php
namespace App\Http\Controllers;
use App\Http\Requests\TicketRequest;
use App\Services\TicketService;
use App\Http\Resources\ticketResource;
class TicketController extends Controller
{

public function store(TicketRequest $request, TicketService $ticketService){
    $data = $request->validated();
    $ticket=$ticketService->createTicket($data);
if ($request->wantsJson() || $request->is('api/*')){
    return new TicketResource($ticket);
}
return redirect()->route('home')->with('success', 'Тікет успішно створено!');
}
public function Welcome(){
    return view('main');
}
public function showWidget(){
    return view('widget');
}
}