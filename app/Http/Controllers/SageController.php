<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Property;
use App\Models\Receipt;
use App\Models\WebInvoice;
use App\Models\WebProperty;
use App\Models\WebReceipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SageController extends Controller
{
    public function connect()
    {
        $properties = Property::select('id', 'name', 'sageID')->OrderBy('name')->get();
        $SageProperties = DB::connection('Sage')->select("select IDCUST, NAMECUST from dbo.ARCUS order by NAMECUST");

        foreach ($properties as $property) {
            $sageID = $property->sageID;
            if ($sageID != Null) {
                foreach ($SageProperties as $SageProperty) {
                    if ($sageID == rtrim($SageProperty->IDCUST)) {
                        $property->SageName = $SageProperty->NAMECUST;
                    }
                }
            } else {
                $property->SageName = Null;
            }
        }

        return view('admin.payment.connect', ['properties' => $properties], ['SageProperties' => $SageProperties]);
    }

    public function update(Request $request)
    {
        $propertyID = $request->property;
        $SageProperty = $request->SageProperty;

        $property = Property::find($propertyID);
        $property->sageid = $SageProperty;
        $property->save();

        $property = WebProperty::find($propertyID);
        $property->sageid = $SageProperty;
        $property->save();

        return back();
    }

    public function sync()
    {
        $invoices = DB::connection('Sage')->select("select BC.CNTBTCH, BH.IDCUST, BH.IDINVC, BC.BTCHSTTS, BH.AMTTXBL, BH.DATEINVC, BH.TERMCODE, BH.INVCDESC, BH.SHPTOSTE1, BH.SHPTOSTE2, BH.SHPTOSTE3, BH.SHPTOSTE4, BH.SHPTOCTAC from dbo.ARIBC as BC inner join dbo.ARIBH as BH on BC.CNTBTCH = BH.CNTBTCH where BC.NBRERRORS = 0");
        foreach ($invoices as $invoice) {
            $batch_number = trim($invoice->CNTBTCH);
            $sage_customer_id = trim($invoice->IDCUST);
            $sage_invoice_number = trim($invoice->IDINVC);
            $status = trim($invoice->BTCHSTTS);
            $amount = trim($invoice->AMTTXBL);
            $date = trim($invoice->DATEINVC);
            $desc = trim($invoice->INVCDESC);
            $termcode = trim($invoice->TERMCODE);
            $shiptoste1 = trim($invoice->SHPTOSTE1);
            $shiptoste2 = trim($invoice->SHPTOSTE2);
            $shiptoste3 = trim($invoice->SHPTOSTE3);
            $shiptoste4 = trim($invoice->SHPTOSTE4);
            $shiptoctac = trim($invoice->SHPTOCTAC);

            if (Invoice::where('sage_invoice_number', $sage_invoice_number)->exists()) {
                Invoice::where('sage_invoice_number', $sage_invoice_number)->update([
                    'batch_number' => $batch_number,
                    'sage_customer_id' => $sage_customer_id,
                    'sage_invoice_number' => $sage_invoice_number,
                    'description' => $desc,
                    'status' => $status,
                    'amount' => $amount,
                    'date' => $date,
                    'termcode' => $termcode,
                    'shiptoste1' => $shiptoste1,
                    'shiptoste2' => $shiptoste2,
                    'shiptoste3' => $shiptoste3,
                    'shiptoste4' => $shiptoste4,
                    'shiptoctac' => $shiptoctac,
                ]);
            } else {
                Invoice::create([
                    'batch_number' => $batch_number,
                    'sage_customer_id' => $sage_customer_id,
                    'sage_invoice_number' => $sage_invoice_number,
                    'description' => $desc,
                    'status' => $status,
                    'amount' => $amount,
                    'date' => $date,
                    'termcode' => $termcode,
                    'shiptoste1' => $shiptoste1,
                    'shiptoste2' => $shiptoste2,
                    'shiptoste3' => $shiptoste3,
                    'shiptoste4' => $shiptoste4,
                    'shiptoctac' => $shiptoctac,
                ]);
            }

            if (WebInvoice::where('sage_invoice_number', $sage_invoice_number)->exists()) {
                WebInvoice::where('sage_invoice_number', $sage_invoice_number)->update([
                    'batch_number' => $batch_number,
                    'sage_customer_id' => $sage_customer_id,
                    'sage_invoice_number' => $sage_invoice_number,
                    'description' => $desc,
                    'status' => $status,
                    'amount' => $amount,
                    'date' => $date,
                    'termcode' => $termcode,
                    'shiptoste1' => $shiptoste1,
                    'shiptoste2' => $shiptoste2,
                    'shiptoste3' => $shiptoste3,
                    'shiptoste4' => $shiptoste4,
                    'shiptoctac' => $shiptoctac,
                ]);
            } else {
                WebInvoice::create([
                    'batch_number' => $batch_number,
                    'sage_customer_id' => $sage_customer_id,
                    'sage_invoice_number' => $sage_invoice_number,
                    'description' => $desc,
                    'status' => $status,
                    'amount' => $amount,
                    'date' => $date,
                    'termcode' => $termcode,
                    'shiptoste1' => $shiptoste1,
                    'shiptoste2' => $shiptoste2,
                    'shiptoste3' => $shiptoste3,
                    'shiptoste4' => $shiptoste4,
                    'shiptoctac' => $shiptoctac,
                ]);
            }
        }

        //$SageCUS = DB::connection('Sage')->select("select IDCUST, NAMECUST, TEXTSTRE1, TEXTSTRE2, TEXTSTRE3, NAMECTAC, CODETERM from dbo.ARCUS order by NAMECUST");

        $recepits = DB::connection('Sage')->select("select BK.IDREMIT, BK.DATEREMIT, BK.PAYORID, BK.PAYORNAME, BK.COMMENT, BK.REFERENCE, BK.SRCEAMOUNT, BK.SRCECURN, BK.PAYMCODE, BK.SRCEDOCNUM, AR.IDINVCMTCH from dbo.BKTRAND as BK join dbo.ARTCR as AR on BK.SRCEDOCNUM = AR.DOCNBR where STATUS = 3");

        foreach ($recepits as $recepit) {
            $number = trim($recepit->IDREMIT);
            $sage_invoice_number = trim($recepit->IDINVCMTCH);
            $date = trim($recepit->DATEREMIT);
            $sage_customer_id = trim($recepit->PAYORID);
            $property_name = trim($recepit->PAYORNAME);
            $title = trim($recepit->COMMENT);
            $reference = trim($recepit->REFERENCE);
            $amount = trim($recepit->SRCEAMOUNT);
            $currency = trim($recepit->SRCECURN);
            $payment_type = trim($recepit->PAYMCODE);
            $sage_system_id = trim($recepit->SRCEDOCNUM);

            if (Receipt::where('sage_system_id', $sage_system_id)->exists()) {
                Receipt::where('sage_system_id', $sage_system_id)->update([
                    'number' => $number,
                    'sage_invoice_number' => $sage_invoice_number,
                    'date' => $date,
                    'sage_customer_id' => $sage_customer_id,
                    'property_name' => $property_name,
                    'title' => $title,
                    'reference' => $reference,
                    'amount' => $amount,
                    'currency' => $currency,
                    'payment_type' => $payment_type,
                    'sage_system_id' => $sage_system_id,
                ]);
            } else {
                Receipt::create([
                    'number' => $number,
                    'sage_invoice_number' => $sage_invoice_number,
                    'date' => $date,
                    'sage_customer_id' => $sage_customer_id,
                    'property_name' => $property_name,
                    'title' => $title,
                    'reference' => $reference,
                    'amount' => $amount,
                    'currency' => $currency,
                    'payment_type' => $payment_type,
                    'sage_system_id' => $sage_system_id,
                ]);
            }

            if (WebReceipt::where('sage_system_id', $sage_system_id)->exists()) {
                WebReceipt::where('sage_system_id', $sage_system_id)->update([
                    'number' => $number,
                    'sage_invoice_number' => $sage_invoice_number,
                    'date' => $date,
                    'sage_customer_id' => $sage_customer_id,
                    'property_name' => $property_name,
                    'title' => $title,
                    'reference' => $reference,
                    'amount' => $amount,
                    'currency' => $currency,
                    'payment_type' => $payment_type,
                    'sage_system_id' => $sage_system_id,

                ]);
            } else {
                WebReceipt::create([
                    'number' => $number,
                    'sage_invoice_number' => $sage_invoice_number,
                    'date' => $date,
                    'sage_customer_id' => $sage_customer_id,
                    'property_name' => $property_name,
                    'title' => $title,
                    'reference' => $reference,
                    'amount' => $amount,
                    'currency' => $currency,
                    'payment_type' => $payment_type,
                    'sage_system_id' => $sage_system_id,
                ]);
            }
        }
    }
}
