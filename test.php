<?php
require_once('binary_ratchet.php');

$hex = "ca509d936b0100004a214a2c6ad042000000000000000000000000000000​000000000000000000408f580003e70011004a00000004fc339d936b0100​00feeefa0000000045a3cb460000000095fdfb5c";
$br = new BinaryRatchet($hex);

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
assert('$br->read(1) == 0;');
assert('$br->read(1) == 1;');
assert('$br->read(1) == 1;');
assert('$br->read(1) == 0;');
assert('$br->read(4) == 11;');
// We can read another byte
assert('$br->read(8) == 0x01;');
// Skip two empty bytes
$br->read(16);
// We can read 3 bits and then a byte
assert('$br->read(3) == 4;');
assert('$br->read(8) == 2593;');
?>