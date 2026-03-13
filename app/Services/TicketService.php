<?php
namespace App\Services;
use App\Models\Ticket;
use App\Models\Customer;
use Illuminate\Http\UploadedFile;
class TicketService
{
    public function createTicket($data)
    {
    $customer = Customer::where('email', $data['email'])->first();
    if(!$customer){
        $customer = Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);
    }
    $ticket = Ticket::create([
        'customer_id' => $customer->id,
        'subject' => $data['subject'],
        'message' => $data['message'],
        'status' => 'new',
    ]);
    if (isset($data['attachment']) && $data['attachment'] instanceof UploadedFile) {
        $ticket->addMedia($data['attachment'])
               ->toMediaCollection('tickets_attachments');
    }
    return $ticket;
    }
    public function searchTickets($filters){
    $query = Ticket::query();
    if(!empty($filters['search'])){
        $query->where(function ($q) use ($filters) {
            $q->where('subject', 'like', '%' . $filters['search'] . '%')
              ->orWhere('message', 'like', '%' . $filters['search'] . '%');
              $q->orWhereHas('customer', function ($customerquery) use ($filters) {
                $customerquery->where('phone', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('email', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('name', 'like', '%' . $filters['search'] . '%');
        });
    });
    }
    
    if(!empty($filters['status'])){
        $query->where('status',$filters['status']);
    }
    if(!empty($filters['date_from'])){
        $query->whereDate('created_at', '>=', $filters['date_from']);
    }
    if(!empty($filters['date_to'])){
        $query->whereDate('created_at', '<=', $filters['date_to']);
    }
    return $query->oldest()->paginate(10)->withQueryString();
}
public function updateStatus(Ticket $ticket, string $status){
    $data = ['status' => $status];
    if (is_null($ticket->manager_replied_at)) {
        $data['manager_replied_at'] = now();
    }
    return $ticket->update($data);
}
}
