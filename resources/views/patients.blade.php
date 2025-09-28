<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>All Patients</title>

    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.bootstrap5.min.css">

    <!-- Custom Styling -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #fff;
            border-radius: 0.75rem;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            padding: 2rem;
        }

        h2 {
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        table.dataTable thead th {
            white-space: nowrap;
            text-align: center;
            vertical-align: middle;
            background-color: #f1f1f1;
            color: #343a40;
            font-weight: 500;
        }

        table.dataTable tbody td {
            vertical-align: middle;
        }

        table.dataTable tbody tr:hover {
            background-color: #f8f9fc;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.25rem 0.5rem;
            margin: 0 2px;
            border-radius: 0.25rem;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 0.5rem;
            padding: 0.25rem 0.5rem;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>All Patients</h2>

        @if($patients->isNotEmpty())
        <div class="table-responsive">
            <table id="patientsTable" class="table table-striped table-bordered align-middle">
                <thead>
                    <tr>
                        @foreach($patients->first()->keys() as $header)
                        <th>{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($patients as $row)
                    <tr>
                        @foreach($row as $cell)
                        <td>{{ $cell }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-muted">No data found in the Excel file.</p>
        @endif
    </div>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.bootstrap5.min.js"></script>

    <!-- DataTables Init -->
    <script>
        $(document).ready(function() {
            $('#patientsTable').DataTable({
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50, 100],
                order: [],
                language: {
                    search: "🔍",
                    searchPlaceholder: "Search patients..."
                }
            });
        });
    </script>
</body>

</html>