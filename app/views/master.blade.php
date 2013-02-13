<!DOCTYPE html>
  <head>
    <meta charset="utf8">
    <title>Hill Climb Racing Records</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Styles -->
    {{{ HTML::style('css/bootstrap.min.css') }}}
    {{{ HTML::style('css/styles.css') }}}
    <style>
      body {
        padding-top: 20px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>
  <body>

    <div class="container" style="margin-bottom: 60px">
      @yield('content')
    </div>

    <!-- JavaScripts -->
    <!-- Placed at the end of the document so that the pages load faster -->
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    {{{ HTML::script('js/bootstrap.min.js') }}}
    <script type="text/javascript">
      $('.player').dblclick(function() {
        var name = $(this).html();
        $('.player').each(function() {
          if (name == $(this).html()) {
            $(this).addClass('highlighted');
          } else {
            $(this).removeClass('highlighted');
          }
        });
      });
    </script>


  </body>
</html>
