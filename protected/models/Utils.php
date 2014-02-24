<?php class Utils {
    function number_format($value){
        return number_format($value, 2, ',', '.');
    }
    function date_format($value, $type='datetime'){
        if (!is_numeric($value))
            $value = strtotime($value);
            
        if ($type == 'date') $format = 'd.m.Y';
        else $format = 'd.m.Y h:i A';
        
        return date($format, $value);
    }
    
    function sendMail($from, $to, $subject, $message){
        $email = Yii::app()->email;
		$email->subject = $subject;
		$email->to = $to;
		$email->from = $from;
		$email->replyTo = $from;
		$email->message = $message;
		return $email->send();
    }
    
    function number_format_compare($value){
        return number_format($value, 2, '.', '.');
    }

    function date_format24h( $value, $option=0 ){
        $datetime = '';
        if($value!=''){
            if( $option == 1 )
                $datetime = date("d.m.Y H:i:s",strtotime($value));
            else
                $datetime = date("d/m/Y H:i:s",strtotime($value));
        }
        
        $datetimenew = ( $datetime =='01/01/1970 00:00:00' )? '':$datetime;
        return $datetimenew;
    }
}
	