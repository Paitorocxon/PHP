

function generateRandomColor() {
    // Generiere eine zufällige Hue (Farbton) zwischen 0 und 360 Grad
    $hue = mt_rand(0, 360);

    // Saturation und Lightness können in einem bestimmten Bereich bleiben, um die Farben angenehm zu halten
    $saturation = mt_rand(40, 80);
    $lightness = mt_rand(30, 70);

    // Konvertiere HSL-Werte in RGB-Werte
    $rgb = hslToRgb($hue, $saturation, $lightness);

    // Formatiere RGB-Werte als Hexadezimalcode
    $color = sprintf("#%02x%02x%02x", $rgb['r'], $rgb['g'], $rgb['b']);

    return $color;
}

function hslToRgb($h, $s, $l){
    $h /= 360;
    $s /= 100;
    $l /= 100;

    $r = $l;
    $g = $l;
    $b = $l;
    $v = ($l <= 0.5) ? ($l * (1.0 + $s)) : ($l + $s - $l * $s);

    if ($v > 0){
        $m;
        $sv;
        $sextant;
        $fract;
        $vsf;
        $mid1;
        $mid2;

        $m = $l + $l - $v;
        $sv = ($v - $m ) / $v;
        $h *= 6.0;
        $sextant = floor($h);
        $fract = $h - $sextant;
        $vsf = $v * $sv * $fract;
        $mid1 = $m + $vsf;
        $mid2 = $v - $vsf;

        switch ($sextant)
        {
            case 0:
                $r = $v;
                $g = $mid1;
                $b = $m;
                break;
            case 1:
                $r = $mid2;
                $g = $v;
                $b = $m;
                break;
            case 2:
                $r = $m;
                $g = $v;
                $b = $mid1;
                break;
            case 3:
                $r = $m;
                $g = $mid2;
                $b = $v;
                break;
            case 4:
                $r = $mid1;
                $g = $m;
                $b = $v;
                break;
            case 5:
                $r = $v;
                $g = $m;
                $b = $mid2;
                break;
        }
    }

    $rgb['r'] = round($r * 255);
    $rgb['g'] = round($g * 255);
    $rgb['b'] = round($b * 255);

    return $rgb;
}

function generateColorPalette($numColors) {
    $palette = [];

    for ($i = 0; $i < $numColors; $i++) {
        $palette[] = generateRandomColor();
    }

    return $palette;
}

$colorPalette = generateColorPalette(5);


foreach($colorPalette as $color) {
    echo "<div style=\"background-color:$color\">$color</div>";
}
