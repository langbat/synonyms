<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title> <?php echo ( count( $this->pageTitle ) ) ? implode( ' - ', array_reverse( $this->pageTitle ) ) : $this->pageTitle; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="author" content=""/>
    <link rel="shortcut icon" href="/favicon2.ico" />
    <link href="/themes/default/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="/themes/default/css/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
    <link href="/themes/default/css/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="/themes/default/css/styles.css" rel="stylesheet" type="text/css" />
    <script src="/themes/default/js/jquery.js" type="text/javascript"></script>
    <script src="/themes/default/js/bootstrap.js" type="text/javascript"></script>
    <script src="/themes/default/js/bootstrap2.js" type="text/javascript"></script>
    <script src="/themes/default/js/bootstrap2.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/jquery.validationEngine-es.js" type="text/javascript"></script>
    <script src="/themes/default/js/jquery.validationEngine.js"></script>
    <script src="/themes/default/js/prettyCheckable.js"></script>
    <script src="/themes/default/js/functions.js"></script>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="/themes/default/js/html5shiv.js" type="text/javascript"></script>
    <![endif]-->
</head>
<body>
<div id="wrapper">
    <!-- Header -->
    <?php $this->renderPartial('../elements/header'); ?>
    <!-- End header -->

    <!-- MainContent -->
    <?php echo $content;  ?>
    <!-- End mainContent -->

    <!--- Footer --->
    <?php $this->renderPartial('../elements/footer'); ?>
</div><!--end wrapper -->
</body>
</html>
