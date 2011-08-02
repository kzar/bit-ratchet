<?php
class BitRatchet {
  private $current_position, $ascii_hex;
  private $left_over, $left_over_bit_count;

  function __construct($ascii) {
    $this->ascii_hex = strtoupper($ascii);
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
    // Count number of bytes to read
    $bits_needed = $this->round_to_multiple($bits - $this->left_over_bit_count, 8);
    $bytes_needed = $bits_needed / 8;
    // Make sure they're avaliable
    if (($bytes_needed * 2 + $this->current_position) > strlen($this->ascii_hex))
      throw new Exception('BitRatchet: read over end of ascii hex.');
    // If so read them
    $ascii = substr($this->ascii_hex,
                    $this->current_position, $bytes_needed * 2);
    $binary = hexdec($ascii);
    // If there are left over bits add 'em
    if ($this->left_over_bit_count) {
      $binary = $binary | ($this->left_over << $bits_needed);
    }
    // Now trim off any extra bits and save them for later
    $bits_read = ($bytes_needed * 8 + $this->left_over_bit_count);
    if ($bits < $bits_read) {
      $this->left_over_bit_count = $bits_read - $bits;
      $this->left_over = $binary & (pow(2, $this->left_over_bit_count) - 1);
      $binary = $binary >> $this->left_over_bit_count;
    }
    // If not make sure the old left overs are chucked away
    else {
      $this->left_over_bit_count = 0;
      $this->left_over = 0;
    }
    // Increment our position
    $this->current_position += $bytes_needed * 2;
    // Phew, now return what we've read!
    return $binary;
  }

  public function skip($bits) {
    // Read the bits but don't return anything
    $this->read($bits);
  }

  public function read_signed($bits) {
    // Read the bits
    $unsigned = $this->read($bits);
    // Sign it
    if ($unsigned >= (pow(2, $bits) / 2))
      $signed = -1 * $unsigned + 128;
    else
      $signed = $unsigned;
    // and return
    return $signed;
  }

  public function read_ascii($bytes) {
    // Make sure they're avaliable
    if (($bytes * 2 + $this->current_position) > strlen($this->ascii_hex))
      throw new Exception('BitRatchet: read over end of ascii hex.');
    // If so read them
    $ascii = substr($this->ascii_hex, $this->current_position, $bytes * 2);
    // Increment our position
    $this->current_position += $bytes * 2;
    // Clear record of the left over bits, we've skipped over them by now
    $this->left_over_bit_count = 0;
    $this->left_over = 0;
    // Finally return ascii hex
    return $ascii;
  }
}
?>
