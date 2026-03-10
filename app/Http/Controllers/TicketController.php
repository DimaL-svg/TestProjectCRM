<?php
namespace App\Http\Controllers;
use App\Http\Requests\TicketRequest;
use App\Services\TicketService;
class TicketController extends Controller
{

public function store(TicketRequest $request, TicketService $ticketService){
    $data = $request->validated();
    $ticketService->createTicket($data);
    return redirect()->back()->with('success', 'Заявка успішно створена!');
}
public function Welcome(){
    return view('welcome');
}
public function showWidget(){
    return view('create');
}
}