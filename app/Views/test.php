<?php

helper('number');
helper('date');
echo date('Y-M-d H:i:s', now('Asia/Jakarta'));
?>
<br>
<br>
<?php
echo number_to_size(456); // Returns 456 Bytes
echo number_to_size(4567); // Returns 4.5 KB
echo number_to_size(45678); // Returns 44.6 KB
echo number_to_size(456789); // Returns 447.8 KB
echo number_to_size(3456789); // Returns 3.3 MB
echo number_to_size(12345678912345); // Returns 1.8 GB
echo number_to_size(123456789123456789); // Returns 11,228.3 TB
?>
<br>
<?php
echo number_to_roman(23);    // Returns XXIII
echo number_to_roman(324);   // Returns CCCXXIV
echo number_to_roman(2534);  // Returns MMDXXXIV