<?php

namespace App\Exports;

use App\Models\BatchCount;
use App\Models\Payment;
use App\Models\PaymentRecord;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BatchRangeExport implements FromArray, WithHeadings
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 1000;
    }

    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }

    public function headings(): array
    {
        return [
            ['RECTYPE', 'CODEPYMTYP', 'CNTBTCH', 'CNTITEM', 'IDRMIT', 'IDCUST', 'DATERMIT', 'TEXTRMIT', 'TXTRMITREF', 'AMTRMIT', 'CODEPAYM', 'TEXTPAYOR', 'AMTRMITHC', 'IDBANK',],
            ['RECTYPE', 'CODEPAYM', 'CNTBTCH', 'CNTITEM', 'CNTLINE', 'DOCNBR', 'TEXTDESC', 'AMTACCTC', 'IDCUST',],
            ['RECTYPE', 'CODEPAYM', 'CNTBTCH', 'CNTITEM', 'CNTLINE', 'IDDISTCODE', 'IDACCT', 'GLDESC', 'TAXCLASS2',],
            ['RECTYPE', 'CODEPAYM', 'CNTBTCH', 'CNTITEM', 'CNTLINE', 'IDCUST', 'IDINVC', 'TRXTYPE', 'AMTPAYM',],
            ['RECTYPE', 'CODEPAYM', 'CNTBTCH', 'CNTITEM', 'CNTLINE', 'CNTSEQ', 'CODTRXTYPE', 'IDDISTCODE', 'CONTRACT',],
            ['RECTYPE', 'CODEPYMTYP', 'CNTBTCH', 'CNTITEM', 'OPTFIELD', 'VALUE', 'TYPE', 'DECIMALS', 'VALIDATE',],
            ['RECTYPE', 'BATCHTYPE', 'CNTBTCH', 'CNTENTR', 'AUTHORITY', 'AMTWHDTC', 'AMTWHDHC',],
        ];
    }

    public function array(): array
    {
        $payments = Payment::query()->with('collector', 'property', 'declaration')->whereDate('created_at', '>=', $this->start_date)->whereDate('created_at', '<=', $this->end_date)->get();

        if (DB::table('batch_counts')->select('id')->orderBy('id')->limit(1)->exists()) {
            $batch_count = DB::table('batch_counts')->select('id', 'count')->orderBy('id')->limit(1)->first();
            $count = $batch_count->count + 1;
            BatchCount::where('id', $batch_count->id)->update(['count' => $count]);
        } else {
            BatchCount::create(['count', 1]);
            $batch_count = BatchCount::orderBy('id')->limit(1)->first();
        }

        function prefix($num)
        {
            if ($num <= 9) {
                $prefix = '0000';
            } elseif ($num <= 99) {

                $prefix = '000';
            } elseif ($num <= 999) {

                $prefix = '00';
            } elseif ($num <= 9999) {

                $prefix = '0';
            } else {
                $prefix = '';
            }
            return $prefix;
        }

        $array = [];
        $num = 1;
        //$numCount = 20;
        foreach ($payments as $payment) {
            if ($payment->payment_type == 'Bank Deposit') {
                $payment->payment_type = 'BANKTF';
            }

            array_push(
                $array,
                [
                    1,
                    'CA',
                    $batch_count->count,
                    $num,
                    '000000353-' . prefix($num) . $num,
                    $payment->property->sageId,
                    date('Ymd', strtotime($payment->created_at)),
                    'Payment for ' . date('F, Y', strtotime($payment->declaration->date)),
                    'SLTA Levy Portal',
                    $payment->payment,
                    $payment->payment_type,
                    $payment->property->name,
                    $payment->payment,
                    'BOSL',
                ]
            );

            // $paymentRecords = PaymentRecord::query()->where('payment_id', $payment->id)->whereDate('created_at', '>=', $this->start_date)->whereDate('created_at', '<=', $this->end_date)->get();
            // foreach ($paymentRecords as $paymentRecord) {
            //     array_push(
            //         $array,
            //         [
            //             4,
            //             'CA',
            //             $batch_count->count,
            //             $num,
            //             $numCount,
            //             prefix($payment->property->id) . $payment->property->id . '-12-2020',
            //             date('Ymd', strtotime($payment->created_at)) . 'Q' . $paymentRecord->id,
            //             51,
            //             $paymentRecord->payment,
            //         ]
            //     );
            //     $numCount += 20;
            // }
            // $numCount = 20;
            $num += 1;
        }
        return $array;
    }
}
