<?php

namespace App\Exports;

use App\Models\Pesanan;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PesananExport implements FromQuery, WithHeadings, WithMapping, WithStyles
{
    use Exportable;

    protected $dateFrom;
    protected $dateTo;
    protected $status;
    protected $index = 0;

    public function __construct($dateFrom = null, $dateTo = null, $status = null)
    {
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->status = $status;
    }

    public function headings(): array
    {
        return [
            '#',
            'Order ID',
            'Tanggal',
            'Nama',
            'Pesanan',
            'Kuantitas',
            'Meja',
            'Total',
            'Status',
        ];
    }

    public function map($pesanan): array
    {
        $items = $pesanan->pesananItems;
        $rowCount = count($items);

        if ($rowCount === 0) {
            return [
                [
                    ++$this->index,
                    $pesanan->order_id,
                    $pesanan->created_at->format('d M Y H:i'),
                    $pesanan->user->name,
                    '',
                    '',
                    $pesanan->meja->kodeMeja,
                    'Rp ' . number_format($pesanan->total_harga, 0, ',', '.'),
                    ucfirst($pesanan->status),
                ]
            ];
        }

        $rows = [];
        foreach ($items as $i => $item) {
            $rows[] = [
                $i === 0 ? ++$this->index : '',
                $i === 0 ? $pesanan->order_id : '',
                $pesanan->created_at->format('d M Y H:i'),
                $pesanan->user->name,
                $item->menu->namaMenu,
                $item->quantity,
                $pesanan->meja->kodeMeja,
                'Rp ' . number_format($pesanan->total_harga, 0, ',', '.'),
                ucfirst($pesanan->status),
            ];
        }
        return $rows;
    }

    public function query()
    {
        $query = Pesanan::query()->with('user', 'pesananItems.menu', 'meja');

        if ($this->dateFrom && $this->dateTo) {
            $endDate = date('Y-m-d', strtotime($this->dateTo));
            $query->whereBetween('updated_at', [$this->dateFrom, $endDate]);
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        return $query->orderBy('created_at', 'desc');
    }

    public function styles(Worksheet $sheet)
    {
        // Update range to include column I (Status)
        $sheet->getDefaultRowDimension()->setRowHeight(20);
        $sheet->getStyle('A1:I1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12,
                'name' => 'Segoe UI'
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '007BFF']
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => 'CCCCCC']
                ]
            ]
        ]);
        $sheet->getStyle('A2:I' . ($sheet->getHighestRow()))
            ->getFont()->setName('Segoe UI')->setSize(11);
        $sheet->getStyle('A2:I' . ($sheet->getHighestRow()))
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A2:I' . ($sheet->getHighestRow()))
            ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('DDDDDD'));
        foreach (range('A', 'I') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        return [];
    }
}
