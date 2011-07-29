<?php
class BinaryRatchet {
  private $current_position, $ascii_hex;
  private $left_over, $left_over_bit_count;

  function __construct($ascii) {
    $this->ascii_hex = $ascii;
    $this->current_position = 0;
  }

  public function jump($position) {
    $this->current_position = $position * 2;
    $this->left_over = 0;
    $this->left_over_bit_count = 0;
  }

  public function round_to_multiple($x, $multiple) {
    return ceil($x / $multiple) * $multiple;
  }

  public function read($bits) {
    print "\nCurrent position: " . $this->current_position . "\n";
    // Count number of bytes to read
    $bytes_needed = $this->round_to_multiple($bits - $this->left_over_bit_count, 8) / 8;
    // Make sure they're avaliable
    if (($bytes_needed * 2 + $current_position) > strlen($this->ascii_hex))
      throw new Exception('BinaryRatchet: read over end of ascii hex.');
    // If so read them
    print("Bit count: " . $bits . "\n");
    print("Bytes needed: " . $bytes_needed . "\n");
    $ascii = substr($this->ascii_hex,
                    $this->current_position, $bytes_needed * 2);
    print("Ascii: " . $ascii . "\n");
    $binary = hexdec($ascii);
    // If there are left over bits add 'em
    if ($this->left_over_bit_count) {
      $binary = $binary << $this->left_over_bit_count;
      $binary = $binary | $this->left_over;
    }
    // Now trim off any extra bits and save them for later
    $bits_read = ($bytes_needed * 8 + $this->left_over_bit_count);
    if ($bits < $bits_read) {
      $this->left_over_bit_count = $bits_read - $bits;
      $this->left_over = $binary & (pow(2, $this->left_over_bit_count) - 1);
      $binary = $binary >> $this->left_over_bit_count;
      print "Left over bt count: " . $this->left_over_bit_count . "\n";
      print "Left over: " . $this->left_over . "\n";

    }
    // If not make sure the old left overs are chucked away
    else {
      $this->left_over_bit_count = 0;
      $this->left_over = 0;
    }
    // Increment our position
    $this->current_position += $bytes_needed * 2;
    // Phew, now return what we've read!
    print "Result: " . $binary . "\n";
    return $binary;
  }
}
?>