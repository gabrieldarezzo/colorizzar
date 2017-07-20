# Colorizzar 


Change the color of an image without lose alpha channnel (alpha layer)  
Altere a cor da sua imagem sem perder a camada de alpha (transparência)



Ex:   
![Scheme](doc/to_from_rgb.png)  

You can change the color of this [car](https://github.com/gabrieldarezzo/colorizzar/blob/master/car.png?raw=true) (Or any imagem you want)

```
//RED-COLOR 
From: rgb(255, 31 , 40 );

//BLUE-COLOR
To:   rgb(31 , 117, 254);
```

```php
<?php
use Colorizzar\ChangeColor;

$changeColor = new ChangeColor();
$changeColor->colorizeByNameColor('Blue', 'car_red.png', 'cars/', 'blue.png');
```
  

### Create all `135` COLORS with `colorizeToAllColors()` !

![Scheme](doc/to_from.png)  


```php
<?php
use Colorizzar\ChangeColor;

$changeColor = new ChangeColor();
$changeColor->colorizeToAllColors('car_red.png', 'cars/');
```

You can create specific color by RGB too:
```php
<?php

require_once 'vendor/autoload.php';

use Colorizzar\ChangeColor;

$targetRed   = 135;
$targetGreen = 206;
$targetBlue  = 235;
$fileOut     = 'cars/new_blue_car.png';

$changeColor = new ChangeColor();
$changeColor->colorizeKeepAplhaChannnel($this->fileLocation, $targetRed, $targetGreen, $targetBlue, $fileOut);
```


```
SSH:
git clone git@github.com:gabrieldarezzo/colorizzar.git

HTTPS:
git clone https://github.com/gabrieldarezzo/colorizzar.git

cd colorizzar  
composer update  
```

Don't forget require autoload  

```php
<?php

require_once 'vendor/autoload.php';

use Colorizzar\ChangeColor;
```


### TODO-LIST:
  - *Create a plugin in JS consume colorizzar and show in realtime result   
  - Add DockBlock in all methods
  - Improve tests (check if has new rgb in image created instead just check if file is created)  
  - Improve ChangeColor.php SOLID (Create/Read file for example)  
  - Create some way custom color can be use and re-used in Colorizzar\Colors

'* 
1 - Hash create by upload image  
2 - create a folder with same name of hash  
3 - result a JSON with all urls created  
4 - pop in JS and show final result to user like a magic   




### Don't know RGB color of your HEX?!  
https://www.webpagefx.com/web-design/hex-to-rgb/


#### Thanks to:
https://stackoverflow.com/users/433392/steap