<!-- form til indtastning af timer -->

<form action="#" method="post" enctype="multipart/form-data" name="petjTimer">
	<fieldset style='border:1px solid black;padding:2em 2em 2em 2em'>
    <legend> Timer </legend>
		
	  <label>Opgave</label> 
		 <select name="opgave">
      			<option value='0'> Vælg en opgave </option>
      		<?
				// funktion der skriver en liste via db
				opgValg();
				
				function opgValg(){
					
					global $wpdb;
					
					$sql = "SELECT * FROM `tid_opgaver` ORDER BY `Navn`";
					
					$visSkema = $wpdb->get_results($sql);

					

    					foreach($visSkema as $row){
	
    						echo "<option value='" 
							. $row->Id
							. "'>" 
							. $row->Navn 
							. "</option>";
	
    					}

					}
					
				?>   
  				</select>  
  
  <br />
  <label>Dato</label> <input type="date" name="bday"><br />
  
  <label>Timer</label> <input type="number" step="any" name="quantity"><br />
  
	  <input name="OK" type="submit" value="OK">
	  <input name="Cancel" type="reset" value="Cancel">
	</fieldset>
</form>

<div id="message" class="updated">    

<? // intert input from the form to the wordpress database

	function opdater(){

		global $wpdb;

		// insert remember wpdb->table
		$wpdb->show_errors($wpdb->insert("tid_timer",  
			array( 
				'Id' => NULL,		
				'Opgaver_Id' => $_POST['opgave'],
				'Dato' => $_POST['bday'],
				'Timer' => $_POST['quantity']
  				),  
				array(  '%d', '%d', '%s', '%d' )  )

		);
		$wpdb->flush();		

		echo "Timerne er nu registreret i databasen.";
			
		}

// insert into database

if($_POST[quantity] && $_POST['opgave'] && $_POST[bday]){

	opdater(); // executed if the form is ok 
}
else {
	print("<p style='color: red'>Alle felter skal udfyldes.");
}
?>

</div> <!-- ends error message -->
