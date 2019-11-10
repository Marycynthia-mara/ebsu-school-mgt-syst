
</div><!-- container -->
    </div><!-- slim-mainpanel -->
      <div class="slim-footer">
      <div class="container">
        <p>Ebonyi State Staff Secondary School &copy;2019 <?php if (intval(date('Y')) > 2019) {
        echo  " - " . date('Y');
      } ?>  All Rights Reserved. </p>
      <p>Designed by: <a href="tel:+2349063399674">Marycynhia Amarachi Ugwu</a></p>
      </div><!-- container -->
    </div><!-- slim-footer -->

    <!-- <script src="lib/jquery/js/jquery.js"></script> -->
    <script src="js/sweetalert2.all.min.js"></script>
    <script src="lib/popper.js/js/popper.js"></script>
    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script src="lib/jquery.cookie/js/jquery.cookie.js"></script>
    <script src="lib/d3/js/d3.js"></script>
    <script src="lib/rickshaw/js/rickshaw.min.js"></script>
    <script src="lib/Flot/js/jquery.flot.js"></script>
    <script src="lib/Flot/js/jquery.flot.resize.js"></script>
    <script src="lib/peity/js/jquery.peity.js"></script>
    <script src="lib/datatables/js/jquery.dataTables.js"></script>
    <script src="lib/datatables-responsive/js/dataTables.responsive.js"></script>
    <script src="lib/select2/js/select2.min.js"></script>


    <script src="js/slim.js"></script>
    <script src="js/ResizeSensor.js"></script>
    <script>
      $(function(){
        'use strict'

        var multibar = new Rickshaw.Graph({
          element: document.querySelector('#chartMultiBar1'),
          renderer: 'bar',
          stack: false,
          max: 60,
          series: [{
            data: [
              { x: 0, y: 20 },
              { x: 1, y: 25 },
              { x: 2, y: 10 },
              { x: 3, y: 15 },
              { x: 4, y: 20 },
              { x: 5, y: 40 },
              { x: 6, y: 15 },
              { x: 7, y: 40 },
              { x: 8, y: 25 }
            ],
            color: '#065381'
          },
          {
            data: [
              { x: 0, y: 10 },
              { x: 1, y: 30 },
              { x: 2, y: 45 },
              { x: 3, y: 30 },
              { x: 4, y: 42 },
              { x: 5, y: 20 },
              { x: 6, y: 30 },
              { x: 7, y: 15 },
              { x: 8, y: 20 }
            ],
            color: '#34B2E4'
          }]
        });

        multibar.render();

        // Responsive Mode
        new ResizeSensor($('.slim-mainpanel'), function(){
          multibar.configure({
            width: $('#chartMultiBar1').width(),
            height: $('#chartMultiBar1').height()
          });
          multibar.render();
        });

      });
    </script>
  </body>
</html>
