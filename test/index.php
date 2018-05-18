<?php session_start();
?>
<!DOCTYPE html>
<html lang="en"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="shortcut icon" type="image/x-icon" href="images/icon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="apple-mobile-web-app-capable" content="yes">

  <title>โรงพยาบาลเจ้าพระยาอภัยภูเบศร</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap theme -->
  <link href="css/bootstrap-material-design.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/theme.css" rel="stylesheet">
  <link href="css/home.css" rel="stylesheet">
  <style>
  .black-ribbon {
    position: fixed;
    z-index: 9999;
    width: 70px;
  }
  @media only all and (min-width: 768px) {
    .black-ribbon {
      width: auto;
    }
  }

  .stick-left { left: 0; }
  .stick-right { right: 0; }
  .stick-top { top: 0; }
  .stick-bottom { bottom: 0; }
  </style>
</head>

<body>

  <?php
  $head_home = 'active';
  include_once('./includes/header.php');
  ?>

  <section id="slide-heaer">
    <!-- Slide Pic -->
    <div id="carousel-example-generic" class="carousel slide carousel-fade" data-ride="carousel">

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="images/c1.jpg"  >
          <div class="carousel-caption">

          </div>
        </div>
        <div class="item">
          <img src="images/c2.jpg"  >
          <div class="carousel-caption">
          </div>
        </div>
        <div class="item">
          <img src="images/c5.jpg"  >
          <div class="carousel-caption">
          </div>
        </div>
      </div>
    </div>
    <!-- /Slide Pic -->
  </section>

  <div class="container" style="margin-top: 25px;">
    <div class="row">
      <div class="col-md-4 col-xs-12">
        <div class="alert alert-theme" >
          <p >
            <span class="glyphicon glyphicon-search" aria-hidden="true" ></span>&nbsp;
            <span >ค้นหาตารางตรวจแพทย์ </span>
          </p>
        </div>

        <?php
        try {
          if (!file_exists('includes/connect.php'))
          throw new Exception('ไม่สามารถเข้าถึงข้อมูล');
          else {
            require_once('includes/connect.php' );
            $pdo = sql_con();
            $sql = "SELECT id, description, en_description FROM workdepartment order by id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (sizeof($result) > 0) {
              for ($i = 0; $i < sizeof($result); $i++) {
                $row = $result[$i];
                ?>

                <p style="padding-left:15px;">
                  <a href="#" style="color:#009688"  data-toggle="modal" data-target="#<?php echo $row['en_description']; ?>">
                    ตารางตรวจ <?php echo $row['description']; ?> <span class="glyphicon glyphicon-folder-open" style="color:#F07A28;"></span>
                  </a>
                </p>
                <hr style="width:100%; background-color:#D7D7D7;">

                <?php
              }//end for
            } else {
              echo "ไม่มีข้อมูล";
            }
          }//else
        } catch (Exception $e) {
          echo '<p><span style="color:red">ผิดพลาด : </span><span>' . $e->getMessage() . '</span></p>';
        }
        ?>
      </div>

      <div class="col-md-8 col-xs-12">
        <div class="row">
          <div class="alert alert-dismissible alert-theme-w">
            <p>บริการทางการแพทย์ ศูนย์การแพทย์เฉพาะทาง</p>
          </div>

          <div class="col-md-3 col-sm-4 col-xs-6">
            <div class="thumbnail-theme">
              <div class="text-center">
                <img src="images/imd1.png" class="img-circle" >
              </div>
              <div class="text-center">
                <p><strong>ตรวจรักษาผู้ป่วยอายุรกรรม</strong></p>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-sm-4 col-xs-6">
            <div class="thumbnail-theme">
              <div class="text-center">
                <img src="images/surgery1.png" class="img-circle" >
              </div>
              <div class="text-center">
                <p><strong>ตรวจรักษาผู้ป่วยศัลยกรรม</strong></p>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-sm-4 col-xs-6">
            <div class="thumbnail-theme">
              <div class="text-center">
                <img src="images/children1.png" class="img-circle" >
              </div>
              <div class="text-center">
                <p><strong>ตรวจรักษาผู้ป่วยกุมารเวชกรรม</strong></p>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-sm-4 col-xs-6">
            <div class="thumbnail-theme">
              <div class="text-center">
                <img src="images/girl1.png" class="img-circle" >
              </div>
              <div class="text-center">
                <p><strong>ตรวจรักษาผู้ป่วสูติ - นรีเวชกรรม</strong></p>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-sm-4 col-xs-6">
            <div class="thumbnail-theme">
              <div class="text-center">
                <img src="images/psyciatry2.png" class="img-circle" >
              </div>
              <div class="text-center">
                <p><strong>ตรวจรักษาผู้ป่วยอายุจิตเวช</strong></p>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-sm-4 col-xs-6">
            <div class="thumbnail-theme">
              <div class="text-center">
                <img src="images/nerves1.png" class="img-circle" >
              </div>
              <div class="text-center">
                <p><strong>ตรวจรักษาผู้ป่วยศัลยกรรมประสาท</strong></p>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-sm-4 col-xs-6">
            <div class="thumbnail-theme">
              <div class="text-center">
                <img src="images/eye1.png" class="img-circle" >
              </div>
              <div class="text-center">
                <p><strong>ตรวจรักษาผู้ป่วยจักษุ</strong></p>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-sm-4 col-xs-6">
            <div class="thumbnail-theme">
              <div class="text-center">
                <img src="images/ear1.png" class="img-circle" >
              </div>
              <div class="text-center">
                <p><strong>ตรวจรักษาผู้ป่วยอายุโสต-ศอ-นาสิก</strong></p>
              </div>
            </div>
          </div>

          <div class="col-md-3 col-sm-4 col-xs-6">
            <div class="thumbnail-theme">
              <div class="text-center">
                <img src="images/icu1.png" class="img-circle" >
              </div>
              <div class="text-center">
                <p><strong>ตรวจรักษาผู้ป่วยภาวะวิกฤต (ห้องICU)</strong></p>
              </div>
            </div>
          </div>
        </div><!-- Row -->
      </div>
    </div>


  </div><!-- Conatianer -->

  <div id="article">
    <div class="background"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-xs-12">
          <h3>ประวัติองค์กร</h3>
          <p>
            ในปี พ.ศ.2452 ตึกเจ้าพระยาอภัยภูเบศร ได้ถูกสร้างขึ้นจากความจงรักภักดี ของเจ้าพระยาอภัยภูเบศร (ชุ่ม อภัยวงศ์) ด้วยประสงค์จะใช้เป็นที่ประทับ รับเสด็จพระบาทสมเด็จพระจุลจอมเกล้าเจ้าอยู่หัว ในวโรกาสที่เสด็จประพาสเมืองปราจีนบุรี แต่สวรรคตเสียก่อน ตึกหลังนี้จึงได้รับใช้รับเสด็จพระบาทสมเด็จ พระมงกุฏเกล้าเจ้าอยู่หัว จากนั้นตึกหลังนี้เป็นมรดกตกทอดมาเป็นของพระยา อภัยวงศ์วรเชษฐ (ช่วง อภัยวงศ์) ต่อมาพระนางเจ้าสุวัทนา พระวรราชเทวี ซึ่งเป็นหลานของพระยาอภัยวงศ์วรเชษฐ ได้กรรมสิทธิ์ในสิ่งเหล่านี้จึงได้ประทานตึกหลังนี้แก่มณฑลทหารบกที่ 2 ตั้งเป็นสถานพยาบาล และต่อมาทางจังหวัดปราจีนบุรีขอโอนมาเปิดใช้เป็นโรงพยาบาลประจำจังหวัดใช้ชื่อว่า “โรงพยาบาลเจ้าพระยาอภัยภูเบศร” เมื่อวันที่ 24 มิถุนายน 2484 เพื่อเกียรติแห่งคุณความดี ของท่านผู้เป็นเจ้าของ หลังจากที่โรงพยาบาลได้รับงบประมาณสิ่งก่อสร้างเป็นอาคารผู้ป่วย ตึกหลังนี้จึงมิได้ใช้เป็นสถานที่บริการผู้ป่วย ได้รับการอนุรักษ์ไว้นับแต่นั้นเป็นต้นมาและได้ขึ้นทะเบียนเป็นโบราณสถานแห่งชาติของกรมศิลปากร เมื่อวันที่ 25 มกราคม 2533 ได้รับรางวัลพระราชทานอาคารอนุรักษ์ดีเด่น ประจำปี 2542 จากสมเด็จพระเทพรัตนราชสุดาฯ สยามบรมราชกุมารี
          </p>

          <p>
            โรงพยาบาลเจ้าพระยาอภัยภูเบศรได้รับการยกฐานะขึ้นเป็นโรงพยาบาลศูนย์ เมื่อวันที่ 4 กรกฎาคม 2539 ได้มีการปรับปรุงทั้งด้าน โครงสร้าง อุปกรณ์ เครื่องมือ เครื่องใช้ที่ทันสมัย มีการจัดหาและพัฒนาบุคลากรให้มีคุณภาพในทุกด้าน โดยมุ่งเน้นพัฒนาคุณภาพบริการตั้งแต่ปี 2539 มาอย่างต่อเนื่องจนกระทั่งผ่านการรับรองในปี 2553 ปัจจุบันโรงพยาบาลมีพื้นที่ทั้งหมดจำนวน 65 ไร่ 1 งาน 11.52 ตารางวา มีเตียงรับผู้ป่วยจำนวน 486 เตียง
          </p>


        </div>
      </div>
    </div><!-- container -->
  </div><!-- Article -->

  <div id="ads">
    <div class="container" style="padding-top: 30px; padding-bottom: 30px;">
      <div class="row">

        <div class="col-xs-12 col-sm-6 col-md-6" style="margin-bottom:30px;">
          <div class="row">

            <div class="col-xs-12">
              <div class="alert alert-dismissible alert-theme">
                <p>ผลิตภัณฑ์ </p>
              </div>
            </div>

            <div class="col-xs-12">
              <div class="herb-content">
                <img src="images/y.jpg">
                <div class="caption">
                  <a href="#">แคปซูลยอ</a>
                  <p>รักษาโรคต่างๆ เช่น อาการแพ้ โรคข้ออักเสบ โรคหอบหืด โรคสมอง แผลพุพอง มะเร็ง</p>
                </div>
              </div>
            </div>

            <div class="col-xs-12">
              <div class="herb-content">
                <img src="images/mayaampm.jpg ">
                <div class="caption">
                  <a href="#">น้ำมะขามป้อม</a>
                  <p>บำรุงเสียง บำรุงตับ และป้องกันโรคเรื้อรัง ลดโอกาสการแพ้ที่เกิดจากสารเคมี</p>
                </div>
              </div>
            </div>

            <div class="col-xs-12">
              <div class="herb-content">
                <img src="images/img_2958re.jpg">
                <div class="caption">
                  <a href="#">เฮอร์บัล แอคเน่ เจล</a>
                  <p>ช่วยลดการสะสมของแบคทีเรีย สาเหตุของการเกิดสิว ลดปัญหารอยดำจากสิว</p>
                </div>
              </div>
            </div>

            <div class="col-xs-12">
              <div class="herb-content">
                <img src="images/ethphcchitr.jpg">
                <div class="caption">
                  <a href="#">ยาหอมนวโกฐ</a>
                  <p>แก้ลมคลื่นเหียน อาเจียน แก้ลมปลายไข้</p>
                </div>
              </div>
            </div>


          </div>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-6">
          <div class="row">

            <div class="col-xs-12">

              <div class="alert alert-dismissible alert-theme">
                <p>บริการ</p>
              </div>

              <div class="list-group">
                <div class="list-group-item">
                  <div class="row-picture">
                    <img class="circle"  src="images/services/spa.jpg" alt="icon">
                  </div>
                  <div class="row-content">
                    <a href="#">เดย์สปา</a>

                    <p class="list-group-item-text">ร้านอาหารสุขภาพ ร้านกาแฟ และสปาหลากหลายรูปแบบ</p>
                  </div>
                </div>
                <div class="list-group-separator"></div>

                <div class="list-group-item">
                  <div class="row-picture">
                    <img class="circle" src="images/services/massage.jpg" alt="icon">
                  </div>
                  <div class="row-content">
                    <a href="#">นวดไทยอภัยภูเบศร</a>

                    <p class="list-group-item-text">ให้บริการนวดไทยต่างๆ เช่น นวดตัว นวดเท้า นวดน้ำมัน เป็นต้น</p>
                  </div>
                </div>
                <div class="list-group-separator"></div>

                <div class="list-group-item">
                  <div class="row-picture">
                    <img class="circle" src="images/services/shop.jpg" alt="icon">
                  </div>
                  <div class="row-content">
                    <a href="#">อภัยภูเบศร โอสถ</a>

                    <p class="list-group-item-text">จำหน่ายผลิตภัณฑ์สุทนไพรต่างๆ</p>
                  </div>
                </div>
                <div class="list-group-separator"></div>

                <div class="list-group-item">
                  <div class="row-picture">
                    <img class="circle" src="images/services/behide.jpg" alt="icon">
                  </div>
                  <div class="row-content">
                    <a href="#">ตึกเจ้าพระยาอภัยภูเบศร</a>

                    <p class="list-group-item-text">ชมความสวยงานภายใน โบราณวัตถุต่างๆ และสวนสมุนไพรหลังตึก</p>
                  </div>
                </div>
                <div class="list-group-separator"></div>

              </div>

            </div>

          </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12" style="margin-top:60px;">
          <div class="row">

            <div class="col-xs-12">
              <div class="alert alert-dismissible alert-theme-w">
                <p>ประมวลภาพกิจกรรม </p>
              </div>
            </div>

            <div class="col-xs-12">
              <!-- Slide Pic -->
              <div id="carousel-event" class="carousel slide" data-ride="carousel">


                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                  <div class="item active">
                    <img src="images/events/danc.jpg"  >
                    <div class="carousel-caption">
                      ซ้อมรำ มาฆปูรมีศรีปราจีน 18 กพ 59
                    </div>
                  </div>

                  <div class="item">
                    <img src="images/events/night.jpg"  >
                    <div class="carousel-caption">
                      ราตรีรักภิรมย์
                    </div>
                  </div>

                  <div class="item">
                    <img src="images/events/tambun.jpg"  >
                    <div class="carousel-caption">
                      ร่วมทำบุญตักบาตร เนื่องในวันปีใหม่ 2559
                    </div>
                  </div>

                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-event" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-event" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>

              <!-- /Slide Pic -->
            </div>
          </div>
        </div>

      </div><!-- row -->
    </div><!-- container -->
  </div><!-- ads -->

  <!-- News and Post -->
  <div id="news-post">
    <div class="container" style="padding-top: 25px; padding-bottom: 25px;">
      <div class="row">

        <?php
        try {
         
            $pdo = sql_con();
            $sql = "SELECT * FROM news order by id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (sizeof($result) > 0) {
              for ($i = 0; $i < sizeof($result); $i++) {
                $row = $result[$i];
                ?>

                <div class="col-md-4 <?php
                if (($i+1) % 3 == 0)
                echo "col-sm-12";
                else
                echo "col-sm-6";
                ?> col-xs-12 ">
                <div class="alert alert-dismissible alert-theme-g ">
                  <p>
                    <span class="glyphicon <?php echo $row['icon']; ?>" aria-hidden="true"></span>&nbsp;
                    <span><?php echo $row['description']; ?></span>
                  </p>
                </div>

                <?php
                $sql = "SELECT *, DATE_FORMAT(post_date,'%d/%m/%Y') as post_date, TIMESTAMPDIFF(DAY, post_date, NOW()) as diff FROM post where status = 1 and news_types = :new_type order by id desc limit 3";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":new_type", $row['id']);
                $stmt->execute();
                $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (sizeof($posts) > 0) {
                  for ($j = 0; $j < sizeof($posts); $j++) {
                    $post = $posts[$j];
                    ?>
                    <p style="padding-left:15px;">
                      <?php
                      $folder = array();
                      $folder['1'] = "general";
                      $folder['2'] = "recruit";
                      $folder['3'] = "procurement";
                      $folder['4'] = "insider";
                      $folder['5'] = "events";
                      $folder['6'] = "training";

                      if ($post['file_path'] != NULL) {
                        echo '<a onclick="JavaScript:counter('.$post['id'].');" href="files/' . $folder[$post['news_types']] . '/' . $post['file_path'] . '" target="_blank">
                        '. ($j+1) . '. ' . $post['topic'] . ' [' . $post['post_date'] . ']  '.
                        '</a>';
                      }else{
                        ?>
                        <a href="#" style="color:#6d6d6d;">
                          <?php echo ($j+1) . '. ' . $post['topic'] . ' [' . $post['post_date'] . ']  '; ?>
                        </a>
                        <?php
                      }
                      if($post['diff'] <= 7)
                      echo "<img src='./images/New_icons_23.gif' />";
                      ?>
                    </p>
                    <?php
                  }
                }
                ?>
                <p style="padding-left:15px;">
                  <a href="news.php?id=<?=$post['news_types']?>" style="color:#7d7d7d;">
                    อ่านเพิ่ม...
                  </a>
                </p>

              </div>

              <?php
              if (($i+1) % 3 == 0)
              echo "</div><div class='row'>";
            }//end for
          }else {
            echo "ไม่มีข้อมูล";
          }
        
      } catch (Exception $e) {
        echo '<p><span style="color:red">ผิดพลาด : </span><span>' . $e->getMessage() . '</span></p>';
      }
      ?>

    </div><!-- row -->
  </div><!-- container -->
</div>
<!-- /News and Post -->

<?php
include_once('includes/worktable.php');
?>

<?php
include_once('includes/footer.php');
?>


<!-- Modal -->
<div class="modal fade" id="post_new" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <img src="images/dddd.jpg" class="img-responsive" >
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/material.min.js"></script>
<script type="text/javascript">
  $('#post_new').modal('toggle')
function counter(id) {
  $.post('includes/post_counter.php', {id: id}, function (resp) {
    console.log(resp)
  });
}
</script>
<!-- Bottom Right -->
<!-- <img src="./images/black_ribbons/black_ribbon_bottom_left.png" class="black-ribbon stick-bottom stick-left"> -->
</body></html>
