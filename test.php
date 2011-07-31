<?php
require_once('bit_ratchet.php');

$hex = "ca509d936b0100004a21";
$br = new BitRatchet($hex);

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
$br->read(16);
// We can read 3 bits and then a byte
assert('$br->read(3) == 0x2;');
assert('$br->read(8) == 0x51;');
// Read the spare 5 bits
assert('$br->read(5) == 0x1;');
// Jump back to second byte
$br->jump(1);
// Make sure we're in the right place
assert('$br->read(8) == 0x50');
?>