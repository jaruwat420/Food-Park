<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Ticket;

class TicketCreated extends Notification
{
    protected $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Ticket Created: ' . $this->ticket->title)
            ->line('A new ticket has been created.')
            ->line('Ticket ID: ' . $this->ticket->id)
            ->line('Title: ' . $this->ticket->title)
            ->action('View Ticket', route('tickets.show', $this->ticket->id));
    }

    public function toArray($notifiable)
    {
        return [
            'ticket_id' => $this->ticket->id,
            'title' => $this->ticket->title,
            'action' => 'created'
        ];
    }
}
