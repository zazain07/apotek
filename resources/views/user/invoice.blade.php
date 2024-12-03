<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $invoice->invoice_code }}</title>
    @vite('resources/css/app.css')

    <style>
      /* Gaya khusus untuk cetak */
      @media print {
          body {
              font-size: 12pt;
              -webkit-print-color-adjust: exact;
          }

          .background_black {
            background-color: black !important;
            color: white !important;
          }

          /* Sembunyikan elemen yang tidak perlu dicetak */
          .no-print {
              display: none;
          }
      }
  </style>
</head>
<body class="font-Inter">
  <div class="no-print w-screen flex">
    <button type="button" onclick="prints()" class="no-print bg-mainColor rounded-lg px-5 py-3 my-5 text-end text-white m-auto">Unduh Halaman sebagai PDF</button>
  </div>
<div class="pt-10" id="print-content">
  <button class="w-[140px] h-[40px] ms-8 bg-black background_black rounded-tl-3xl rounded-br-3xl shadow text-xl text-white font-bold text-center">Jati Negara</button>
    <div class="p-8">
      <div class="mt-4">
          <div class="flex justify-between">
              <div class="w-1/2">
                  <h1 class="text-2xl font-bold font-Inter">Invoice diberikan kepada :</h1>
                  <h1 class="text-3xl font-bold font-Inter">{{ $invoice->recipient_name }}</h1>
                  <table border="1">
                    <tr>
                        <td class="font-normal">No.Telepon : </td>
                        <td class="font-normal">{{ $invoice->recipient_phone }}</td>
                    </tr>
                </table>              
              </div>
              <div class="text-right w-96">
                  <h1 class="text-8xl font-bold">INVOICE</h1>
                  <table class="w-full text-justif">
                    <tr>
                      <td class="w-1/2 text-left">No invoice : </td>
                      <td class="w-full">{{ $invoice->invoice_code }}</td>
                    </tr>
                    <tr>
                      <td class="w-1/2 text-left">Tanggal Invoice : </td>
                      <td class="w-full">{{ date('d M Y',strtotime($invoice->order_date)) }}</td>
                    </tr>
                    <tr>
                      <td class="w-1/2 text-left" >Kasir : </td>
                      <td class="w-full">{{ $invoice->cashier_name }}</td>
                    </tr>
                  </table>
                <div class="w-96 mt-2 border-4 border-black"></div>
              </div>
          </div>
      </div>
      <div class="mt-4">
      <table class="w-full">
          <thead>
            <tr>
              <th class="bg-zinc-600 text-white font-bold font-Inter px-2 py-1">No</th>
              <th class="bg-zinc-600 text-white font-bold font-Inter px-2 py-1">Deskripsi Barang</th>
              <th class="bg-zinc-600 text-white font-bold font-Inter px-2 py-1">Harga</th>
              <th class="bg-zinc-600 text-white font-bold font-Inter px-2 py-1">Jumlah</th>
              <th class="bg-zinc-600 text-white font-bold font-Inter px-2 py-1">Subtotal</th>            
            </tr>
          </thead>
          <tbody class="text-center">
            @php
                $i=1;
            @endphp
            @foreach ($invoice->sellingInvoiceDetail as $product)
            <tr>
              <td class="bg-white border border-black border-opacity-30 px-2 py-1">{{ $i }}</td>
              <td class="bg-white border border-black border-opacity-30 px-2 py-1">{{ $product->product_name }}</td>
              <td class="bg-white border border-black border-opacity-30 px-2 py-1">Rp. {{ number_format($product->product_sell_price, 0, ',', '.') }}</td>
              <td class="bg-white border border-black border-opacity-30 px-2 py-1">{{ $product->quantity }}</td>
              <td class="bg-white border border-black border-opacity-30 text-right px-2 py-1">Rp. {{ number_format($product->product_sell_price * $product->quantity, 0, ',', '.') }}</td>
            </tr>
            @php
                $i++;
            @endphp
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="py-5">
        <table>
        <tr>
          <td>Metode Pembayaran : </td>
          <td>{{ $invoice->recipient_bank }}</td>
        </tr>
        <tr>
          <td>Tanggal Pembelian :</td>
          <td>{{ date('d M Y',strtotime($invoice->order_date)) }}</td>
        </tr>
      </table>
      </div>

      <div>
        <table>
          <tr>
            <td class="font-bold">Syarat dan Ketentuan :</td>
          </tr>
          <tr>
            <td class="text-lg">Transaksi yang sudah direspon oleh Apotek Senopati tidak dapat dibatalkan, kecuali dalam kondisi adanya pembatalan dari pihak Apotek Senopati</td>
          </tr>
        </table>
      </div>
  <div class="flex justify-evenly items-center w-full mt-10 h-32 bg-black background_black">
    <div class="">
      <p class="text-white font-bold text-2xl">Apotek Senopati</p>
      <p class="text-white font-bold text-sm">CP : 0819-3727-5129 (Reyvin)</p>
    </div>
      <p class="text-justify text-white w-1/3">Ruko Jl. Senopati No.30 Blok F dan G, Kepuh, Betro, Kec. Sedati, Kabupaten Sidoarjo, Jawa Timur 61253</p>
  </div>
</div>

<script>
  function prints() {
            window.print();
        }
</script>
</body>
</html>