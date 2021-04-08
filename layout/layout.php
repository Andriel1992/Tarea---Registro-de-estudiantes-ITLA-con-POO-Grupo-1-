
<?php

    class Layout {

        private $isRoot;

        public function __construct($isRoot = false)
        {
            $this->isRoot = $isRoot;
        }

    function printHeader(){

        $directory = ($this->isRoot) ? "" : "../";

        $header = <<<EOF

        <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Estuciante</title>

    <link rel="stylesheet" href="{$directory}assets/css/style.css">
    <link rel="stylesheet" href="{$directory}assets/css/framework/Bootstrap/bootstrap.min.css">
    <link href="{$directory}assets\css\bootstrap.min.css" rel="stylesheet" type="text/css">
    <script href="assets\js\bootstrap.min.js"></script>
</head>

<body>

    <header>

        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a href="{$directory}index.php" class="navbar-brand d-flex ">

                    <strong>Home</strong>
                </a>

            </div>
        </div>
    </header>


    
        <br>

EOF;

        echo $header;
    }

    function printFooter(){

        $directory = ($this->isRoot) ? "" : "../";

        $footer = <<<EOF

      
    

</body>



</html>

EOF;

        echo $footer;

    }

}

?>