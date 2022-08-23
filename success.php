<?php
	include 'inc/header.php';
	//include 'inc/slider.php';
?>
<?php
	 if(!isset($_GET['orderid']) && $_GET['orderid'] == 'order'){
      $customer_id = Session::get('customer_id');
      $insertorder = $ct->insertOrder($customer_id);
      $delCart = $ct->del_all_data_cart();
      header('Location:success.php');
    }
    else{
      $id = $_GET['orderid'];
    }
  
?>
<style type="text/css">
	h2.success{
		text-align: center;
		color: red;
	}
	p.success_note{
		text-align:  center;
		padding: 8px;
		font-size: 17px;
	}
	h2.success_order{
		text-align: center;
		color: red;
	}

</style>
<form action="" method="PSOT"> 
 <div class="realmedia_maintainaspect">
    <div class="content">
    	<div class="section group">
    		<h2 class="success_order">Success Order</h2>	
    		<?php 
    		$customer_id = Session::get('customer_id');
    		$get_amount = $ct->getAmountPrice($customer_id);
    		if($get_amount){
    			$amount=0;
    			while($result = $get_amount->fetch_assoc()){
    				$price = $result['price'];
    				$amount += $price;
    			}
    		}
    		?>
    		<p class= "success_note">Total Price You Have Bought From My Website: 
    			<?php
    		 		$vat = $amount *0.1;
    		 		$total = $vat+$amount;
    		 		echo $total.' VND';

    		 	?></p>
    		<p class ="success_note"> We will contact as soon as posiable. Please see your order details here <a href="orderdetails.php">Click Here</a></p>
    
 		</div>
 	</div>
</div>
</form>
	<?php
	include 'inc/footer.php';
?>
