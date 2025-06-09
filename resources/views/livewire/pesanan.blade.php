<div class="table-responsive shadow-sm rounded">
    <table id="datatablesSimple" class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr class="text-center">
            <th>No</th>
            <th>User</th>
            <th>Detail Pesanan</th>
            <th>Jumlah</th>
            <th colspan="2">Total Harga</th>
            <th>Kode Meja</th>
            <th>Waktu Pesan</th>
            <th>Status Pesanan</th>
            <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grandTotal = 0;
            @endphp
            @forelse($pesanan as $index => $row)
            @php
                $grandTotal += $row->total_harga; // Asumsikan 'total_harga' adalah atribut pada model pesanan
            @endphp
            <livewire:pesanan-item :$index :pesananItem="$row" :key="$row->order_id" />
            @empty
            <tr>
                <td colspan="8" class="text-secondary text-center py-4">
                    <i class="bi bi-emoji-frown fs-4"></i>
                    <p class="mt-2">Belum ada pesanan</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

