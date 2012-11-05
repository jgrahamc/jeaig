<?php

$id = $_GET['id'];

if ( preg_match( '/^[A-Za-z0-9\-\*]+$/', $id ) ) {
  $email = trim( `perl jeaig/decode $id` );
  if ( preg_match( '/^\w[\w\._\+\-]+@[\w_\+\-]+\.[\w_\.\+\-]+$/', $email ) &&
       (strlen( $email ) < 64 ) ) {
    header( 'Content-Type: image/png' );
    header( 'Cache-Control: no-cache' );
    header( 'Pragma: no-cache' );
    
    $gmdate_mod = gmdate('D, d M Y H:i:s', time()) . ' GMT';
    header( "Last-Modified: $gmdate_mod " );

    $gmdate_mod = gmdate('D, d M Y H:i:s', time()+1) . ' GMT';
    header( "Expires: $gmdate_mod " );

    passthru( "perl jeaig/image $email" );
  }
}

?>
