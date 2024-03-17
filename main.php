<main>
    
    <h1>Att Göra Lista</h1>
    
    <?php 
        include 'form.php';
        include './classes/Uppgift.class.php';
        include './classes/Lista.class.php';

        $list= new Lista('.\json\todolist.json');

    ?>

<?php

    //deletar alla poster 
    if(isset($_GET['deleteall'])) {
        $list->deleteAll();
    }
   
    echo '<a href="index.php?deleteall=1">Delete All</a>' . "<br/>";

    if(isset($_GET['delete'])) {
        $list->deleteUppgift(intval($_GET['delete']));
    }

    //skapar uppgift 
    if (isset($_POST['submit']) && $_POST['submit'] === 'submit') /*https://www.php.net/manual/en/function.isset.php*/
    {   

        $vad= $_POST['vad'];
        $vem= $_POST['vem'];
        $nar= $_POST['nar'];


        try {
            $uppgift = new Uppgift($vad, $vem, $nar);
            $list->add($uppgift);
            $list->save();

        } catch (Exception $error) {
            echo $error->getMessage();
        }
    }
  
    ?>
    <div id="cont">
        <div id="divvad">
            <p>Vad ska göras</p>
            <!--Skriva ut i lista-->
            <?php
                foreach($list->getUppgifter() as $index => $uppgift) {
                    echo $uppgift->getVad() . "<br/>";
                }
            ?>

        </div>
        <div id="divvem">
            <p>Vem ska utföra uppgiften</p>
            <!--Skriva ut i lista-->
            <?php
                foreach($list->getUppgifter() as $index => $uppgift) {
                    echo $uppgift->getVem() . "<br/>";
                }
            ?>
        </div>
        <div id="divnar">
            <p>När ska uppgiften utföras</p>
            <!--Skriva ut i lista-->
            <?php
                foreach($list->getUppgifter() as $index => $uppgift) {
                    echo $uppgift->getVad() . " ";
                    echo '<a href="index.php?delete='. $index .'">Delete</a>' . "<br/>";
                }
            ?>

        </div>
    </div>
   <br/>
    <a id="link" href="json/todolist.json">link to Json</a>

</main>