<?php
namespace App\Services;
use App\Models\Ticket;
use App\Models\Customer;
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
        Ticket::create([
            'customer_id' => $customer->id,
            'subject' => $data['subject'],
            'message' => $data['message'],
        ]);
    }
}