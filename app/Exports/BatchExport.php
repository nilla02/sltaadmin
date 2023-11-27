<?php

namespace App\Exports;

use App\Models\BatchCount;
use App\Models\Payment;
use App\Models\PaymentRecord;
use App\Models\RateClass;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BatchExport implements FromArray, WithHeadings
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */

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
            ['RECTYPE', 'CODEPYMTYP', 'CNTBTCH', 'CNTITEM', 'IDRMIT', 'IDCUST', 'DATERMIT', 'TEXTRMIT', 'AMTRMIT', 'CODEPAYM', 'RMITTYPE', 'TEXTPAYOR', 'IDBANK', 'CODETAXGRP',],
            ['RECTYPE', 'CODEPAYM', 'CNTBTCH', 'CNTITEM', 'CNTLINE', 'DOCNBR', 'TEXTDESC', 'TEXTREF', 'AMTACCTC',],
            ['RECTYPE', 'CODEPAYM', 'CNTBTCH', 'CNTITEM', 'CNTLINE', 'IDACCT', 'GLDESC', 'AMTDISTTC',],
            ['RECTYPE', 'CODEPAYM', 'CNTBTCH', 'CNTITEM', 'CNTLINE', 'IDCUST', 'IDINVC', 'CNTPAYM', 'TRXTYPE', 'AMTERNDISC', 'CNTLASTSEQ', 'GLREF', 'CDAPPLYTO', 'AMTDISCTOT', 'AMTADJHC',],
            ['RECTYPE', 'CODEPAYM', 'CNTBTCH', 'CNTITEM', 'CNTLINE', 'CNTSEQ', 'CODTRXTYPE', 'AMTDIST', 'IDDISTCODE', 'PROJECT', 'CATEGORY', 'AMTDISC', 'UNITMEAS', 'TEXTREF'],
            ['RECTYPE', 'CODEPYMTYP', 'CNTBTCH', 'CNTITEM', 'OPTFIELD',],
        ];
    }

    public function array(): array
    {
        $batch_numbers = DB::connection('Sage')->select("select TOP 1 CNTBTCH from dbo.ARBTA order by CNTBTCH DESC");
        foreach ($batch_numbers as $batch_number) {
            $NextBatchNumber = $batch_number->CNTBTCH + 1;
        }

        $payments = Payment::query()->with('collector', 'property', 'declaration')->where('batch_number', NULL)->get();
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
        $numCount = 20;
        foreach ($payments as $payment) {
            $classid = RateClass::select('sage_id')->where('levy_id', $payment->property->applicableClassAndRate)->first();
            if ($payment->payment_type == 'Bank Deposit') {
                $payment->payment_type = 'BANKTF';
            }

            array_push(
                $array,
                [
                    1,
                    'CA',
                    $NextBatchNumber,
                    $num,
                    '000000303-' . prefix($num) . $num,
                    $payment->property->sageId,
                    date('Ymd', strtotime($payment->created_at)),
                    'Payment for ' . date('F, Y', strtotime($payment->declaration->date)),
                    $payment->payment,
                    $payment->payment_type,
                    5,
                    $payment->property->name,
                    'BOSL',
                    'NONE',
                ],
                [
                    3,
                    'CA',
                    $NextBatchNumber,
                    $num,
                    $numCount,
                    $classid->sage_id,
                    'Payment for ' . date('F, Y', strtotime($payment->declaration->date)),
                    $payment->payment,
                ]
            );

            // $paymentRecords = PaymentRecord::query()->where('payment_id', $payment->id)->whereDate('created_at', '>=', $this->start_date)->whereDate('created_at', '<=', $this->end_date)->get();
            // foreach ($paymentRecords as $paymentRecord) {
            //     array_push(
            //         $array,
            //         [
            //             3,
            //             'CA',
            //             $NextBatchNumber,
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
