<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\Auth;
class EklProjectExport implements FromView
{
    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function collection() 
    // {
    //     //
    // }

    public $type;
    public $collection;
    public $data;
    // public $id;

    // function __construct($types, $idd)
    // {
    //     $this->type = $types;
    //     $this->id = $idd;
    // }
    function __construct($types,$collection,$data)
    {
        $this->type = $types;
        $this->collection = $collection;
        $this->data = $data;
    }

    // public function registerEvents(): array
    // {
    //     return [
    //         AfterSheet::class    => function (AfterSheet $event) {
    //             // $cellRange = 'A2:K2'; // All headers
    //             $sheet = $event->sheet->getDelegate();

    //             // $sheet->getStyle($cellRange)->getFont()->setSize(14)->setBold(true);

    //             // if ($this->type != 'admin') {
    //             //     $sheet->getStyle('A3:K3')->getFont()->setSize(10)->setBold(true);
    //             // }
    //             ///->getColor()->setRGB('0000ff');

    //             // $sheet->getStyle('A1:W1')->getFill()
    //             //     ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    //             //     ->getStartColor()->setARGB('b4f2ae');
    //         },
    //     ];
    // }

    public function view(): View
    {
        $collection=$this->collection;
        $formName="Application Form of Eklavya Krida Kosh";
       
       $data=$this->data;
       $type=$this->type;
       
    //    dd($collection);
    //   print(view('exports.eklavyaExcel', compact('collection','formName','data','type')));
        return view('exports.eklavyaExcel', compact('collection','formName','data','type'));
    }
}
