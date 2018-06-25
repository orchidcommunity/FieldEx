# ���� ��� Orchid Platform


## Installation

Install using Composer:
```
composer require orchids/fieldex
```



�������� � config/platform.php �� ���� ������� �����

```
        'blank'        => Orchids\FieldEx\Fields\Types\BlankField::class,
        'list'         => Orchids\FieldEx\Fields\Types\ListField::class,
        'relationship2'=> Orchids\FieldEx\Fields\Types\RelationshipField2::class,
        'checkbox2'    => Orchids\FieldEx\Fields\Types\CheckBoxField2::class,
```
        
### BlankField

������������� ���� 

����� �����...

### ListField

���� list ������� ������� � develop


### RelationshipField2

���� relationship � multiple

��������� � layout ��� �������� ���� 

```
    'icons' =>Field::tag('relationship2')
        ->name('content.icons')
        ->title('������')
        ->multiple()
        ->handler(IconWidget::class),	
```


### CheckBoxField2

������� checkbox �� ���������� ������ ������ � request ���� �� ����� �����, ��� ������� ��������� ����������.
checkbox2 � ���� ������ ���������� �������� - 0.


