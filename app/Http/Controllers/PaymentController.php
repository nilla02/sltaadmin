<?php

namespace App\Http\Controllers;

use App\Exports\BatchExport;
use App\Exports\BatchRangeExport;
use App\Models\Collector;
use App\Models\Declaration;
use App\Models\Payment;
use App\Models\Property;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class PaymentController extends AdminsController
{
    public function payment()
    {
        $payments = Payment::all();

        foreach ($payments as $payment) {
            $property = Property::select('name')->where('id', $payment->property_id)->first();
            $payment->propertyName = $property->name;
            $collector = Collector::select('fullname', 'position')->where('id', $payment->collector_id)->first();
            $fullNameParts = explode(" ", $collector->fullname);
            $payment->firstName = $fullNameParts[0];
            if (isset($fullNameParts[1])) {
                $payment->lastName = $fullNameParts[1];
                if (isset($fullNameParts[2])) {
                    $payment->lastName = $fullNameParts[1] . ' ' . $fullNameParts[2];
                }
            }
            $payment->collectorPosition = $collector->position;
            $declaration = Declaration::select('payment')->where('id', $payment->declaration_id)->first();
            $payment->SystemAmount = $declaration->payment;
        }


        return view('admin.payment.index', ['payments' => $payments]);
    }

    public function paymentHistory()
    {
        return view('admin.payment.paymentHistory');
    }

    public function batch()
    {
        return (new BatchExport())->download('Batch-' . date('Y-m-d', strtotime(today())) . '.csv', Excel::CSV, ['Content-Type' => 'text/xlsx']);
    }

    public function batchRange(Request $request)
    {
        return (new BatchRangeExport($request->start_date, $request->end_date))->download('Batch-' . $request->start_date . '--' . $request->end_date . '.csv', Excel::CSV, ['Content-Type' => 'text/xlsx']);
    }

    public function recepits()
    {
        $recepits = Receipt::select('id', 'number', 'property_name', 'sage_invoice_number', 'sage_customer_id', 'amount', 'currency', 'title', 'reference', 'date')->orderBy('id', 'desc')->get();
        return view('admin.payment.recepits', ['recepits' => $recepits]);
    }

    public function recepit(Request $request)
    {
        $recepit = Receipt::select('id', 'number', 'property_name', 'sage_invoice_number', 'sage_customer_id', 'amount', 'currency', 'title', 'reference', 'date')->where('id', $request->recepit)->orderBy('id', 'desc')->first();
        $property = Property::where('sageId', $recepit->sage_customer_id)->first();
        return view('admin.payment.recepit', ['property' => $property, 'recepit' => $recepit]);
    }

    public function invoices()
    {
        // $recepits = Receipt::select('id', 'number', 'sage_invoice_number', 'sage_customer_id', 'amount', 'currency', 'title', 'reference', 'date')->orderBy('id', 'desc')->get();
        // foreach ($recepits as $recepit) {
        //     $recepit->property = Property::select('name')->where('sageId', $recepit->sage_customer_id)->first();
        // }
        return view('admin.payment.invoices');
    }

    public function invoice(Request $request)
    {
        //$recepit = Receipt::select('id', 'number', 'sage_invoice_number', 'sage_customer_id', 'amount', 'currency', 'title', 'reference', 'date')->where('id', $request->recepit)->orderBy('id', 'desc')->first();
        //$property = Property::where('sageId', $recepit->sage_customer_id)->first();
        return view('admin.payment.invoice');
    }
}
