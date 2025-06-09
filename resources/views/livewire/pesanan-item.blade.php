<tr class="text-center text-dark">
    <td scope="row">{{ $index+1 }}</td>
    <td>
        @if ($pesananItem->user)
        {{ $pesananItem->user->name }}
        @else
        <span class="text-danger">User tidak ditemukan</span>
        @endif
    </td>
    <td>
        @foreach ($pesananItem->pesananItems as $product)
        <p class="m-0">{{ $product->menu->namaMenu }}</p>
        @endforeach
    </td>
    <td>
        @foreach ($pesananItem->pesananItems as $product)
        <p class="m-0">{{ $product->quantity }}</p>
        @endforeach
    </td>
    <td colspan="2">Rp. {{ number_format($pesananItem->total_harga, 0, ',', '.') }}</td>
    <td>{{ $pesananItem->meja->kodeMeja }}</td>
    <td>{{ $pesananItem->created_at }}</td>
    <td>
        <span class="badge text-light p-2
            @switch($pesananItem->status)
                @case('belum dibayar') bg-warning @break
                @case('selesai') bg-success @break
                @case('dibatalkan') bg-danger @break
                @default bg-info
            @endswitch
        ">
            {{ ucfirst($pesananItem->status) }}
        </span>
    </td>
    <td class="justify-content-between" style="width: 200px;">
        @if ($pesananItem->status == 'belum dibayar')
            @if(Auth::user()->role != 'Customer')
                <button wire:click="confirm" wire:confirm="Apakah Anda yakin ingin berpindah ke halaman konfirmasi pembayaran?"
                    class="btn btn-info btn-sm rounded">
                    <i class="fa-solid fa-thumbs-up text-white" style="font-size: 1 rem;"></i>
                </button>
            @else
                <button wire:click="payment" class="btn btn-success btn-sm align-middle rounded">
                    <i class="fa-solid fa-money-bill text-white"></i>
                </button>
            @endif
            <button wire:click="cancel" wire:confirm="Apakah Anda yakin ingin membatalkan pesanan ini?"
                class="btn btn-danger btn-sm align-middle rounded">
                <i class="fa-solid fa-square-xmark text-white" style="font-size: 1 rem;"></i>
            </button>
        @endif

        @if ($pesananItem->status == 'sedang dimasak')
            <button wire:click="complete"
                wire:confirm="Apakah Anda yakin ingin menandai pesanan ini sebagai selesai?"
                class="btn btn-success btn-sm align-middle rounded">
                <i class="fa-solid fa-check text-white"></i>
            </button>
            @if(Auth::user()->role != 'Customer')
                <button wire:click="cancel" wire:confirm="Apakah Anda yakin ingin membatalkan pesanan ini?"
                    class="btn btn-danger btn-sm align-middle rounded">
                    <i class="fa-solid fa-square-xmark text-white"></i>
                </button>
            @endif
        @endif

        @if(Auth::user()->role != 'Customer')
            <button wire:click="delete" wire:confirm="Apakah Anda yakin ingin menghapus pesanan ini?"
                class="btn btn-danger btn-sm align-middle rounded">
                <i class="fa-solid fa-trash text-white" style="font-size: 1 rem;"></i>
            </button>
        @elseif (in_array($pesananItem->status, ['dibatalkan', 'selesai']))
            &mdash;
        @endif
    </td>
</tr>
