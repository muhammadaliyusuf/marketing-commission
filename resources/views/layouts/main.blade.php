{{-- hasil copy dari file template pada 'examples' bootstrap 'dashboard' --}}
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Muhammad Ali Yusuf">
        <title>Marketing Commission | Dashboard</title>

        <!-- cdn Bootstrap core CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

        <!-- Custom styles for this template -->
        <link href="/css/dashboard.css" rel="stylesheet">

        <style>
            body {
                background-color: #f8f9fa;
            }

            .table-custom {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0;
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .table-custom thead {
                background-color: #282e33;
                color: white;
            }

            .table-custom th,
            .table-custom td {
                padding: 12px;
                text-align: center;
            }

            .table-custom tbody tr:nth-child(odd) {
                background-color: #f8f9fa;
            }

            .table-custom tbody tr:hover {
                background-color: #e9ecef;
                transition: background-color 0.3s ease;
            }

            .table-custom th {
                font-weight: 600;
            }

            .table-custom td {
                font-weight: 500;
            }

            .table-custom tbody tr:last-child td {
                border-bottom: none;
            }
        </style>
    </head>
    <body>
    
        @include('layouts.header')

        <div class="container-fluid">
            <div class="row">
                @include('layouts.sidebar')

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    
                    @yield('container')
                </main>
            </div>
        </div>

        {{-- js cdn bootstrap yg 'bundle' --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <!-- DataTables JS -->
        <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <!-- DataTables Bootstrap 5 JS -->
        <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#komisiTable').DataTable({
                    "paging": true, // Aktifkan pagination
                    "searching": true, // Aktifkan fitur pencarian
                    "ordering": true, // Aktifkan sorting
                    "info": true, // Tampilkan info jumlah data
                    "columnDefs": [
                        {
                            "targets": 2, // Kolom Omzet (indeks 2)
                            "render": function(data, type, row) {
                                if (type === 'sort' || type === 'type') {
                                    // Hapus format angka (titik dan koma) untuk sorting
                                    return data.replace(/\./g, '').replace(',', '.');
                                }
                                return data;
                            },
                            "type": "num"
                        },
                        {
                            "targets": 3, // Kolom Komisi % (indeks 3)
                            "render": function(data, type, row) {
                                if (type === 'sort' || type === 'type') {
                                    // Hapus tanda % dan konversi ke angka
                                    return parseFloat(data.replace('%', ''));
                                }
                                return data;
                            },
                            "type": "num" 
                        },
                        {
                            "targets": 4, // Kolom Komisi Nominal (indeks 4)
                            "render": function(data, type, row) {
                                if (type === 'sort' || type === 'type') {
                                    return data.replace(/\./g, '').replace(',', '.');
                                }
                                return data;
                            },
                            "type": "num"
                        }
                    ],
                    "language": {
                        "lengthMenu": "Tampilkan _MENU_ data per halaman",
                        "zeroRecords": "Data tidak ditemukan",
                        "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                        "infoEmpty": "Tidak ada data tersedia",
                        "infoFiltered": "(disaring dari _MAX_ total data)",
                        "search": "Cari:",
                        "paginate": {
                            "first": "Pertama",
                            "last": "Terakhir",
                            "next": "Selanjutnya",
                            "previous": "Sebelumnya"
                        }
                    }
                });
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
        <script src="/js/dashboard.js"></script>
    </body>
</html>
