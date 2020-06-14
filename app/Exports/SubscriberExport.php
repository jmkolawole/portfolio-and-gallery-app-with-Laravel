<?php

namespace App\Exports;

use App\Subscriber;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class SubscriberExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Subscriber::select('id','email','status','created_at')->get();
    }


    public function headings(): array
    {
        return ['ID','Subscriber Email','Status','Created At'];
    }

}
