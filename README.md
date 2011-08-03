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

  Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

  The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.