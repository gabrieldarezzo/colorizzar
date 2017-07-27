# Colorizzar 


Change color of an image without lose alpha channnel (alpha layer)  
Altere a cor da sua imagem sem perder a camada alpha (camada de transparência)


You can change the color of this [car](https://github.com/gabrieldarezzo/colorizzar/blob/master/car.png?raw=true) (Or any imagem you want)


You can create specific color by RGB:
```php
<?php
 
require_once 'vendor/autoload.php';

use Colorizzar\ChangeColor;

$changeColor = new ChangeColor('red_car.png');

//From Red (rgb Params)
$changeColor->setFromRGB(255, 31, 40);

//To Blue Color (rgb Params)
$changeColor->setToRGB(135, 206, 235);
$changeColor->colorizeKeepAplhaChannnel('new_blue_car.png');

```

Or change color by color name with method `colorizeByNameColor()`

```php
$changeColor = new ChangeColor('red_car.png');
$changeColor->colorizeByNameColor('Blue', 'new_cars/'); // Will create 'blue.png'
```   
 
 
Ex of result `colorizeKeepAplhaChannnel()`, `colorizeByNameColor()`  

![Scheme](doc/to_from_rgb.png)  


  

### Create all `135` COLORS with `colorizeToAllColors()` !

![Scheme](doc/to_from.png)  

```php
$changeColor = new ChangeColor('red_car.png');
$changeColor->colorizeToAllColors('cars/');
```




```
SSH:
git clone git@github.com:gabrieldarezzo/colorizzar.git

HTTPS:
git clone https://github.com/gabrieldarezzo/colorizzar.git

cd colorizzar  
composer update  
```

Example of use:
```php
<?php

require_once 'vendor/autoload.php';

use Colorizzar\ChangeColor;

$defaultRedRGB = 255;
$defaultGreenRGB = 31;
$defaultBlueRGB = 40;


$fileLocation = __DIR__.'./files/car.png';
$folderOut = __DIR__.'./output/';


try {

	$changeColor = new ChangeColor($fileLocation);
	$changeColor->setFromRGB($defaultRedRGB, $defaultGreenRGB, $defaultBlueRGB);

	//Blue Color
	$red   = 135;
	$green = 206;
	$blue  = 235;
	$changeColor->setToRGB($red, $green, $blue);

	$fileOut = $folderOut . 'new_blue_car.png';
	$changeColor->colorizeKeepAplhaChannnel($fileOut);


} catch(Exception $ex){
	print $ex->getMessage();
	die();
}

```


### TODO-LIST:
  - Improve tests (check in image created has new rgb expected)  
  - IMPROVE TODOLIST and update readme with new methods (hexadecimal)
  - (almost done) Create a WebService recive a file and manipulate methods to create dynamic
  - Create a plugin in JS consume colorizzar and show in realtime result   
  - (done) Add DockBlock in all methods
  - (done) Improve ChangeColor.php SOLID


1 - Hash create by upload image  
2 - create a folder with same name of hash  
3 - result a JSON with all urls created  
4 - pop in JS and show final result to user like a magic   



```batch
//List things to-do in Folder before commit:
.\vendor\bin\phpcs --standard=PSR2 src\

//Fix File!
.\vendor\bin\phpcbf --standard=PSR2 src\file.php

Fix a Folder
.\vendor\bin\phpcbf --standard=PSR2 src\ -w --no-patch

//Don't Forget check if you don't break anything hehe. You need test manually #NOT
.\vendor\bin\phpunit
```



Run a specific test  


```php

   /**
    * @group upload
    */
    public....
```


```batch
phpunit --group upload
```



### Don't know RGB color of your HEX?!  
https://www.webpagefx.com/web-design/hex-to-rgb/


#### Thanks to:

 * [@augustohp](https://github.com/augustohp) for code-review and 'JSON to Class' script on commit [@236b6f3734981d9e7f3758b5b5d8e709687675c3](https://github.com/gabrieldarezzo/colorizzar/pull/1/commits/236b6f3734981d9e7f3758b5b5d8e709687675c3)
 * https://stackoverflow.com/users/433392/steap