<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $page_title;?> jQuery UI Autocomplete - Default functionality</title>
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
  <!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> -->
  <link rel="stylesheet" href="<?php echo CSS_PATH;?>jquery-ui.css">
   <script src="<?php echo JS_PATH;?>jquery.js"></script>
   <script src="<?php echo JS_PATH;?>jquery-ui.js"></script>
  <!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
  <script>
  $(function(){
      
  $("#tags").autocomplete({
    source:<?php echo base_url()."front/Search/test"; ?>;
  });

  </script>
</head>
<body>
 
<div class="ui-widget">
  <label for="tags">Tags: </label>
  <input id="tags">
</div>
 
 
</body>
</html>