<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FacturaExport implements FromCollection, WithHeadings
{
    protected $facturas;
    protected $headings;

    public function __construct($facturas, $headings)
    {
        $this->facturas = $facturas;
        $this->headings = $headings;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->facturas;
    }

    public function headings(): array
    {
        return $this->headings;
    }
}
