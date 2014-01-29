<?php
/**
 * Plugin Name: PETJ Timeoversigt
 * Plugin URI: http://multimusen.dk/
 * Description: Samlet oversigt over forbrugt undervisningstid.
 * Version: 0.1
 * Author: Per Thykjaer Jensen
 * Author URI: http://www.multimusen.dk/
 * License: (c) Copyright by Per Thykjær Jensen 2014 - all rights reserved.
 */

/*
Shortcode: [petjTimeoversigt]
*/

function oversigt(){

	if (current_user_can( 'manage_options' )) {
        	include('tupdate.php');
        	}
        	else {
        		print("In order to edit this list, please log in.");
        	}


	global $wpdb; // you have to globalize wpdb before use

	$sql = "SELECT * FROM `tid_opgaverTimerSum`";


	$visTimerne = $wpdb->get_results($sql);

	echo "<table class='widefat'>
		<tr>
			<th>Opgave</th>
			<th style='text-align:right'>Timer</th>
		</tr>
	
	"; // primitive table without th etc.

    foreach($visTimerne as $row){
	echo "<tr>";
        echo "<td>" . $row->Hvad . "</td>";
	echo "<td style='text-align:right'>" . $row->Timer . "</td>";
	echo "</tr>";
    }
    
    echo "<tr>"
    . "<td> I alt </td>"
            . "<td style='text-align:right;font-weight:bold'>";
    
    $sumSum = "SELECT `sum` FROM `tid_SummaSummarum` LIMIT 0, 30 "; // view: sum and total of the hours

    $iAlt = $wpdb->get_results($sumSum);
    
    foreach ($iAlt as $row){
        print($row->sum);
    }
    
    echo "</td></tr>";

	echo "</table>";
		
	$wpdb->flush();

}
add_shortcode( 'petjTimeoversigt', 'oversigt' ); // register the shortcode in WP
?>
