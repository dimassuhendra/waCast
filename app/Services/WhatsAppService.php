<?php

namespace App\Services;

use App\Models\LogPengirimanWa;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    /**
     * Memproses penggantian placeholder {nama} & {instansi} pada template pesan.
     */
    public function renderMessage(string $template, string $nama, ?string $instansi): string
    {
        return str_replace(
            ['{nama}', '{instansi}'],
            [$nama, $instansi ?? '-'],
            $template
        );
    }

    /**
     * Mengirim pesan via WhatsApp API Gateway / Meta Cloud API.
     */
    public function sendMessage(LogPengirimanWa $log): bool
    {
        $waAccount = $log->broadcast->waAccount;

        // Contoh integrasi berbasis HTTP Request ke API Gateway WA
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $waAccount->api_key,
                'Content-Type'  => 'application/json',
            ])->timeout(15)->post('https://api.your-wa-gateway.com/send-message', [
                'phone'   => $log->no_wa_tujuan,
                'message' => $log->pesan_rendered,
            ]);

            $responseData = $response->json();

            if ($response->successful()) {
                $log->update([
                    'status'       => 'success',
                    'response_api' => json_encode($responseData),
                    'sent_at'      => now(),
                ]);
                return true;
            }

            $log->update([
                'status'       => 'failed',
                'response_api' => json_encode($responseData),
            ]);
            return false;
        } catch (\Exception $e) {
            Log::error("WA Broadcast Error [Log ID: {$log->id}]: " . $e->getMessage());

            $log->update([
                'status'       => 'failed',
                'response_api' => json_encode(['error' => $e->getMessage()]),
            ]);
            return false;
        }
    }
}