<div>
    @if (count($invoices))
    
        <div class="bg-white rounded shadow-lg px-8 py-6">
            <table class="w-full">

                <thead>
                    <tr>
                        <th class="w-1/2 text-left px-4 py-2">Fecha</th>
                        <th class="w-1/4 text-left px-4 py-2">Total</th>
                        <th class="w-1/4 text-left px-4 py-2">Descarga</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($invoices as $invoice)
                        <tr>
                            <td class="px-4 py-2">{{ $invoice->date()->toFormattedDateString() }}</td>
                            <td class="px-4 py-2">{{ $invoice->total() }}</td>
                            <td class="px-4 py-2"><a href="/user/invoice/{{ $invoice->id }}">Download</a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    @endif
</div>
