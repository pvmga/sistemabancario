<tr class="border-t">
    <td class="py-2">{{ date('d-m-Y H:i:s', strtotime($transaction['created_at'])) }}</td>
    <td class="py-2">{{ $transaction['tipo_transacao']  }}</td>
    <td class="py-2">{{ number_format($transaction['valor'], 2, ',', '.') }}</td>
    <td class="py-2">ID: {{ $transaction['conta_corrente_destino']  }}</td>
</tr>
