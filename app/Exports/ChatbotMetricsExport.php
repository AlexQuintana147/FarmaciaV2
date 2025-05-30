<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ChatbotMetricsExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithStyles, ShouldAutoSize
{
    protected $logs;
    protected $summary;

    public function __construct($logs, $summary)
    {
        $this->logs = $logs;
        $this->summary = $summary;
    }

    public function collection()
    {
        return $this->logs;
    }

    public function title(): string
    {
        return 'Registros de Chat';
    }

    public function headings(): array
    {
        return [
            'ID',
            'Usuario',
            'Tipo de Usuario',
            'Pregunta',
            'Respuesta',
            'Fecha de Creación',
            'Última Actualización'
        ];
    }

    public function map($log): array
    {
        return [
            $log->id,
            $log->trabajador ? $log->trabajador->name : 'Invitado',
            $log->es_autenticado ? 'Autenticado' : 'Invitado',
            $log->pregunta,
            $log->respuesta,
            $log->created_at,
            $log->updated_at
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Estilo para el encabezado
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4361ee'],
            ],
        ]);

        // Ajustar el ancho de las columnas automáticamente
        foreach(range('A','G') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
    }
}
