<link rel="stylesheet" href="main.css" type="text/css">
<?php

$program = new program();

class program {
    function __construct() {
        $page='homepage';
        $arg=NULL;
        if(isset($_REQUEST['page'])){
            $page=$_REQUEST['page'];
        }
        if(isset($_REQUEST['arg'])){
            $arg=$_REQUEST['arg'];
        }
        // echo $page
        $page = new $page($arg);
        }
        function __destruct() {
        }
}
abstract class page{
        public $content;
        function menu() {
            $menu='<a href="./index.php"> Home &nbsp; &nbsp; &nbsp; </a>';
            $menu.='<a href="./index.php?page=login"> Login &nbsp; &nbsp; &nbsp; </a>';
            $menu.='<a href="./index.php?page=account"> My Account &nbsp; &nbsp; &nbsp; </a>';
            return $menu;
        } // Menu

        public $someParagraph;

        function __construct($arg=NULL){
            if($_SERVER['REQUEST_METHOD']=='GET'){
                $this->get();
            }
            else{
                $this->post();
            }
        } // Construct
        function __destruct(){
            echo $this->content;
        }
} // Class Page

class homepage extends page {
        function get() {
            $this->content.=$this->menu();
            $this->content.=$this->header();
            $this->content.=$this->intro();
        }
        function header(){
            echo '<h1>Welcome to Bitty Bank</h1>';
        }
        function intro(){
            $introPar = '<p>Welcome to Bitty Bank. From setting up a checking or savings account to finding the right home loan, we can help.<br /> And for your investment needs, we offer online tools and resources to help you take 
control of your finances.</p>';
            return $introPar;
        }
} //Class Homepage

class login extends page {
        function get(){
            $this->content.=$this->menu();
            $this->content.=$this->loginForm();
            $this->content.=$this->lHeader();
        }
        function loginForm(){
            $form ='<form action="index.php?page=login" method="post">
            <p>
           <label for="username">User Name</label><br />
            <input type="text" name="username" id="username" /><br />
            <br />
            <label for="password">Password</label><br />
            <input type="text" name="password" id="password" /><br />
            <br />
            <label for="email">E-Mail Address</label><br />
            <input type="text" name="email" id="email" /></br />
            <br />
            <input type="submit" value="Send" /> &nbsp; &nbsp; <input type="reset" />
            </p>
            </form>
            <a href="./index.php?page=register">Register</a><br />
            <br />
            <a href="./index.php?page=forgotPW">Forgot Password</a>';

            return $form;
        }
        function lHeader(){
            echo '<h1>Login to Your Account</h1>';
        }
        function post(){
            print_r($_POST);
        }
}

class forgotPW extends page {
        function get(){
            $this->content.=$this->pwHeader();
            $this->content.=$this->menu();
            $this->content.=$this->pwForm();
        }
        function pwHeader(){
        echo '<h1>Change your Password</h1>';
        }
        function pwForm(){
            $pForm = '<form action="index.php?page=forgotPW" method="post">
            <p>
            <label for="fUsername">User Name</label><br />
            <input type="text" name="username" id="username" /><br />
            <br />
            <label for="fEmail">E-Mail Address</label><br />
            <input type="email" name="femail" id="femail" /><br />
            <br />
            <input type="submit" value="Send" /> &nbsp; &nbsp; <input type="reset" />
            </p>
            </form> ';
            return $pForm;
        }

}

class register extends page {
        function get(){
            $this->content.=$this->rHeader();
            $this->content.=$this->menu();
            $this->content.=$this->rForm();
        }
        function rHeader(){
            echo '<h1>Register with Bitty Bank</h1>';
        }
        function rForm(){
            $rForm = '<form action="index.php?page=register" method="post">
            <p>
            <label for="rUsername">User Name</label><br />
            <input type="text" name="username" id="username" /><br />
            <br />
            <label for="rEmail">E-Mail Address</label><br />
            <input type="email" name="remail" id="remail" /><br />
            <br />
            <label for="rPassword">Password</label><br />
            <input type="text" name="rpassword" id="rpassword" /><br />
            <br />
            <label for="cPassword">Confirm Password</label><br />
            <input type="text" name="cpassword" id="cpassword" /><br />
            <br />

            <input type="submit" value="Send" /> &nbsp; &nbsp; <input type="reset" />
            </p></form> ';
            return $rForm;
        }
}

class account extends page {
        function get(){
            $this->content.=$this->aHeader();
            $this->content.=$this->menu();
            $this->content.=$this->transactionForm();
            $this->content.=$this->aTable();
        }
        function aHeader(){
            echo '<h1>Your Account</h1>';
        }
        function transactionForm(){
            $transForm='<form action="index.html?page=account" method="post">
            <p>
            <label for="date">Date</label><br />
            <input type="date" name="date" id="date" /><br />
            <br />
            <label for="description">Short Description</label><br />
            <input type="text" name="remail" id="remail" /><br />
            <br />
            <label for="deposit">Deposit</label><br />
            <input type="text" name="deposit" id="deposit" /><br />
            <br />
            <label for="debit">Debit</label><br />
            <input type="text" name="debit" id="debit" /><br />
            <br />

            <input type="submit" value="Send" /> &nbsp; &nbsp; <input type="reset" />
            </p>          
            </form>';
            return $transForm;
        }

/* My Account page ToDos:
1. Have to remove echo statements from aTable, which I suspect is causing it's weird placement.
2. Resolve MySQL issues, make a table to hold values with the username as the primary key and account trans.
3. Retrieve the number of transactions from the table, post them to aTable, perform calculations for balance.
*/
        function aTable(){
            $rows = 3;
            $cols = 4;
            $total = NULL;

            echo '<table border="1" width="800px">';
            echo '<tr><th>Date</th><th>Description</th><th>Credit</th><th>Debit</th>';
                for($tr=1; $tr<=$rows; $tr++){
                   echo "<tr height='25px'>";
                        for($td=1;$td<=$cols; $td++){
                           echo "<td>"."</td>";
                         }
                   echo "</tr>";
                }
            echo "</table><br /><br />";
        }
}
/*
class transactions extends page {
       function get() {
            $this->content.=$this->tHeader();
            $this->content.=$this->menu();
            //$this->content.=$this->trans;
       }
      function tHeader(){
            echo '<h1>Account Transactions</h1>';
       }
}
*/
?>