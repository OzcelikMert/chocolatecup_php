<?php
// Write on File
class FileWriter{
    function __construct($file_location){
        $this->FileLocation = $file_location;
    }
    
    /* Variables */
    private $FileLocation = "";
    public $Text = "";
    public $Type = "";
    /* end Variables */

    // Write On File
    function Write(){
        if(is_writable($this->FileLocation)){
            // Open File
            if ($file = fopen($this->FileLocation, $this->Type)){
                if(fwrite($file, $this->Text)){
                    fclose($file);
                    return true;
                }
            }

        }

        return false;
    }
    // end Write on File
}
?>