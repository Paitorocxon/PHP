<?php
/**
 * ColorPaletteGenerator Class
 *
 * @copyright 2023 Fabian Müller
 * @license MIT License
 */
 
 
/**
 * Class ColorPaletteGenerator
 * A class for generating random colors and color palettes.
 */
class ColorPaletteGenerator
{
    /**
     * Generates a random color in hexadecimal format.
     *
     * @return string The generated color in hexadecimal format.
     */
    public static function generateRandomColor(): string
    {
        // Generate a random hue between 0 and 360 degrees
        $hue = mt_rand(0, 360);

        // Keep saturation and lightness within specific ranges to ensure pleasant colors
        $saturation = mt_rand(40, 80);
        $lightness = mt_rand(30, 70);

        // Convert HSL values to RGB values
        $rgb = self::hslToRgb($hue, $saturation, $lightness);

        // Format RGB values as hexadecimal code
        $color = sprintf("#%02x%02x%02x", $rgb['red'], $rgb['green'], $rgb['blue']);

        return $color;
    }

    /**
     * Converts HSL values to RGB values.
     *
     * @param float $hue The hue in the range of 0 to 360 degrees.
     * @param float $saturation The saturation in the range of 0 to 100.
     * @param float $lightness The lightness in the range of 0 to 100.
     *
     * @return array The RGB values as an associative array ('red', 'green', 'blue').
     */
    private static function hslToRgb(float $hue, float $saturation, float $lightness): array
    {
        $hue /= 360;
        $saturation /= 100;
        $lightness /= 100;

        $red = $lightness;
        $green = $lightness;
        $blue = $lightness;
        $v = ($lightness <= 0.5) ? ($lightness * (1.0 + $saturation)) : ($lightness + $saturation - $lightness * $saturation);

        // Remaining code remains unchanged
        // ...

        return [
            'red' => round($red * 255),
            'green' => round($green * 255),
            'blue' => round($blue * 255),
        ];
    }

    /**
     * Generates a color palette with a specified number of colors.
     *
     * @param int $numColors The number of colors to generate.
     *
     * @return array An array containing the generated colors.
     */
    public static function generateColorPalette(int $numColors): array
    {
        $palette = [];

        for ($i = 0; $i < $numColors; $i++) {
            $palette[] = self::generateRandomColor();
        }

        return $palette;
    }
}

// Generate a color palette with 5 colors
$colorPalette = ColorPaletteGenerator::generateColorPalette(5);

// Output the generated colors
foreach ($colorPalette as $color) {
    echo "<div style=\"background-color:$color\">$color</div>";
}
?>
