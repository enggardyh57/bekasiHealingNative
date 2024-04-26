<!DOCTYPE html>
<html>
<head>
    <title>Kwitansi Nota Pembelian Tiket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #3636;
            color: black;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: rgba(204,204,204,0.5);
            border-radius: 20px;
        }
        img {
            width: 150px;
            margin-bottom: -1px;
            margin-left: 280px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        h3 {
            margin-bottom: 10px;
        }

        p {
            margin-bottom: 5px;
        }

        .total-amount {
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>
    <?php
    if (isset($_POST['nama']) && isset($_POST['no_telepon']) && isset($_POST['tgl_perjalanan']) && isset($_POST['paket']) && isset($_POST['jumlah_tiket'])) {
        $nama = $_POST['nama'];
        $no_telepon = $_POST['no_telepon'];
        $tgl_perjalanan = $_POST['tgl_perjalanan'];
        $paket = $_POST['paket'];
        $jumlah_tiket = $_POST['jumlah_tiket'];

        // Harga tiket berdasarkan paket dan tipe hari (weekday/weekend)
        $harga_weekday = 0;
        $harga_weekend = 0;
        
        if ($paket == "Paket A Lembang") {
            $harga_weekday = 450000;
            $harga_weekend = 500000;
        } elseif ($paket == "Paket B Lembang") {
            $harga_weekday = 450000;
            $harga_weekend = 500000;
        } elseif ($paket == "Paket A Ciwidey") {
            $harga_weekday = 500000;
            $harga_weekend = 550000;
        } elseif ($paket == "Paket B Ciwidey") {
            $harga_weekday = 500000;
            $harga_weekend = 550000;
        }

        // Diskon 20% jika jumlah tiket di atas 5
        $bonus = 0;
        if ($jumlah_tiket > 4) {
            $bonus = ($jumlah_tiket * $harga_weekday * 0.2);
        }

        // Total biaya tiket
        $total_biaya = 0;
        if (date('N', strtotime($tgl_perjalanan)) >= 6) {
            $total_biaya = ($jumlah_tiket * $harga_weekend) - $bonus;
        } else {
            $total_biaya = ($jumlah_tiket * $harga_weekday) - $bonus;
        }
    ?>
    
    <div class="container">
        <img src="img/logobeling.png" alt="Logo Perusahaan">
        <h2>Nota Pembelian Tiket</h2>
        <h3>Informasi Pembelian</h3>
        <p>Nama Lengkap: <?php echo $nama; ?></p>
        <p>Nomor Telepon: <?php echo $no_telepon; ?></p>
        <p>Tanggal Perjalanan: <?php echo $tgl_perjalanan; ?></p>
        <p>Pilihan Paket: <?php echo $paket; ?></p>
        <p>Jumlah Tiket: <?php echo $jumlah_tiket; ?></p>
        
        <h3>Detail Harga</h3>
        <p>Harga Tiket Weekday: Rp <?php echo number_format($harga_weekday, 0, ',', '.'); ?>/orang</p>
        <p>Harga Tiket Weekend: Rp <?php echo number_format($harga_weekend, 0, ',', '.'); ?>/orang</p>
        
        <h3>Detail Pembayaran</h3>
        <p>Bonus: Rp <?php echo number_format($bonus, 0, ',', '.'); ?></p>
        <p>Total Biaya Tiket: Rp <?php echo number_format($total_biaya, 0, ',', '.'); ?></p>
        
        
        <h3>Terima kasih atas pemesanan tiket Anda!</h3>
        <img src="img/tf.png" >
        <h5>Kirimkan bukti transfer jika tim Beling menghubungi atau hubungi kontak WhatsApp yang tertera</h5>
        <a href="index.html"><input type="submit" value="Kembali Beranda"></a>
    </div>
    
    <?php
    } else {
        echo "<h3 class='error-message'>Terjadi kesalahan dalam pemrosesan pembelian.</h3>";
    }
    ?>
</body>
</html>
