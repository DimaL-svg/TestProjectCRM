<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Services\TicketService;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class AdminTicketController extends Controller
{
    public function index(Request $request  , TicketService $ticketService)
    {
    
    $tickets = Ticket::with('customer')->latest()->get();
    $filters = $request->only(['search', 'status', 'date_from', 'date_to']);
    $tickets = $ticketService->searchTickets($filters);

    return view('admin', compact('tickets'));

    }
    public function updateStatus(Request $request , Ticket $ticket, TicketService $ticketService)
    {
        $ticketService->updateStatus($ticket, $request->status);
        return back()->with('success', 'Статус оновлено!');
    }

    public function statistics()
    {
    $stats =[
        'today' => Ticket::daily()->count(),
        'weekly' => Ticket::weekly()->count(),
        'monthly' => Ticket::monthly()->count(),
        'total' => Ticket::count(),
];
return view('statistics', compact('stats'));
}
public function downloadMedia(Media $media)
{
    if (!file_exists($media->getPath())) {
        abort(404, 'Файл не знайдено');
    }

    return response()->download($media->getPath(), $media->file_name);
}
}