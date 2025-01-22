<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceDetail;

class InvoiceController extends Controller
{
    public function index(){
        $data['invoices'] = Invoice::join('users', 'users.id', 'invoices.created_by_id')
            ->select(
                'invoices.*',
                'users.name as created_by'
            )
            ->orderBy('invoices.created_at', 'DESC')
            ->paginate(10);
        return view('admins.invoices.index', $data);
    }

    public function detail($id){
        $invoice = Invoice::join('users', 'users.id', 'invoices.created_by_id')
            ->select(
                'invoices.*',
                'users.name as created_by'
            )->where('invoices.id', $id)->first();
        $data['invoice_details'] = InvoiceDetail::join('products', 'products.id', 'invoice_details.product_id')
            ->select('invoice_details.*', 'products.name as product_name')
            ->where('invoice_id', $invoice->id)
            ->get();
        $data['invoice'] = $invoice;
        return view('admins.invoices.detail', $data);
    }

    public function print($id){
        $invoice = Invoice::join('users', 'users.id', 'invoices.created_by_id')
            ->select(
                'invoices.*',
                'users.name as created_by'
            )->where('invoices.id', $id)->first();
        $data['invoice_details'] = InvoiceDetail::join('products', 'products.id', 'invoice_details.product_id')
            ->select('invoice_details.*', 'products.name as product_name')
            ->where('invoice_id', $invoice->id)
            ->get();
        $data['invoice'] = $invoice;
        return view('admins.invoices.print', $data);
    }
}
