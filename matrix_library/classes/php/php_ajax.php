<?php
class PHPAjax {
    public function Send($URL, $Data, $Method){
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => $Method,
                'content' => http_build_query($Data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($URL, false, $context);

        return $result;
    }
}
?>