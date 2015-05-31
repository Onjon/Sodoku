<?php
/*
Developer   : Onjon Hossain
Email       : onjon_sh@yahoo.com

Version     : 1.0.1
Date        : 28th May, 2015

*/
final class Sudoku {
    // Class properties
    private $sudoku , $counter;
    
    // Construct Class 
    public function __CONSTRUCT( $a ) {
        // Initialize counter 
        $this -> counter = 1;
        // Store input parameter in class property
        $this -> sudoku = $a;
    }
    
    // Start solution 
    public function getSolution( $row = 0 , $col = 0 ) {
        // Check weather all cells is filled with valid number or not 
        if( $row > 8 ) {
            // If true the print sudoku
            $this -> showData();
        }
        else {
            // Check current index is filled or not( 0 for empty filled )
            if( $this -> sudoku[ $row ][ $col ] != 0 ) {
                // if filled then we move to the next index 
                $this -> moveNext( $row , $col );
            }
            else {
                // Check data from 1 to 9 
                for( $c = 1; $c <= 9; $c++ ) {
                    // Check row, column and grid 
                    if( ( $this -> checkRow( $row , $c ) == 1 ) && ( $this -> checkCol( $col , $c ) == 1 ) && ( $this -> checkGrid( $row , $col , $c ) == 1 ) ) {
                        // If number is valid then fill the current index 
                        $this -> sudoku[ $row ][ $col ] = $c ; 
                        // Move to next index 
                        $this -> moveNext( $row , $col );
                    }
                }
                // If no number is valid then fill index with zero( because zero is for unknown number ) and return to the caller
                $this -> sudoku[ $row ][ $col ] = 0;
            }
        }
    }
    
    // Print the solved sudoku 
    private function showData() {
        // Check if the sudoku is 9x9 or not 
        if( $this -> counter < 9 ) {
            echo "<table border='0'>";
            // Print row
            for( $i = 0; $i < 9; $i++ ) {
                echo "<tr>";
                // Print column
                for( $j = 0; $j < 9; $j++ ) {
                    echo "<td style='border:1px solid #000;'>&nbsp;". $this -> sudoku[ $i ][ $j ]."&nbsp;</td>" ;
                    // For set a column space after every grid
                    if( ($j+1)%3 == 0 && $j < 8) {
                        echo "<td></td>";
                    }
                }
                // For set a row space after every grid                     
                if( ($i+1)%3 == 0 && $i < 8) {
                    echo "</tr><tr>";
                }
                echo "</tr>";
                $this -> counter++;
            }
            echo "</table>";
        }
    }
    
    // Point to the next index 
    private function moveNext( $row , $col ) {
        if( $col < 8 ) {
            // If column is < 8, point next column 
            $this -> getSolution( $row , $col+1 );
        }
        else {
            // If column is >= 8 , point next row
            $this -> getSolution( $row+1 , 0 );
        }
    }
    
    // Check the number exist in current row or not
    private function checkRow( $row , $number ) {
        // Initilize return value 1
        $res = 1;
        // Check all column of current row
        for( $col = 0; $col < 9; $col++ ) {
            // Check number exist or not 
            if( $this -> sudoku[ $row ][ $col ] == $number ) {
                // If exist, set return value 0 
                $res = 0;
                // break this loop 
                break;
            }
        }
        // return either 0 or 1
        return $res;
    }
    
    // Check the number exist in current column or not
    private function checkCol( $col , $number ) {
        // Initilize return value 1
        $res = 1;
        // Check all row of current column
        for( $row = 0; $row < 9; $row++ ) {
            // Check number exist or not 
            if( $this -> sudoku[ $row ][ $col ] == $number ) {
                // If exist, set return value 0 
                $res = 0;
                // break this loop 
                break;
            }
        }
        // return either 0 or 1
        return $res;
    }
    
    // Check Grid 
    private function checkGrid( $row , $col , $number ) {
        // Initilize return value 1
        $res = 1;
        
        // Set row start point from 9x9 sudoku 
        $row = floor($row/3)*3;
        // Set col start point from 9x9 sudoku 
        $col = floor($col/3)*3;
        
        // Check 3x3 grid 
        for( $i = 0; $i < 3; $i++ ) {
            for( $j = 0; $j < 3; $j++ ) {
                // Check number exist or not 
                if( $this -> sudoku[ $row+$i ][ $col+$j ] == $number ) {
                    // If exist, set return value 0 
                    $res = 0;
                    // break this loop 
                    break;
                }
            }
        }
        // return either 0 or 1
        return $res;
    }
}
?>