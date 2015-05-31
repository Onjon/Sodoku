<?php
// Show all errors and warings 'on'
error_reporting(E_ALL);

// Include sudoku solver class 
include( "Sudoku.php" );


// Initialize an array 
$arr = array();
// Open file as read mode
$file = fopen( "input.txt" , 'r'); 

// Start a loop until last line of the file
while( $lines = fgets( $file ) ) {
    // Store every row in array
    $arr[] = $lines ; 
}

// Initialize an array
$unsolved_sudoku = array();
// Start loop for print 'arr'
for( $i = 0; $i < sizeof( $arr ); $i++ ) {
    // Start a loop for a single row to get every row digit
    for( $k = 0 ; $k < strlen( $arr[ $i ] ); $k++ ) {
        // Check valid digit from 0 to 9
        if( $arr[ $i ][ $k ] >= '0' && $arr[ $i ][ $k ] <= '9' ) {
            // if true store the value in array 
            $unsolved_sudoku[ $i ][] = $arr[ $i ][ $k ];
        }
    }
}


// Instantiate sudoku solver class
$output = new Sudoku( $unsolved_sudoku );
// Call solve method of sudoku solver class 
$output -> getSolution();
?>