BinaryRatchet
-------------

Simple class to allow you to read bits and bytes from a hex ascii string. See test.php for example usage.

Usage
------

      require_once('binary_ratchet.php');
      $br = new BinaryRatchet("FF00FF");
      print "FF is " . $br->read(8) . "\n";
      print "00 is " . $br->read(8) . "\n";
