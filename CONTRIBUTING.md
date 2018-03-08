You should donwload this repo:
```
SSH:
git clone git@github.com:gabrieldarezzo/colorizzar.git

HTTPS:
git clone https://github.com/gabrieldarezzo/colorizzar.git

cd colorizzar
```


Run composer: 
```
composer update
```


Before commit:
Run 
```
composer ci
```  
ci = Continus Integrations:

Disclaimer
```
	"test": [
        "phpunit"
    ],
    "ci": [
        "php-cs-fixer fix ./src",
        "php-cs-fixer fix ./tests",
        "phpcs --standard=PSR2 ./src",
        "phpcs --standard=PSR2 ./tests",
        "@test"
    ]
```


To fix phplint and fallow rules of PSR2 and run Tests


You must use:
http://editorconfig.org/



