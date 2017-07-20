# Colorizzar 

## Don't Lose Your Alpha Channnel   
## Não perca sua camada transparente  


Change the color of an image from RGB to any color you want, keep alpha channnel    
Altere a cor da sua imagem para qualquer cor que você quiser, sem perder a camada transparente  


![Scheme](doc/to_from_rgb.png)  



```php
use Colorizzar\Colors;

$changeColor = new ChangeColor();
$changeColor->colorizeByNameColor('Blue', 'car_red.png', 'cars/', 'blue.png');
```
  

### Create all `135` COLORS!

![Scheme](doc/to_from.png)  


```php
use Colorizzar\Colors;

$changeColor = new ChangeColor();
$changeColor->colorizeToAllColors('car_red.png', 'cars/');
```

You can create specific color by RGB too:
```php
use Colorizzar\Colors;

$targetRed   = 135;
$targetGreen = 206;
$targetBlue  = 235;
$fileOut     = 'cars/new_blue_car.png';

$changeColor = new ChangeColor();
$changeColor->colorizeKeepAplhaChannnel($this->fileLocation, $targetRed, $targetGreen, $targetBlue, $fileOut);
```

Don't know RGB color of your HEX?!  
https://www.webpagefx.com/web-design/hex-to-rgb/


This package just happen because https://stackoverflow.com/users/433392/steap is a good person