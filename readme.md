# Поля для Orchid Platform


## Installation

Install using Composer:
```
composer require orchids/fieldex
```



добавить в config/platform.php те поля которые нужны

```
        'blank'        => Orchids\FieldEx\Fields\Types\BlankField::class,
        'list'         => Orchids\FieldEx\Fields\Types\ListField::class,
        'relationship2'=> Orchids\FieldEx\Fields\Types\RelationshipField2::class,
        'checkbox2'    => Orchids\FieldEx\Fields\Types\CheckBoxField2::class,
```
        
### BlankField

Универсальное поле 

потом опишу...

### ListField

Поле list которое удалено в develop


### RelationshipField2

Поле relationship с multiple

Использую в layout так описание поля 

```
    'icons' =>Field::tag('relationship2')
        ->name('content.icons')
        ->title('Иконки')
        ->multiple()
        ->handler(IconWidget::class),	
```


### CheckBoxField2

Обычный checkbox не отправляет вообще данные в request если не стоит галка, что создает некоторые неудобства.
checkbox2 в этом случае отправляет занчение - 0.


