<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .struk {
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            text-align: left;
            padding: 12px;
            border: none;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9em;
            color: #777;
        }

        .header-info {
            margin-bottom: 20px;
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 10px;
        }

        .header-info p {
            margin-bottom: 5px;
        }

        .product-name {
            font-weight: bold;
        }

        .total-info p:nth-child(even) {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="struk">
        <h4 class="text-center mb-4">Indo April</h4>
        <div class="header-info">
            
                <p><strong>Member Status : </strong> </p>
                <p><strong>No. HP : </strong> </p>
                <p><strong>Bergabung Sejak : </strong> </p>
                <p><strong>Poin Member : </strong> </p>
            
                <p><strong>Member Status : </strong>Bukan Member</p>
                <p><strong>No. HP : </strong>-</p>
                <p><strong>Bergabung Sejak : </strong>-</p>
                <p><strong>Poin Member : </strong>-</p>
            
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
                
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                
                <tr>
                    <th></th>
                    <th></th>
                    <th>Total Harga</th>
                    
                        <th>Rp. </th>
                    
                        <th>Rp. </th>
                    
                </tr>
                <tr>
                    <th>Poin Digunakan</th>
                    <th> </th>
                    <th>Harga Setelah Poin</th>
                    
                        <th>Rp. </th>
                    
                        <th>Rp. 0</th>
                    
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Total Kembalian</th>
                    <th>Rp </th>
                </tr>
            </tbody>
        </table>
        <div class="footer">
            <p> T .000000Z | petugas</p>
            <p>Terima kasih atas pembelian Anda!</p>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>