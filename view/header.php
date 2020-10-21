<header>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
        <input type="text" name="nick" placeholder="Nick">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" name="login" value="Entrar">
        <input type="submit" name="logout" value="Sortir">
        <?php
            if (isset($_SESSION['nick'])){
               $nick=$_SESSION['nick'];
               $soci=Soci::getSocinick($nick);?>
               <div>
                   <span><?php echo strtoupper($nick); ?></span>
                   <span><?php echo $soci->saldo; ?> €</span>
               </div>
               <?php
           
               if($soci->nick=="aleix"){
                   echo "<h3><a href='control.php'>CONTROL</a></h3>";
               }else{
                    echo "<h3><a href='ranking.php'>RANKING</a></h3>";
               }
            }?>
        
    </form>
    <h1><a href="index.php"><img id="titol" src="imatges/titol.png" title="Casino Cal molins" alt="casino cal molins"></a></h1>
</header>

<nav>
    <ul>
        <li><a href="index.php">INICI</a></li>
        <li><a href="jocs.php">JOCS</a>
            <ul>
                <li><a href="ruleta.php">Ruleta</a></li>
                <li><a href="blackjack.php">BlackJack</a></li>
                <li><a href="texas.php">Texas holdem</a></li>
            </ul>
        </li>
        <li><a href="registre.php">REGISTRE</a></li>
        <li><a href="contacte.php">CONTACTE</a></li>
    </ul>
</nav>