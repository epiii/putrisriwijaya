<!DOCTYPE HTML>
<html>
  <head>
    <style>
      body {
        margin: 0px;
        padding: 0px;
      }
      /* .container .btn { */
			.divCanvas .downloadBtn {
			  position: absolute;
			  top: 50%;
			  left: 50%;
			  transform: translate(-50%, -50%);
			  -ms-transform: translate(-50%, -50%);
			  background-color: #555;
			  color: white;
			  font-size: 16px;
			  padding: 12px 24px;
			  border: none;
			  cursor: pointer;
			  border-radius: 5px;
				opacity: 0.5;
			}
			.downloadBtn:hover {
				opacity: 1;
			}

    </style>
  </head>
  <body >
    <?php
      include 'lib/koneksi.php';
      include 'lib/fungsi.php';

      // pr($_GET);
      if (!isset($_GET['kode'])) {
        echo 'anda tidak berhak mengakses halaman ini, silakan mendaftar <a href="./pengajuan.php">disini</a>';
      } else {
        $userData = getDataByParam('user','kode',$_GET['kode']);
        $message = $userData['message'];
// pr($userData);
        if($message!='success'){
          echo '<h3>'.$message.'</h3>';
        } else {
          $status=  $userData['data']['status'];
          if($status=='refuse'){ // tolak
            echo '<h3>Pengajuan anda ditolak oleh admin, silakan mengajukan lagi dengan benar, klik <a href="./pengajuan.php">disini</a></h3>';
          } elseif($status=='accept'){ // setujui
            echo '<h3>Pengajuan disetujui oleh admin, silakan download voucher anda :)</h3>';
            ?>

            <div class="divCanvas">
              <a id="downloadBtn" xstyle="display:none;" href="#" class="downloadBtn">Download</a>
              <canvas id="myCanvas" xwidth="578" xheight="200" style="display:none;"></canvas>
              <img id="canvasImg" alt="Right click to save me!">
            </div>

            <script>
              var canvas = document.getElementById('myCanvas');
              var context = canvas.getContext('2d');

              // draw cloud
              // context.beginPath();
              // context.moveTo(170, 80);
              // context.bezierCurveTo(130, 100, 130, 150, 230, 150);
              // context.bezierCurveTo(250, 180, 320, 180, 340, 150);
              // context.bezierCurveTo(420, 150, 420, 120, 390, 100);
              // context.bezierCurveTo(430, 40, 370, 30, 340, 50);
              // context.bezierCurveTo(320, 5, 250, 20, 250, 50);
              // context.bezierCurveTo(200, 5, 150, 20, 170, 80);
              // context.closePath();
              // context.lineWidth = 5;
              // context.fillStyle = '#8ED6FF';
              // context.fill();
              // context.strokeStyle = '#0000ff';
              // context.stroke();


            // canvas properties
              var wid = 578;
              var hig = 300;
              canvas.width = wid;
              canvas.height = hig;


            // fill collor
              var my_gradient=context.createLinearGradient(0,0,0,170);
              my_gradient.addColorStop(0,"lightGrey");
              my_gradient.addColorStop(1,"white");
              context.fillStyle=my_gradient;
              context.fillRect(10,10,wid-20,hig-20);

            // text properties
              var txtX = 40;
              var txtY = 60;
              context.font = '20pt Arial';
              context.fillStyle = 'grey';

            // set text into canvas
              context.rect(0,0,wid,hig);
              // context.rect(10,10,(wid-10),(hig-10));
              context.stroke();
              context.fillText("ID : <?php echo $userData['data']['id_pengguna'];?>", txtX, txtY); // 400
              context.fillText("NAMA : <?php echo $userData['data']['nama'];?>", txtX, (txtY+40)); // 400
        			context.fillText("HP : <?php echo $userData['data']['nohp'];?>", txtX, (txtY+80)); // 400
        			context.fillText("KODE : <?php echo $userData['data']['kode'];?>", txtX, (txtY+120)); // 400


              // save canvas image as data url (png format by default)
              var dataURL = canvas.toDataURL();

              // set canvasImg image src to dataURL  so it can be saved as an image
              document.getElementById('canvasImg').src = dataURL;

              function downloadCanvas(link, canvasId, filename) {
          		    link.href = document.getElementById(canvasId).toDataURL();
          		    link.download = filename;
          		}
              document.getElementById('downloadBtn').addEventListener('click', function() {
          		    downloadCanvas(this, 'myCanvas',  'voucher_<?php echo $userData['data']['id_pengguna'] ?>.png');
          		}, false);


            </script>
            <?php
          } else { // pending
            echo '<h3>Pengajuan anda belum disetujui oleh admin, silakan menunggu atau hubungi admin</h3>';
          }
        }
      }
    ?>
  </body>
</html>
