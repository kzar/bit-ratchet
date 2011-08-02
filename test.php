<?php
require_once('bit_ratchet.php');

$hex = "ca509d936b0100004a21F1";
$br = new BitRatchet($hex);

// Make sure the ascii_hex is set right
assert('strtoupper($hex) == $br->ascii_hex;');
// Test we can read first 8 bits
assert('$br->read(8) == 0xCA;');
// Test we can read the next 8 bits
assert('$br->read(8) == 0x50;');
// Now try reading two nibbles
assert('$br->read(4) == 0x9;');
assert('$br->read(4) == 0xD;');
// Test we can read another 8 bits
assert('$br->read(8) == 0x93;');
// Test we can read 4 bit flags and then a nibble
assert('$br->read(1) == 0x0;');
assert('$br->read(1) == 0x1;');
assert('$br->read(1) == 0x1;');
assert('$br->read(1) == 0x0;');
assert('$br->read(4) == 0xB;');
// We can read another byte
assert('$br->read(8) == 0x01;');
// Skip two empty bytes
$br->skip(16);
// We can read 3 bits and then a byte
assert('$br->read(3) == 0x2;');
assert('$br->read(8) == 0x51;');
// Read the spare 5 bits
assert('$br->read(5) == 0x1;');
// Jump back to second byte
$br->jump(1);
// Make sure we're in the right place
assert('$br->read(8) == 0x50');
// Read 5 bytes as hex
assert('$br->read_ascii(5) == "9D936B0100";');
// Read next byte, make sure it's right
assert('$br->read(8) == 0x00;');
// Check we can read signed numbers
$br->jump(9);
assert('$br->read_signed(8) == 33;');
assert('$br->read_signed(8) == -113;');
?>