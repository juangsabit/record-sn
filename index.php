<!DOCTYPE html>
<html>

<head>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
  <link rel="icon" href="AVI.png" type="image/png" sizes="16x16">
  <title>Serial Number FCT</title>
</head>
<body>

  <div class="container my-3">
    <div class="row">
      <div class="col-6 mt-3">
        <h2>Serial Number FCT</h2>
      </div>
      <div class="col-6 text-right">
        <a type="button" href="graph.php" class="btn btn-success mr-3">View Graph</a>
        <button class="btn btn-info mr-3" id="refresh">Refresh</button>
        <img src="AVI.png" width="200px" alt="">
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-12">
        <div class="table-responsive">
          <table class="table table-striped table-sm" id="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Paco Label</th>
                <th scope="col">Serial Number</th>
                <th scope="col">Source</th>
                <th scope="col">Created at</th>
              </tr>
            </thead>
            <tbody>
              <!-- List Data Menggunakan DataTable -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <hr>
  </div>


  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>



  <script>
  $(function(){
       $('.table').DataTable({
          "processing": true,
          "serverSide": true,
          "ajax":{
                   "url": "ajax/ajax_data.php?action=table_data",
                   "dataType": "json",
                   "type": "POST"
                 },
          "columns": [
              { "data": "no" },
              { "data": "label_paco" },
              { "data": "serial_number" },
              { "data": "source" },
              { "data": "created_at" },
          ]  
      });
  });
           
    $('#refresh').click(function() {
      location.reload();
    });
</script>

</body>

</html>