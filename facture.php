<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" 
         integrity="sha384-y5UsSS8l0Y6T31rFgqPP6d6jFET6QcZS0r5yyP2nTf6Rv8U8bfs6cxDt2uXe" 
         crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Facture</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        /* Hide the form initially */
        #createModal {
            display: none;
        }
    </style>
</head>
<body>
    <section class="container py-5">
        <div class="row">
            <div class="col-lg-8 col-sm mb-5 mx-auto">
                <h1 class="fs-4 text-center lead text-primary">CRUD PHP POO MYSQL AJAX</h1>
            </div>
        </div>
        <div class="dropdown-divider border-warning"></div>
        <div class="row">
            <div class="col-md-6">
                <h5 class="fw-bold mb-0"> Liste de facture</h5>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary btn-sm me-3" id="newInvoiceBtn"><i class="fas fa-folder-plus"></i> Nouveau</button>
                </div>
            </div>
        </div>
        <div class="dropdown-divider border-warning"></div>
        <div class="row">
            <div class="table-responsive" id="orderTable">
                <table class="table mt-4" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Date_creation</th>
                            <th scope="col">Numero</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Etat</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i = 0; $i < 20; $i++): ?>
                            <tr>
                                <th scope="row"><?= $i + 1 ?></th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>
                                    <a href="#" class="text-info me-2 infoBtn" title="voir details"><i class="fas fa-info-circle"></i></a>
                                    <a href="#" class="text-primary me-2 editBtn" title="Modifier"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="text-danger me-2 deletBtn" title="Supprimer"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    
    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Nouveau facture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Add your form fields here for the new invoice -->
                    <label for="clientName">Nom du client:</label>
                    <input type="text" id="clientName" name="clientName" class="form-control mb-3" required>
                    
                    <label for="cashierName">Nom du caissier:</label>
                    <input type="text" id="cashierName" name="cashierName" class="form-control mb-3" required>
                    
                    <label for="amount">Montant:</label>
                    <input type="text" id="amount" name="amount" class="form-control mb-3" required>
                    
                    <label for="receivedAmount">Montant perçu:</label>
                    <input type="text" id="receivedAmount" name="receivedAmount" class="form-control mb-3" required>
                    
                    <label for="invoiceStatus">Etat:</label>
                    <select id="invoiceStatus" name="invoiceStatus" class="form-control mb-3" required>
                        <option value="paye">Payé</option>
                        <option value="annulee">Annulée</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" name="create" id="create">Ajouter</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI/t1Zl/tn3icX2aFgF+g7Zk5hvwifZ5eYC//f90=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEX/4Yf5rmfP5SZ6Z/Z6mCpLvWWE/AEL2VW5" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-rbs5FsFZlvZI3sH6+sb6Fk5L6a6bBq4Q5PPFq5tFfEIIJ3vZoJmVFGd5G5fdq5q" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#myTable').DataTable();

            // Show the createModal when the newInvoiceBtn is clicked
            $('#newInvoiceBtn').click(function() {
                $('#createModal').modal('show');
            });

            // Handle the create button click in the modal
            $('#create').click(function() {
                // Retrieve form values
                let clientName = $('#clientName').val();
                let cashierName = $('#cashierName').val();
                let amount = $('#amount').val();
                let receivedAmount = $('#receivedAmount').val();
                let invoiceStatus = $('#invoiceStatus').val();

                // Add a new row to DataTable
                $('#myTable').DataTable().row.add([
                    '', // Leave the first cell empty for the index
                    '', // Date_creation - You may want to fill this dynamically
                    clientName,
                    cashierName,
                    amount,
                    invoiceStatus,
                    '<a href="#" class="text-info me-2 infoBtn" title="voir details"><i class="fas fa-info-circle"></i></a>' +
                    '<a href="#" class="text-primary me-2 editBtn" title="Modifier"><i class="fas fa-edit"></i></a>' +
                    '<a href="#" class="text-danger me-2 deletBtn" title="Supprimer"><i class="fas fa-trash-alt"></i></a>'
                ]).draw();

                // Reset form values
                $('#clientName').val('');
                $('#cashierName').val('');
                $('#amount').val('');
                $('#receivedAmount').val('');
                $('#invoiceStatus').val('paye');

                // Hide the modal
                $('#createModal').modal('hide');
            });
        });
    </script>
</body>
</html>
