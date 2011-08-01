BitRatchet
----------

Simple class to allow you to read bits and bytes from a hex ascii string. Transparently deal with bits, reading the minimum amount of hex ahead.

(See test.php for more comprehensive example usage.)

Usage
-----

      require_once('bit_ratchet.php');
      $br = new BitRatchet("FF00FF");
      print "FF is " . $br->read(8) . "\n";
      print "00 is " . $br->read(8) . "\n";
      print "F is " . $br->read(4) . "\n";
      print "F is " . $br->read(4) . "\n";
      // Jump back to the start
      $br->jump(0);
      // Read FF as a signed number
      print "FF is -127: " . $br->read_signed(8) . "\n";
      // Print the last two bytes as hex
      print($br->read_ascii(2));

Licence
-------

Copyright Dave Barker 2011

 This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program.  If not, see <http://www.gnu.org/licenses/>.
