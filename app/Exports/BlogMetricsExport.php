<?php

namespace App\Exports;

use App\Models\BlogMedida;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BlogMetricsExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithStyles
{
    protected $metrics;
    protected $mediciones;

    public function __construct($metrics, $mediciones)
    {
        $this->metrics = $metrics;
        $this->mediciones = $mediciones;
    }

    public function collection()
    {
        return $this->mediciones;
    }

    public function title(): string
    {
        return 'Métricas de Blogs';
    }

    public function headings(): array
    {
        return [
            'ID',
            'Título',
            'Valoración',
            'Recomendación',
            'Trabajador',
            'Fecha de Creación'
        ];
    }

    public function map($medicion): array
    {
        return [
            $medicion->id,
            $medicion->titulo,
            $medicion->valoracion,
            $medicion->recomendacion,
            $medicion->trabajador->nombre_completo ?? 'N/A',
            $medicion->created_at->format('d/m/Y H:i')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Estilo para los encabezados
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '4e73df']],
        ]);

        // Ajustar ancho de columnas
        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(40);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(60);
        $sheet->getColumnDimension('E')->setWidth(25);
        $sheet->getColumnDimension('F')->setWidth(20);

        // Agregar métricas resumidas
        $row = $this->mediciones->count() + 4;
        $sheet->setCellValue('A' . $row, 'Resumen de Métricas');
        $sheet->mergeCells('A' . $row . ':B' . $row);
        $sheet->getStyle('A' . $row)->getFont()->setBold(true);
        
        $sheet->setCellValue('A' . ($row + 1), 'Total de Mediciones:');
        $sheet->setCellValue('B' . ($row + 1), $this->metrics['total_mediciones']);
        
        $sheet->setCellValue('A' . ($row + 2), 'Promedio de Valoración:');
        $sheet->setCellValue('B' . ($row + 2), $this->metrics['promedio_valoracion']);
        
        $sheet->setCellValue('A' . ($row + 3), 'Mejor Valoración:');
        $sheet->setCellValue('B' . ($row + 3), $this->metrics['mejor_valoracion']);
        
        $sheet->setCellValue('A' . ($row + 4), 'Peor Valoración:');
        $sheet->setCellValue('B' . ($row + 4), $this->metrics['peor_valoracion']);

        // Aplicar formato de número a las celdas de valoración
        $sheet->getStyle('C2:C' . ($this->mediciones->count() + 1))->getNumberFormat()->setFormatCode('0');
        
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
