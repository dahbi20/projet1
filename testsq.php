<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<?php
include 'connect.php';
 $book_sql = "select * from chapter where cid = 1";
    $book_res = $conn->query($book_sql);
    $book_row = $book_res->fetch_assoc();?>
    <button style="width:60%;min-width:300px;" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalChap">Document disponible
                    </button>

          

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Télécharger la pièce jointe</h4>
                </div>
                <div class="modal-body">
                  <?php
                    if ($book_row['doc'] == 1) {
                      # code...
                      ?>
                      <p>Nous avons joint un fichier PDF de questions importantes pour que vous puissiez en expliquer davantage.</p>
                      <a href="<?php echo $book_row['link']?>" target="_blank"><button style="" class="btn btn-info btn-lg">Télécharger la pièce jointe</button></a>
                      <?php
                    }elseif ($book_row['doc'] == 2) {
                      # code...
                      ?>
                      <p>Nous avons joint un fichier PDF de questions importantes pour que vous puissiez en expliquer davantage.</p>
                      <a href="<?php echo $book_row['link']?>" target="_blank"><button style="" class="btn btn-info btn-lg">Télécharger la pièce jointe</button></a>
                      <?php
                    }
                  ?>
                </div>
              </div>
              <!-- Modal content-->

            </div>
          </div>

</body>
</html>