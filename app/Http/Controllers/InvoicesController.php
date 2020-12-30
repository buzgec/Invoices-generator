<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Currency;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Item;
use Barryvdh\DomPDF\Facade as PDF;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\Types\Collection;
use Symfony\Component\HttpFoundation\Session\Session;



class InvoicesController extends Controller
{
    public function index()
    {
        return view('invoices.create_invoice', compact('invoices'));
    }

    public function create($client_id)
    {
        $client = Client::find($client_id);
        $items = Item::all();
        $currencies = Currency::all();

        return view('invoices.create_invoice', compact('client'))
            ->with(compact('currencies'))
            ->with('items', $items);
    }

    public function store(Request $request)
    {
        switch ($request->input('create_invoice')) {
            case 'create':
                $request->validate([
                    'currencySelect' => 'required',
                    'invoice_note' => 'required',
                    'name.*' => 'required | distinct',
                    'description.*' => 'required',
                    'quantity.*' => 'required',
                    'price.*' => 'required',

                ], [
                    'name.*.required' => 'Product name required.',
                    'description.*.required' => 'Description required.',
                    'quantity.*.required' => 'Quantity required.',
                    'price.*.required' => 'Price required.',
                    'name.*.distinct' => 'Item names cannot be duplicated.',
                    'invoice_note.required' => 'Please enter your invoice note.'
                ]);

                //Get inputs
                $names = $request->input('name');
                $descriptions = $request->input('description');
                $quantities = $request->input('quantity');
                $prices = $request->input('price');
                $counter = 0;
                $sum = 0;
                for ($i = 0; $i < count($names); $i++) {
                    //Create new item
                    $item = new Item();
                    $item->name = $names[$i];
                    $item->description = $descriptions[$i];
                    $item->quantity = $quantities[$i];
                    $item->price = $prices[$i];
                    $item->save();
                    $counter++;
                    $sum += round($quantities[$i] * $prices[$i], 2);
                }

                //Create new invoice
                $invoice = new Invoice();
                $invoice->client_id = $request->client_id;
                $invoice->currency_id = $request->currencySelect;
                $invoice->amount = round($sum, 2);
                $invoice->currency_date = date("d.m.y");
                $invoice->note = $request->invoice_note;
                $invoice->save();

            // Create invoice items
                $last_invoice_id = Invoice::orderBy('id', 'desc')->first();
                $items_for_invoice =DB::table('items')->orderBy('id', 'DESC')->take($counter)->get();
                foreach ($items_for_invoice as $item_for_invoice) {
                    $invoice_items = new InvoiceItem();
                    $invoice_items->invoice_id = $last_invoice_id->id;
                    $invoice_items->item_id = $item_for_invoice->id;
                    $invoice_items->save();
                }

                return redirect('/invoices/all_invoices')->with('success', 'Invoice created successfully.');
                break;
            case 'add_items':
                $items = $request->input('items');
                $client_id = $request->client_id;
                $add_items = array();
                $add_items_sum = 0;
                if (!empty($items)) {
                for ($i = 0; $i < count($items); $i++) {
                    $item = Item::find($items[$i]);
                    array_push($add_items, $item);
                    $add_items_sum += $item['quantity'] * $item['price'];
                }

                \Illuminate\Support\Facades\Session::put('add_items', $add_items);
                \Illuminate\Support\Facades\Session::put('add_items_sum', $add_items_sum);
                return Redirect::route('create_invoice', $client_id)
                    ->withInput();
                } else {
                    return back()->withInput();
                }
                break;
        }
    }

    public function showAll()
    {
        $invoices = Invoice::all();
        return view('invoices.all_invoices')
            ->with('invoices', $invoices);
    }

    public function show(Invoice $invoice)
    {
        $i = $invoice;
        $invoice_items = InvoiceItem::with('invoice')
            ->where('invoice_id', '=', '' . $i->id . '')
            ->get();
        return view('invoices.show_invoice', compact('i'))
            ->with('invoice_items', $invoice_items);
    }

    public function downloadPDF(Invoice $invoice)
    {
        $i = $invoice;
        $invoice_items = InvoiceItem::with('invoice')
            ->where('invoice_id', '=', '' . $i->id . '')
            ->get();
//        $view = view('invoices.show_invoice', compact('i', 'invoice_items'))->render();
        $pdf = PDF::loadView('toPDF', compact('i', 'invoice_items'))->setPaper('a4');
        return $pdf->download('invoice.pdf');
//        loadView('invoices.show_invoice', compact('i', 'invoice_items'));
//        return $pdf->download('invoice.pdf');
    }

    public function edit(Invoice $invoice)
    {
        //
    }

    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    public function client_invoices($client_id)
    {
        $invoices = Invoice::with('client')
            ->where('client_id', '=', '' . $client_id . '')
            ->get();
        $client = Client::find($client_id);

        return view('invoices.client_invoices', compact('client'))
            ->with('invoices', $invoices);
    }


    public function destroy(Invoice $invoice)
    {
        //
    }
}
