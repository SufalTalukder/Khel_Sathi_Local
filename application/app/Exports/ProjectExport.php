<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\Auth;
class ProjectExport implements FromView, WithEvents, ShouldAutoSize
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

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A2:W2'; // All headers
                $sheet = $event->sheet->getDelegate();

                // $sheet->getStyle($cellRange)->getFont()->setSize(14)->setBold(true);

                if ($this->type != 'admin') {
                    $sheet->getStyle('A3:W3')->getFont()->setSize(10)->setBold(true);
                }
                ///->getColor()->setRGB('0000ff');

                // $sheet->getStyle('A1:W1')->getFill()
                //     ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                //     ->getStartColor()->setARGB('b4f2ae');
            },
        ];
    }

    public function view(): View
    {
        $collection=$this->collection;
        // dd($this->type);exit;
        if($this->type == 1){
            $formName="Nomination Form to Seek Reward from Government of UP/उ0प्र0 सरकार से पुरस्कार प्राप्त करने हेतु नामांकन प्रपत्र";
        }
        if($this->type == 2){
            $formName="Nomination Form to Seek Reward from Government of UP/उ0प्र0 सरकार से पुरस्कार प्राप्त करने हेतु नामांकन प्रपत्र";
        }
        if($this->type == 3){
            $formName="Nomination Form to Seek Reward from Government of UP/उ0प्र0 सरकार से पुरस्कार प्राप्त करने हेतु नामांकन प्रपत्र";
        }
        if($this->type == 4){
            $formName="Online System for Former Sportspersons of UP to Seek Financial Assistance/Monthly Pension/वित्तीय सहायता/मासिक पेंशन प्राप्त करने हेतु उत्तर प्रदेश के पूर्व खिलाड़ियों के लिए ऑनलाइन प्रणाली";
        }
        if($this->type == 5){
            $formName="Online System for Former Sportspersons of UP to Seek Financial Assistance/Monthly Pension/वित्तीय सहायता/मासिक पेंशन प्राप्त करने हेतु उत्तर प्रदेश के पूर्व खिलाड़ियों के लिए ऑनलाइन प्रणाली";

        }
        if($this->type == 6){
            $formName="Application Form of Direct Recruitment as Gazetted Officer/राजपत्रित अधिकारी के रूप में सीधी भर्ती हेतु ऑनलाइन आवेदन";
        }
        if($this->type == 7){
            $formName="Application Form of Eklavya Krida Kosh";
        }
       $data=$this->data;
       $type=$this->type;
       
    //    dd($collection);
    //   print(view('exports.sheetExcel', compact('collection','formName','data')));
        return view('exports.sheetExcel', compact('collection','formName','data','type'));
    }
}
