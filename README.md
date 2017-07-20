# Colorizzar 


Change the color of an image without lose alpha channnel (alpha layer)
Altere a cor da sua imagem sem perder a camada de alpha (transparência)



Ex:   
![Scheme](doc/to_from_rgb.png)  

You can change the color of this [car](https://github.com/gabrieldarezzo/colorizzar/blob/master/car.png?raw=true) (Or any imagem you want)

```
From: rgb(255, 31 , 40);
To:   rgb(31 , 117, 254);
```

```php
<?php
use Colorizzar\Colors;

$changeColor = new ChangeColor();
$changeColor->colorizeByNameColor('Blue', 'car_red.png', 'cars/', 'blue.png');
```
  

### Create all `135` COLORS!

![Scheme](doc/to_from.png)  


```php
<?php
use Colorizzar\Colors;

$changeColor = new ChangeColor();
$changeColor->colorizeToAllColors('car_red.png', 'cars/');
```

You can create specific color by RGB too:
```php
<?php
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