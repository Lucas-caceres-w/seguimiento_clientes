<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ClientePorVencerNotification extends Notification
{
    use Queueable;

    protected $cliente;

    public function __construct($cliente)
    {
        $this->cliente = $cliente;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {

        $vencimiento = $this->cliente->updated_at->copy()->addDays($this->cliente->duracion);

        return (new MailMessage)
            ->subject('Cliente próximo a vencer')
            ->greeting('Hola!')
            ->line("El cliente con DNI: {$this->cliente->dni} está por vencer el día {$vencimiento->format('d/m/Y')}.")
            ->action('Ver Clientes', url('/clientes'))
            ->line('Por favor, revisa los detalles.');
    }
}
