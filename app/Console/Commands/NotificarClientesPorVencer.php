<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cliente;
use Carbon\Carbon;

class NotificarClientesPorVencer extends Command
{
    protected $signature = 'notificar:clientes-por-vencer';
    protected $description = 'Enviar notificaciones de clientes que están por vencer';

    public function handle()
    {
        $hoy = Carbon::today();
        $fechaAviso = $hoy->copy()->addDays(1);

        $clientes = Cliente::with('user')->get()->filter(function ($cliente) use ($fechaAviso) {
            if (!$cliente->updated_at) return false;

            $vencimiento = $cliente->updated_at->copy()->addDays($cliente->duracion);

            return $vencimiento->isSameDay($fechaAviso);
        });

        foreach ($clientes as $cliente) {
            $cliente->user->notify(new \App\Notifications\ClientePorVencerNotification($cliente));
            $this->info("Notificación enviada a usuario {$cliente->user->email} por cliente {$cliente->dni}");
        }

        $this->info('Proceso terminado.');
    }
}
