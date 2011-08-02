BitRatchet
----------

Simple class to allow you to read bits and bytes from a hex ascii string. Transparently deal with bits, reading the minimum amount of hex ahead.

(See test.php for more comprehensive example usage.)

Usage
-----

      require_once('bit_ratchet.php');
      $br = new BitRatchet("FF00FF");
      print $br->read(8); // Gives you 0xFF;
      print $br->read(8); // Gives you 0x00;
      print $br->read(4); // Gives you 0xF;
      print $br->read(4); // Gives you 0xF;
      $br->jump(0); // Jump back to the start
      print $br->read_signed(8); // Gives you -127 (0xFF signed)
      print($br->read_ascii(2)); // Gives you "00"
      $br_chunk = $br->read_chunk(8); // Gives you a new bit-ratchet object of last 8 bits
      $br_read(8); // Throws exception, we've read off the end!

Methods / variables
-------------------

  - `read($bits)` Read given number of bits and returned unsigned number.
  - `read_signed($bits)` Read given number of bits and returned signed number.
  - `read_ascii($bytes)` Read given number of bytes and returns hex. (Jumps to closest byte!)
  - `skip($bits)` Skip over given number of bits.
  - `jump($position)` Jump to given position, in bytes.
  - `ascii_hex` Access the full ascii_hex string directly.

Licence
-------

Copyright Dave Barker 2011

 This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU Lesser General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU Lesser General Public License for more details.

 You should have received a copy of the GNU Lesser General Public License
 along with this program.  If not, see <http://www.gnu.org/licenses/>.
