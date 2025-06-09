<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PembayaranExport implements FromQuery, WithHeadings, WithMapping, WithStyles
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
            'Nama Pemesan',
            'Metode Pembayaran',
            'Tanggal',
            'Kode Pesanan',
            'Status Pembayaran',
        ];
    }

    public function map($pembayaran): array
    {
        return [
            ++$this->index,
            $pembayaran->pesanan->user->name,
            $pembayaran->metodePembayaran->metodePembayaran,
            $pembayaran->created_at->format('Y-m-d H:i:s'),
            $pembayaran->pesanan->id,
            $pembayaran->statusPembayaran,
        ];
    }

    public function query()
    {
        $query = Pembayaran::query()->with('pesanan.user', 'metodePembayaran');

        // Apply date filter if both start and end dates are provided
        if ($this->dateFrom && $this->dateTo) {
            $endDate = date('Y-m-d', strtotime($this->dateTo));
            $query->whereBetween('updated_at', [$this->dateFrom, $endDate]);
        }

        // Filter by status if provided
        if ($this->status) {
            $query->where('statusPembayaran', $this->status);
        }

        return $query->orderBy('created_at', 'desc');
    }

    public function styles(Worksheet $sheet)
    {
        // Style the first row (headings)
        $sheet->getDefaultRowDimension()->setRowHeight(20);
        $sheet->getStyle('A1:F1')->applyFromArray([
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
        $sheet->getStyle('A2:F' . ($sheet->getHighestRow()))
            ->getFont()->setName('Segoe UI')->setSize(11);
        $sheet->getStyle('A2:F' . ($sheet->getHighestRow()))
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A2:F' . ($sheet->getHighestRow()))
            ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN)
            ->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color('DDDDDD'));
        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        return [];
    }
}